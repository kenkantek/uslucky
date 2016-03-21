<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <div class="col-md-6">
            <div class="col-md-4">
                <strong>Bought date:</strong>
            </div>
            <div class="col-md-8">
                {{order.created_at}}
            </div>
            <div class="col-md-4">
                <strong>Draw date:</strong>
            </div>
            <div class="col-md-8">
                {{order.draw_at}}
            </div>
            <div class="col-md-12">
                <strong>Description:</strong><br>
                {{order.description}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-4">
                <strong>Game</strong>
            </div>
            <div class="col-md-8">
                {{order.game.name}}
            </div>
            <div class="col-md-4">
                <strong>Extra:</strong>
            </div>
            <div class="col-md-8">
                <span v-if="order.extra == '1'">Yes</span>
                <span v-else>No</span>
            </div>
            <div class="col-md-4">
                <strong>Tickets total:</strong>
            </div>
            <div class="col-md-8">
                {{order.ticket_total}}
            </div>
            <div class="col-md-4">
                <strong>Price total:</strong>
            </div>
            <div class="col-md-8">
                {{order.price | currency}}
            </div>
        </div>
        <table class="table table-bordered table-hover trans">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Your number</th>
                    <th>Status</th>
                    <th>Reward</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket in order.tickets">
                    <td>{{ticket.id}}</td>
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
