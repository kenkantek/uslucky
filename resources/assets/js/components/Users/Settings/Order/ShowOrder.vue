<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-else>
        <div class="row">
            <div class="col-xs-6">
                <dl class="dl-horizontal">
                    <dt>Game type</dt>
                    <dd>{{order.game_name}}</dd>

                    <dt>Bought date</dt>
                    <dd>{{order.created_at}}</dd>

                    <dt>Draw date</dt>
                    <dd>{{order.draw_at}}</dd>

                    <dt>Description</dt>
                    <dd>{{order.description.trim() ? order.description : 'N/A'}}</dd>
                </dl>
            </div>
            <div class="col-xs-6">
                <dl class="dl-horizontal">
                    <dt>Extra</dt>
                    <dd><span class="label label-info"> {{ order.extra ? 'Yes' : 'No' }} </span></dd>

                    <dt>Price total</dt>
                    <dd>{{order.price | currency}}</dd>

                    <dt>Status</dt>
                    <dd>
                        <span 
                            class="label"
                            :class="{
                                'label-success': order.status.status == 'purchased' || order.status.status == 'canceled',
                                'label-danger': order.status.status == 'Order Placed' || order.status.status == 'Pending Purchase'
                            }"
                        >{{order.status.status}}</span>
                    </dd>

                    <dt></dt>
                    <dd class="margin-top-10" v-if="order.status.status == 'Order Placed'">
                        <button class="btn btn-primary" @click="onCancle">Cancle</button>
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
                    <th>Prize</th>
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
                        <label class="label label-success" v-if="ticket.status.status == 'won'">{{ ticket.status.status }}</label>
                        <label class="label label-danger" v-if="ticket.status.status == 'fail'">{{ ticket.status.status }}</label>
                        <label class="label label-warning" v-if="ticket.status.status == 'waiting'">{{ ticket.status.status }}</label>
                    </td>
                    <td>{{ticket.award ? ticket.award.level.label : 'N/A'}}</td>
                    <td>{{ticket.award ? prizeMoney(ticket.award) : 'N/A' | currency}}</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-xs-12">
                <div class="row" v-if="order.images.length">
                    <div class="col-xs-12 col-sm-6 col-md-3" v-for="image in order.images">
                        <div class="image-item">
                            <a :href="image.image" target="_blank">
                                <img class="img-responsive" :src="image.image">
                            </a>
                        </div>
                    </div>
                </div>
                <p v-else class="text-center text-danger">No have image.</p>
            </div>
        </div>
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
            },

            prizeMoney(award) {
                let prize = parseFloat(award.level.award) + parseFloat(award.add_award);
                const extra = award.level.level == 1 ? false : this.order.extra;
                return extra ? prize * this.result.multiplier : prize;
            },

            onCancle() {
                swal({
                    title: "Are you sure?",
                    text: "Cancle order",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, cancle it!",
                    cancelButtonText: "No, cancel plx!",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, () => {
                    this.$http.put(laroute.route('front::api::put.order.cancel', {order: this.order.id})).then(res => {
                        this.order.status.status = 'canceled';
                        swal.close();
                        toastr.success(res.data);
                    }, res => {
                        BOX.alertError();
                    });
                });
            }
        },
}
</script>
