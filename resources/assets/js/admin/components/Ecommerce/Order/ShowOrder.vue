<template>
    <div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
    <div v-else class="portlet light ">
        <slot slot="header" name="header"></slot>
        <div class="portlet-body">
            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <dl class="dl-horizontal">
                        <dt>Member</dt>
                        <dd class="text-uppercase">
                            <strong>{{ order.user.fullname }}</strong>
                        </dd>

                        <dt>Bought date:</dt>
                        <dd>{{order.created_at}}</dd>


                        <dt>Description:</dt>
                        <dd>{{ order.description }}</dd>
                    </dl>
                </div>

                <div class="col-xs-6 col-md-4">
                    <dl class="dl-horizontal">

                        <dt>Quantity:</dt>
                        <dd>{{order.products.length}}</dd>

                        <dt>Total:</dt>
                        <dd>{{order.total | currency}}</dd>

                        <dt>Status:</dt>
                        <dd>
                            <span 
                                class="label"
                                :class="{
                                    'label-success': order.status.status == 'succeeded',
                                    'label-danger': order.status.status == 'pendding',
                                    'label-info': order.status.status == 'pending purchase'
                                }"
                            >{{ order.status.status }}
                            </span>
                        </dd>
                    </dl>
                </div>

                <div class="col-xs-6 col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Change status to ...</label>
                            <select 
                                :disabled="submiting" 
                                @change.prevent="onChangeStatus" 
                                v-model="order.status.status" 
                                class="form-control status"
                            >
                                <option v-if="order.status.status == 'pendding'" value="pendding">Pendding</option>
                                <option v-if="order.status.status != 'succeeded'" value="pending purchase">Pending Purchase</option>
                                <option value="succeeded">Succeeded</option>
                            </select>
                            <div v-if="submiting"><loading></loading></div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="table-scrollable table-scrollable-borderless">
                <table class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th> Thumb </th>
                            <th> Name </th>
                            <th> Price </th>
                            <th> Count </th>
                            <th> Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in order.products">
                            <td>
                                <img :src="product.thumb" height="100">
                            </td>
                            <td v-text="product.name"></td>
                            <td v-text="product.pivot.price | currency"></td>
                            <td v-text="product.pivot.count"></td>
                            <td v-text="calcPrice(product.pivot) | currency"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import laroute from '../../../../laroute';
import COMMON from '../../../../common';
import deferred from 'deferred';
import _ from 'lodash';

export default {
    props: ['id'],

    data() {
        return {
            order: {},
            reload: false,
            submiting: false,
            dropzone: null,
            uploading: false
        }
    },

    asyncData(resolve, reject) {
        this.submiting = false;
        this._fetchOrder(laroute.route('ecommerce.api.order.show', {order: this.id})).done(order => {
            resolve({
                order
            });
        }, err => {
            COMMON.alertError();
        });
    },

    watch: {
        timeForReload: 'reloadAsyncData',
    },

    computed: {
        timeForReload() {
            return Math.random(this.reload);
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
        },

        onChangeStatus() {
            this.submiting = true;
            this.$http.put(laroute.route('ecommerce.api.order.update.status', {order: this.order.id}), this.order).then(res => {
                this.submiting = false;
                toastr.success('Updated status success.');
            }, (res) => {
                this.submiting = false;
                COMMON.alertError();
            });
        },

        calcPrice({ price, count }) {
            return price * count
        }
    },
}
</script>