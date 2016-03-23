<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <table class="table table-bordered table-hover trans" v-if="orders.length" style="margin-bottom: 0px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Game</th>
                    <th>Tickets total</th>
                    <th>Price total</th>
                    <th>Buy date</th>
                    <th>Draw date</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders">
                    <td>{{order.id}}</td>
                    <td>{{order.game.name}}</td>
                    <td>{{order.ticket_total}}</td>
                    <td>{{order.price | currency}}</td>
                    <td>{{order.created_at}}</td>
                    <td>{{order.draw_at}}</td>
                    <td class="text-center">
                        <span 
                            class="label"
                            :class="[order.status.status === 'purchased' ? 'label-success' : 'label-danger']"
                        >{{order.status.status}}</span>
                    </td>
                    <td class="text-center"><a class="link" :href="order.url">View details</a></td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <div class="error-notice" slot="notice-minimum">
                <div class="oaerror info">
                    <p> *You have not order! </p>
                </div>
            </div>
        </div>
    </div>
    <button style="width: 100%" class="link" @click="nextPagination" v-show="nextPageUrl" :disabled="loading">Load more {{ numberMore }} record</button>
    <div v-show="nextPageUrl" style="width: 100%;text-align: center;margin-top: 15px">
        Show {{ orders.length }} of {{ totalOrders }} record.
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
