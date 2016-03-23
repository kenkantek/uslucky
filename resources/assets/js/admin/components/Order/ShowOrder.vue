<template>
    <div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
    <div v-else class="portlet light ">
        <slot slot="header" name="header"></slot>
        <div class="portlet-body">
            <div class="row well">
                <div class="col-md-5">
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
                        <strong>Description:</strong>
                        <br> {{order.description}}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="col-md-4">
                        <strong>Game</strong>
                    </div>
                    <div class="col-md-8">
                        {{order.game_name}}
                    </div>
                    <div class="col-md-4">
                        <strong>Extra:</strong>
                    </div>
                    <div class="col-md-8">
                        <span class="label label-info" v-text="order.extra ? 'Yes' : 'No'"></span>
                    </div>
                    
                    <div class="col-md-4">
                        <strong>Price total:</strong>
                    </div>
                    <div class="col-md-8">
                        {{order.price | currency}}
                    </div>
                    <div class="col-md-4">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-md-8">
                        <span 
                            class="label"
                            :class="[order.status.status == 'purchased' ? 'label-success' : 'label-danger']"
                        >{{ order.status.status }}
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <a target="_blank" :href="order.id | linkPrint">
                        <i class="fa fa-print fa-5x margin-top-30"></i>
                    </a>
                </div>
            </div>
            <div class="table-scrollable table-scrollable-borderless">
                <table class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th>Number</th>
                            <th> Status </th>
                            <th> Reward </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ticket in order.tickets">
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
        </div>
    </div>
</template>

<script>
import laroute from '../../../laroute';
import COMMON from '../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                order: {}
            }
        },
        asyncData(resolve, reject) {
            this._fetchOrder(laroute.route('admin.get.order', {order: order_id})).done(order => {
                resolve({
                    order
                });
            }, err => {
                COMMON.alertError();
            });
        },

        filters: {
            linkPrint(ids) {
                return laroute.route('get.prints') +'/?' + $.param({ ids: [ids] }).replace('%5B%5D', '[]');
            }
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