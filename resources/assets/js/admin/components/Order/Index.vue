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
                <table v-else class="table table-hover table-light">
                    <thead>
                        <tr class="uppercase">
                            <th>
                            <div class="checker">
                                <span><input type="checkbox" class="group-checkable"></span>
                            </div>
                            </th>
                            <th>#</th>
                            <th colspan="2">MEMBER</th>
                            <th> Game Type </th>
                            <th> Total Ticket </th>
                            <th> Total Price </th>
                            <th colspan="2"> Description </th>
                            <th>Draw At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in data.data">
                            <td>
                                <div class="checker"><span><input type="checkbox" value="1"></span></div>
                            </td>

                            <td>{{ order.id }}</td>

                            <td class="fit"> 
                                <img class="user-pic" :src="order.user.image"> 
                            </td>

                            <td>
                                <a href="javascript:;" class="primary-link">{{ order.user.fullname }}</a>
                            </td>

                            <td>{{ order.game_name }}</td>

                            <td>{{ order.ticket_total }}</td>

                            <td>
                                <span class="bold theme-font">{{ order.price | currency }}</span>
                            </td>

                            <td colspan="2">{{ order.description }}</td>

                            <td>{{ order.draw_at }}</td>

                            <td class="text-center">
                                <a class="label label-default" href="#"><i class="fa fa-eye"></i></a>
                                <a class="label label-info" href="#"><i class="fa fa-print"></i></a>
                                <a class="label label-danger" href="#"><i class="fa fa-remove"></i></a>
                            </td>
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
                    per_page: "10"
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
            _fetchOrders(api, keyword = this.keyword, take = this.data.per_page) {
                const def = deferred();
                this.$http.get(api, { keyword, take }).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });

                return  def.promise;
            }
        },

        components: { HeaderTools, FilterTools }
    }
</script>