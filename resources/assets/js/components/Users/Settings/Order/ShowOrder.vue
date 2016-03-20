<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <table class="table table-bordered table-hover trans">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Buy date</th>
                    <th>Your number</th>
                    <th>Status</th>
                    <th>Draw date</th>
                    <th>Reward</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket in order.tickets">
                    <td>{{ticket.id}}</td>
                    <td>{{ticket.created_at}}</td>
                    <td>
                        <ul class="list">
                            <li v-for="number in ticket.numbers">{{number}}</li>
                            <li class="powerball">{{ticket.ball}}</li>
                        </ul>
                    </td>
                    <td>
                        <label class="label label-success" v-if="ticket.status.status == 'win'">{{ ticket.status.status }}</label>
                        <label class="label label-danger" v-if="ticket.status.status == 'lost'">{{ ticket.status.status }}</label>
                        <label class="label label-warning" v-if="ticket.status.status == 'waiting'">{{ ticket.status.status }}</label>
                    </td>
                    <td>{{ order.draw_at }}</td>
                    <td>$1.600.000.000</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
import laroute from '../../../../laroute';
import BOX from '../../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                order: {}
            }
        },
        asyncData(resolve, reject) {
            this._fetchOrder(laroute.route('front::api::get.order', {order: order_id})).done(order => {
                resolve({
                    order
                });
            }, err => {
                BOX.alertError();
            });
        },
   
        methods: {
            _fetchOrder(api) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api).then(res => {
                    def.resolve(res.data);
                }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            }
        },
}
</script>
