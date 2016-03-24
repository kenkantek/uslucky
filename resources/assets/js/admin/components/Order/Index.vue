<template>
    <div class="portlet light ">
        <header-tools :prints-url="printsUrl" :delete-url="deleteUrl">
            <slot slot="header" name="header"></slot>
        </header-tools>
        <div class="portlet-body">
            
            <filter-tools 
                :data.sync="data"
                :keyword.sync="keyword"
            >
            </filter-tools>

            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th><input type="checkbox" v-model="checkAll"></th>
                            <th>#ID</th>
                            <th colspan="2">MEMBER</th>
                            <th> Game Type </th>
                            <th> Total Ticket </th>
                            <th> Bought Date </th>
                            <th>Draw Date</th>
                            <th colspan="2"> Description </th>
                            <th> Status </th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td><input type="checkbox" v-model="ids" :value="order.id"></td>

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

                            <td>
                                <span 
                                    class="label"
                                    :class="[order.status.status == 'purchased' ? 'label-success' : 'label-danger']"
                                >{{ order.status.status }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a class="label label-default" :href="order.id | linkShow"><i class="fa fa-eye"></i></a>
                                <a class="label label-info" target="_blank" :href="order.id | linkPrint"><i class="fa fa-print"></i></a>
                                <a class="label label-danger" @click.prevent="onDelete(order.id)"><i class="fa fa-remove"></i></a>
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
                api: laroute.route('admin.get.orders'),
                data: {
                    per_page: "10",
                },
                keyword: '',
                ids: [],
                checkAll: false
            }
        },


        asyncData(resolve, reject) {
            console.log(this.keyword)
            this._fetchOrders(this.api).done(data => {
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
            },
            checkAll(val) {
                this.ids = val ? this.data.data.map(order => { return order.id }) : [];
            }
        },

        computed: {
            timeForReload() {
                return Math.random(this.keyword);
            },

            // ids(){
            //     return this.checkAll ? this.data.data.map(order => { return order.id }) : [];
            // },

            printsUrl() {
                return this.ids.length ? this.$options.filters.linkPrint(this.ids) : null;
            },

            deleteUrl() {
                return this.ids.length ? this.$options.filters.linkDelete(this.ids) : null;
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
            },

            onDelete(ids){
                swal({
                        title: "Are you sure delete this order?",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, (isConfirm) => {
                        if(isConfirm) {
                            this.$http.delete(laroute.route('admin.orders.destroy', { 'orders': [ids]})).then(res => {
                                swal.close();
                                this.reloadAsyncData();
                                return res;
                            }, (res) => {
                                if(res.status === 500) {
                                    COMMON.alertError();
                                }
                                }
                            );
                        } else {
                            swal.close();
                        }
                    });
            }

        },

        filters: {
            linkShow(orders) {
                return laroute.route('admin.orders.show', { orders });
            },
            linkPrint(ids){
                return laroute.route('get.prints')+'/?' + $.param({ids: typeof ids == 'object' ? ids : [ids]}).replace(/%5B%5D/g, '[]');
            },
        },

        events: {
            'go-to-page'(api) {
                this.api = api;
                this.reloadAsyncData();
            }
        },

        components: { HeaderTools, FilterTools }
    }
</script>