<template>
    <div class="portlet light ">
        <header-tools :date.sync="date" :game.sync="game_id" :games="games">
            <slot slot="header" name="header"></slot>
        </header-tools>
        <div class="portlet-body">
            
            <filter-tools 
                :data.sync="data"
                :size.sync="size"
            >
            </filter-tools>

            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th>Game Name</th>
                            <th>Draw Date</th>
                            <th>Winning Numbers</th>
                            <th>Power Play</th>
                            <th>Annuity Payout</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pb in data.draws" :class="[$index % 2 == 0 ? 'odd' : 'even', checkAssigned(pb) ? 'assigned': '']">
                            <td>{{ pb.gameName }}</td>
                            <td>{{ pb.drawTime | timestamp2date}}</td>
                            <td>
                                <span v-if="checkWaiting(pb)" class="label label-danger"> waiting</span>
                                <span v-else v-for="number in pb.results[0].primary">
                                    <strong v-if="$index < 5" v-text="number"></strong>
                                    <strong class="powerball" v-if="$index == 6" v-text="number.slice(-2)"></strong>
                                </span>
                            </td>
                            <td>
                                <span v-if="checkWaiting(pb)" class="label label-danger"> waiting</span>
                                <span v-else>{{ pb.results[0].multiplier }}</span>
                            </td>
                            <td>{{ pb.estimatedJackpot | remove2CharLast | currency }}</td>
                            <td>
                                <span class="label" :class="[checkWaiting(pb) ? 'label-danger' : 'label-default']">{{ pb.status }}</span>
                            </td>
                            <td class="text-center">
                                <button v-if="!checkWaiting(pb)" class="assigned btn btn-sm green btn-outline filter-cancel" 
                                    :disabled="checkWaiting(pb) || checkAssigned(pb)"
                                    @click="assignToResult(pb)"
                                > 
                                    <i class="fa fa-location-arrow"></i> 
                                    {{ checkAssigned(pb) ? 'Assigned' : 'Assign to Module' }}
                                </button>
                            </td>
                        </tr>
                        <tr v-if="!data.draws || !data.draws.length">
                            <td colspan="8">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../laroute.js';
    import deferred from 'deferred';
    import async from 'async';
    import COMMON from '../../../common';
    import HeaderTools from './HeaderTools.vue';
    import FilterTools from './FilterTools.vue';
    import moment from 'moment';
    import timestamp2date from '../../../filter/timestamp2date.js';
    import _ from 'lodash';

    export default {
        data() {
            const week = moment().weekday();
            const dateTo = week >= 3 && week != 6 ? moment().endOf('week') : moment().startOf('week').add(3, 'days');
            const date = {
                dateFrom: moment().add(-1, 'months'),
                dateTo: dateTo, // thứ 4 hoặc thứ 7 tiếp theo
            };
            //console.log(week, date)
            return {
                game_id: 1,
                games: _games,
                date,
                data: {},
                result: [],
                api: laroute.route('api::get.game.results'),
                size: 20,
                params: { 
                    page: 0,
                },
                checkAll: false,
            }
        },


        asyncData(resolve, reject) {
            const vm = this;
            async.parallel({
                data(cb) {
                    vm._fetcDatas(vm.api, {...vm.params, 'game-names': vm.gameName, size: vm.size, 'date-from': vm._makeTimestamp(vm.date.dateFrom), 'date-to': vm._makeTimestamp(vm.date.dateTo)}).done(data => {
                        cb(null, data);
                    }, err => {
                        cb(new Error(err));
                    });
                },
                result(cb) {
                    const date = {
                        date_from: typeof vm.date.dateFrom === 'string' ? vm.date.dateFrom : vm.date.dateFrom.format('YYYY-MM-DD'), 
                        date_to: typeof vm.date.dateTo === 'string' ? vm.date.dateTo : vm.date.dateTo.format('YYYY-MM-DD')
                    };
                    vm._fetchResults(date).done(data => {
                        cb(null, data);
                    }, err => {
                        cb(new Error(err));
                    });
                }
            }, (err, results) => {
                if(err) {
                    COMMON.alertError();
                } else {
                    resolve({ ...results });
                }
            });
            
        },

        watch: {
            size() {
                this.$emit('go-to-page', { page: 0 });
            },
        },

        computed: {
            gameName() {
                return _.find(this.games, { id: this.game_id }).name;
            }
        },

        methods: {
            _fetcDatas(api, params={}) {
                const def = deferred();
                this.$http.get(api, params).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },
            _fetchResults(date) {
                const def = deferred();
                this.$http.get(laroute.route('admin.get.result.nj', {game_id: this.game_id}), date).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },
            _makeTimestamp(date) {
                const d = typeof date === 'string' ? date : date.format('MM/DD/YYYY hh:mm:ss');
                return new Date(d).getTime();
            },
            assignToResult(powerball) {
                this.$http.post(laroute.route('admin.post.assign.result', {game_id: this.game_id}), powerball).then(res => {
                    toastr.success('Assign to result success');
                    this.result.push(res.data);
                }, res => {
                    if(res.status === 500) {
                        COMMON.alertError();
                    } else {
                        toastr.error(res.data.message || 'Something wrong');
                    }
                });
            },
            checkWaiting(pb) {
                return pb.status === 'OPEN' || !pb.results;
            },
            checkAssigned(pb) {
                return this.result.indexOf(parseInt(pb.id)) !== -1;
            }
        },

        filters: {
            timestamp2date,
            remove2CharLast(val) {
                return String(val).slice(0, -2)
            }
        },

        events: {
            'go-to-page'(params) {
                Object.assign(this.params, params);
                this.reloadAsyncData();
            }
        },

        components: { FilterTools, HeaderTools }
    }
</script>