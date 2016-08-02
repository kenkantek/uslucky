<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <table class="table table-bordered table-hover trans" v-if="orders.length" style="margin-bottom: 0px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{$l('setting.game')}}</th>
                    <th>{{$l('setting.ticket')}}</th>
                    <th>{{$l('setting.price')}}</th>
                    <th>{{$l('setting.date')}}</th>
                    <th>{{$l('setting.draw')}}</th>
                    <th>{{$l('setting.status')}}</th>
                    <th>{{$l('setting.view')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders">
                    <td>{{order.id}}</td>
                    <td>{{order.game.name}}</td>
                    <td>{{order.ticket_total}}</td>
                    <td>{{order.price | currency}}</td>
                    <td>{{order.created_at}}</td>
                    <td>{{order.draw_date}}</td>
                    <td class="text-center">
                        <span 
                            class="label"
                            :class="{
                                'label-success': order.status.status == 'purchased' || order.status.status == 'canceled',
                                'label-danger': order.status.status == 'order placed' || order.status.status == 'pending purchase'
                            }"
                        >{{order.status.status == 'pending purchase' ? '订单处理中' : (order.status.status == 'order placed' ? '订单已下' : (order.status.status == 'purchased' ? '已购买' : order.status.status))}}</span>
                    </td>
                    <td class="text-center"><a class="link" :href="order.url">{{$l('setting.button_details')}}</a></td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <div class="error-notice" slot="notice-minimum">
                <div class="oaerror info">
                    <p> {{$l('setting.not_order')}} </p>
                </div>
            </div>
        </div>
    </div>
    <button style="width: 100%" class="link" @click="nextPagination" v-show="nextPageUrl" :disabled="loading">{{$l('setting.load_more')}} {{ numberMore }} {{$l('setting.record')}}</button>
    <div v-show="nextPageUrl" style="width: 100%;text-align: center;margin-top: 15px">
        {{$l('setting.show')}} {{ orders.length }} {{$l('setting.of')}} {{ totalOrders }} {{$l('setting.record')}}.
    </div>
</template>


<script>
import laroute from '../../../../laroute';
import BOX from '../../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                orders: [],
                total: null,
                numberMore: 10,
                loading: false,
                totalOrders: null,
                nextPageUrl: null
            }
        },

        asyncData(resolve, reject) {
            this._fetchOrder(laroute.route('front::api::get.orders'), this.numberMore).done(orders => {
                resolve({
                    orders
                });
            }, err => {
                BOX.alertError();
            });
        },
   
        methods: {
            _fetchOrder(api, take = 10) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api, { take }).then(res => {
                    const { data } = res;
                    this.loading = false;
                    this.totalOrders = data.total;
                    this.nextPageUrl = data.next_page_url;
                    def.resolve(data.data);
                }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            },
            nextPagination() {
                this._fetchOrder(this.nextPageUrl).done(orders => {
                    this.orders = this.orders.concat(orders);
                }, err => {
                    BOX.alertError();
                });
            }
        },
}
</script>
