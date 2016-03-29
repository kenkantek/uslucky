<template>
    <div class="portlet light ">
        <header-tools :date.sync="date" :game.sync="game_id" :games="games">
            <slot slot="header" name="header"></slot>
        </header-tools>
        <div class="portlet-body">
            <filter-tool :keyword.sync="keyword" :data.sync="data"></filter-tool>
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
                        <tr v-for="result in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td>{{ result.game.name }}</td>
                            <td>{{ result.draw_at }}</td>
                            <td>
                                <span v-for="number in result.numbers">
                                    <strong v-text="number"></strong>
                                </span>
                                <span>
                                    <strong class="powerball" v-text="result.ball"></strong>
                                </span>
                            </td>
                            <td>{{ result.multiplier }}</td>
                            <td>{{ result.annuity | currency }}</td>
                            <td class="text-center">
                                <span class="label" :class="[result.status.status === 'pendding' ? 'label-danger' : 'label-info']">{{ result.status.status }}</span>
                            </td>
                            <td class="text-center">
                                <a class="label label-default" href="/admin/orders/1"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <tr v-if="!data.data || !data.data.length">
                            <td colspan="5">No records found.</td>
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
    import FilterTool from '../Globals/FilterTools.vue';
    import moment from 'moment';

    export default {
        data() {
            return {
                games: _games,
                game_id: 1,
                date: {
                    dateFrom: moment().add(-1, 'months').format('YYYY/MM/DD'),
                    dateTo: moment().format('YYYY/MM/DD')
                },
                data: {
                    per_page: '10',
                },
                keyword: '',
                api: laroute.route('admin.get.results')
            }
        },

        asyncData(resolve, reject) {
            this._fetchAwards(this.api).done(data => {
                resolve({ data })
            }, err => {
                COMMON.alertError();
            });
        },

        watch: {
            keyword: 'reloadAsyncData',
            'data.per_page'(val, old) {
                (val && old) && this.reloadAsyncData();
            }
        },

        methods: {
            _fetchAwards(api, take = this.data.per_page, keyword = this.keyword, game_id = this.game_id) {
                const def = deferred();
                this.$http.get(api, {...this.date, take, keyword, game_id}).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return  def.promise;
            }
        },

        events: {
            'go-to-page'(api) {
                this.api = api;
                this.reloadAsyncData();
            }
        },

        components: {
            HeaderTools, FilterTool
        }
    }
</script>