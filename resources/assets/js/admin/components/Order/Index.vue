<template>
    <div class="portlet light ">
        <header-tools>
            <slot slot="header" name="header"></slot>
        </header-tools>
        <div class="portlet-body">
            <filter-tools></filter-tools>

            <div class="table-scrollable table-scrollable-borderless">
                <div style="transform: translateY(-10px);-webkit-transform: translateY(-10px);"><loading v-if="$loadingAsyncData"></loading></div>
                <table v-else class="table table-hover table-light">
                    <thead>
                        <tr class="uppercase">
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
                        <tr v-for="order in orders">
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
                totalOrder: null,
                nextPageUrl: null,
                prevPageUrl: null,
                perPage: 1,
                orders: []
            }
        },

        asyncData(resolve, reject) {
            this._fetchOrders(laroute.route('admin.get.orders')).done(data => {
                resolve({
                    totalOrder: data.total,
                    nextPageUrl: data.next_page_url,
                    prevPageUrl: data.prev_page_url,
                    orders: data.data
                });
            }, err => {
                BOX.alertError();
                console.warn(err);
            });
        },

        methods: {
            _fetchOrders(api, take = this.perPage) {
                const def = deferred();
                this.$http.get(api, { take }).then(res => {
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