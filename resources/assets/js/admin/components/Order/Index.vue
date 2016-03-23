<style scoped>
    .move-top {
        transform: translateY(-10px);
        -webkit-transform: translateY(-10px);
    }
</style>
<template>
    <div class="portlet light ">
        <header-tools>
            <slot slot="header" name="header"></slot>
        </header-tools>
        <div class="portlet-body">
            
            <filter-tools 
                :data.sync="data"
                :keyword.sync="keyword"
            >
            </filter-tools>

            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top"><loading></loading></div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th><input type="checkbox" value="1"></th>
                            <th>#ID</th>
                            <th colspan="2">MEMBER</th>
                            <th> Game Type </th>
                            <th> Total Ticket </th>
                            <th> Buy date </th>
                            <th>Draw At</th>
                            <th colspan="2"> Description </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td><input type="checkbox" value="1"></td>

                            <td>{{ order.id }}</td>

                            <td colspan="2"> 
                                <img height="50" :src="order.user.image"> 
                                <a href="javascript:;" class="primary-link">{{ order.user.fullname }}</a>
                            </td>

                            <td>{{ order.game_name }}</td>

                            <td>{{ order.ticket_total }} (<strong>{{ order.price | currency }}</strong>)</td>

                            <td>
                                {{ order.created_at }}
                            </td>

                            <td>{{ order.draw_at }}</td>

                            <td colspan="2">{{ order.description }}</td>

                            <td class="text-center">
                                <a class="label label-default" href="#"><i class="fa fa-eye"></i></a>
                                <a class="label label-info" href="#"><i class="fa fa-print"></i></a>
                                <a class="label label-danger" href="#"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        <tr v-if="!data.data || !data.data.length">
                            <td colspan="12">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../laroute';
    import deferred from 'deferred';
    import COMMON from '../../../common';
    import HeaderTools from './HeaderTools.vue';
    import FilterTools from './FilterTools.vue';

    export default {
        data() {
            return {
                data: {
                    per_page: "10",
                },
                keyword: ''
            }
        },

        asyncData(resolve, reject) {
            this._fetchOrders(laroute.route('admin.get.orders')).done(data => {
                resolve({ data });
            }, err => {
                COMMON.alertError();
                console.warn(err);
            });
        },

        watch: {
            timeForReload: 'reloadAsyncData',
            'data.per_page'(val, old) {
                (val && old) && this.reloadAsyncData();
            }
        },

        computed: {
            timeForReload() {
                return Math.random(this.keyword);
            }
        },

        methods: {
            _fetchOrders(api, take = this.data.per_page, keyword = this.keyword) {
                const def = deferred();
                this.$http.get(api, { take, keyword }).then(res => {
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
                this._fetchOrders(api).done(data => {
                    this.data = data;
                }, res => {
                    COMMON.alertError();
                    console.warn(err);
                });
            }
        },

        components: { HeaderTools, FilterTools }
    }
</script>