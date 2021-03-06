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

                        <dt>Draw date:</dt>
                        <dd>{{order.draw_date}}</dd>

                        <dt>Description:</dt>
                        <dd>{{ order.description }}</dd>
                    </dl>
                </div>

                <div class="col-xs-6 col-md-4">
                    <dl class="dl-horizontal">
                        <dt>Game</dt>
                        <dd>{{order.game_name}}</dd>

                        <dt>Extra:</dt>
                        <dd><span class="label label-info" v-text="order.extra ? 'Yes' : 'No'"></span></dd>

                        <dt>Price total:</dt>
                        <dd>{{order.price | currency}}</dd>

                        <dt>Status:</dt>
                        <dd>
                            <span 
                                class="label"
                                :class="{
                                    'label-success': order.status.status == 'purchased' || order.status.status == 'canceled',
                                    'label-danger': order.status.status == 'order placed' || order.status.status == 'pending purchase'
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
                                <option v-if="statusShowBtn.canceled" value="canceled">Cancel</option>
                                <option v-if="statusShowBtn.order_placed" value="order placed">Order Placed</option>
                                <option v-if="statusShowBtn.pending_purchase" value="pending purchase">Pending Purchase</option>
                                <option v-if="statusShowBtn.purchased" value="purchased">Purchased</option>
                            </select>
                            <div v-if="submiting"><loading></loading></div>
                        </div>
                        <div class="col-md-6">
                            <a target="_blank" :href="order.id | linkPrint">
                                <i class="fa fa-print fa-5x margin-top-30"></i>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="table-scrollable table-scrollable-borderless">
                <table class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th> Number </th>
                            <th> Status </th>
                            <th> Prize </th>
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
                                <label class="label"
                                    :class="{
                                        'label-success': ticket.status.status == 'won',
                                        'label-danger': ticket.status.status == 'fail',
                                        'label-warning': ticket.status.status == 'waiting'
                                    }"
                                >
                                    {{ ticket.status.status }}
                                </label>
                            </td>
                            <td>
                                <span v-if="ticket.award">{{ticket.award.level.label}}</span>
                                <span v-else>N/A</span>
                            </td>
                            <td>
                                <span v-if="ticket.award">{{ ticket.reward | currency }}</span>
                                <span v-else>N/A</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <section id="order-images">
            <div class="row">   
                <div class="col-xs-12 col-md-6 col-sm-4">
                    <h3>
                        All Images <strong class="text-danger">({{ order.images.length }})</strong>
                    </h3>
                </div>
                <div class="col-xs-12 col-md-6 col-sm-8">
                    <form class="dropzone" id="dropzone" v-dropzone>
                        <div class="input-group image-preview margin-top-15">
                            <input type="text" class="form-control image-preview-filename disabled" readonly>
                            <span class="input-group-btn">
                                <div class="btn image-preview-input" :class="{uploading: uploading}">
                                    <i class="fa fa-circle-o-notch fa-spin" v-show="uploading"></i> 
                                    <span v-else class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">
                                        {{ uploading ? 'Uploading...' : 'Upload file' }}
                                    </span>
                                    <input type="file" name="file" />
                                </div>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row" v-if="order.images.length">
                        <div class="col-xs-12 col-sm-6 col-md-3" v-for="image in order.images">
                            <div class="image-item">
                                <a :href="image.image" target="_blank">
                                    <img class="img-responsive" :src="image.image">
                                </a>
                                <span class="label text-danger" @click="deleteImage(image)"><i class="fa fa-trash-o fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-center text-danger">No have image.</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import laroute from '../../../laroute';
import COMMON from '../../../common';
import deferred from 'deferred';
import Dropzone from 'dropzone';
import _ from 'lodash';

Dropzone.autoDiscover = false;
export default {
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
        this._fetchOrder(laroute.route('admin.get.order', {order: order_id})).done(order => {
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
        },
        statusShowBtn() {
            const status =  {
                order_placed: false,
                pending_purchase: false,
                purchased: false,
                canceled: false
            };
            const s = this.order.status.status;
            if(s === 'canceled') {
                status.canceled = true;
            } else if(s === 'pending purchase') {
                status.pending_purchase = true;
                status.purchased = true;
            } else if(s === 'purchased'){
                status.purchased = true;
            } else {
                //true All
                return _.mapValues(status, (s) => true);
            }
            return status;
        }
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
        },

        onChangeStatus() {
            this.submiting = true;
            this.$http.put(laroute.route('admin.orders.update', {orders: this.order.id}), this.order).then(res => {
                this.submiting = false;
                toastr.success('Updated status success.');
            }, (res) => {
                this.submiting = false;
                COMMON.alertError();
            });
        },

        initDropzone() {
            const vm = this;
            this.$nextTick(() => {
                this.dropzone = new Dropzone("#dropzone", {
                    url: laroute.route('admin.post.files.order', { order: this.order.id }),
                    previewTemplate : '<div class="display:none"></div>',
                    params: { _token },
                    maxFilesize: 10,
                    acceptedFiles: 'image/*',
                    init() {
                        this.on('sending', (file, res) => {
                            vm.uploading = true;
                        });
                        this.on('success', (file, res) => {
                            toastr.success(`${file.name} has been upload success.`, '', { positionClass: "toast-bottom-right" });
                            vm.order.images.unshift(res);
                        });
                        this.on('error', (file, res) => {
                            toastr.error(file.xhr && file.xhr.status === 500 ? 'Somthing wrong, please try again!' : res, '', { positionClass: "toast-bottom-right" });
                        });
                        this.on('queuecomplete', () => {
                            vm.uploading = false;
                        });
                    }
                });
            });
         },
         deleteImage(image) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, () => {
                this.$http.delete(laroute.route('admin.delete.file.order', { order: this.order.id, id: image.id })).then(res => {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    this.order.images = this.order.images.filter(image => image.id !== res.data.id);
                }, res => {
                    if(res.status === 500) {
                        COMMON.alertError();
                    } else {
                        COMMON.alertError(res.data.message);
                    }
                });
            });
         },
    },

    directives: {
        dropzone: {
            bind() {
                this.vm.initDropzone();
            }
        }
    }
}
</script>