<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <div class="row">
            <div class="col-xs-6">
                <dl class="dl-horizontal">
                    <dt>Bought date</dt>
                    <dd>{{order.created_at}}</dd>
                    <dt>Draw date</dt>
                    <dd>{{order.draw_at}}</dd>
                    <dt>Description</dt>
                    <dd>{{order.description}}</dd>
                </dl>
            </div>
            <div class="col-xs-6">
                <dl class="dl-horizontal">
                    <dt>Game type</dt>
                    <dd>{{order.game_name}}</dd>
                    <dt>Extra</dt>
                    <dd><span class="label label-info"> {{ order.extra ? 'Yes' : 'No' }} </span></dd>
                    <dt>Price total</dt>
                    <dd>{{order.price | currency}}</dd>
                    <dt>Status</dt>
                    <dd>
                        <span 
                            class="label"
                            :class="[order.status.status === 'purchased' ? 'label-success' : 'label-danger']"
                        >{{order.status.status}}</span>
                    </dd>
                </dl>
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