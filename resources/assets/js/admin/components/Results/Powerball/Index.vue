<template>
    <div class="portlet light ">
        <header-tools :date.sync="date">
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
                            <th>Date</th>
                            <th>Winning Numbers</th>
                            <th>Power Play</th>
                            <th>Annuity Payout</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pb in data.draws" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td>{{ pb.drawTime | timestamp2date}}</td>
                            <td>
                                <span v-if="pb.status === 'OPEN'" class="label label-danger"> waiting</span>
                                <span v-else v-for="number in pb.results[0].primary">
                                    <strong v-if="$index < 5" v-text="number"></strong>
                                    <strong class="powerball" v-if="$index == 6" v-text="number.slice(-2)"></strong>
                                </span>
                            </td>
                            <td>
                                <span v-if="pb.status === 'OPEN'" class="label label-danger"> waiting</span>
                                <span v-else>{{ pb.results[0].multiplier }}</span>
                            </td>
                            <td>{{ pb.estimatedJackpot | remove2CharLast | currency }}</td>
                            <td>
                                <span class="label" :class="[pb.status === 'OPEN' ? 'label-danger' : 'label-success']">{{ pb.status }}</span>
                            </td>
                            <td class="text-center">
                                <a class="label label-default" href=""><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <tr v-if="!data.draws || !data.draws.length">
                            <td colspan="7">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../../laroute.js';
    import deferred from 'deferred';
    import COMMON from '../../../../common';
    import HeaderTools from '../HeaderTools.vue';
    import FilterTools from '../FilterTools.vue';
    import moment from 'moment';
    import timestamp2date from '../../../../filter/timestamp2date.js';

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
                date,
                data: {},
                api: laroute.route('api::get.game.results'),
                size: 20,
                params: { 
                    page: 0,
                    'game-names': 'Powerball', 
                },
                checkAll: false,
            }
        },


        asyncData(resolve, reject) {
            this._fetchResults(this.api, {...this.params, size: this.size, 'date-from': this._makeTimestamp(this.date.dateFrom), 'date-to': this._makeTimestamp(this.date.dateTo)}).done(data => {
                resolve({ data });
            }, err => {
                COMMON.alertError();
                console.warn(err);
            });
        },

        watch: {
            size() {
                this.$emit('go-to-page', { page: 0 });
            },
        },

        computed: {
        },

        methods: {
            _fetchResults(api, params={}) {
                const def = deferred();
                this.$http.get(api, params).then(res => {
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