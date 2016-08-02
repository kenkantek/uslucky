<style scoped>
    .modal-header {
        padding-bottom: 5px;
    }

    .modal-footer {
        padding: 0;
    }

    .modal-footer .btn-group button {
        height:40px;
        border-top-left-radius : 0;
        border-top-right-radius : 0;
        border: none;
        border-right: 1px solid #ddd
    ;    }

    .modal-footer .btn-group:last-child > button {
        border-right: 0;
    }

    .select {
        margin-top: 10px;
    }
</style>

<template>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" @click.stop="closeModal">
                    <span>×</span><span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title">{{ $l('play.modal_title') }} {{ totalView | currency }}</h3>
            </div>
            <div class="modal-body">
                <div v-if="$loadingAsyncData">
                    <div v-if="message">
                        {{{ message }}}
                            <span v-show="!checkLogin">
                                Click <a  @click.stop="closeModal" href="/login?redirect=front::game.{{ name }}">here</a> and try again.
                            </span>
                    </div>
                    <loading v-else></loading>
                </div>
                <div v-else>
                    <form class="form-horizontal" v-else>
                        <div class="">
                            <label for="payment-switch">{{ $l('play.modal_choose') }} <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="method" value="1">
                                {{ $l('play.modal_balance') }} <strong>({{ amount | currency }})</strong>.
                                <span class="text-danger" v-show="method == 1 && amount < total">
                                    {{ $l('play.modal_afford') }}
                                    <a @click.stop="closeModal" :href="linkTo.winning" target="_blank">
                                        {{ $l('play.modal_button_add') }}
                                    </a>
                                </span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="method" value="2">
                                {{ $l('play.modal_credit') }}
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" v-model="method" value="3">
                                支付宝
                            </label>
                            <form-card v-show="method == 2" :form-inputs.sync="formInputs"></form-card>
                            <form-alipay v-show="method == 3" :form-inputs.sync="formInputs" :sms_id.sync="sms_id" :total="total"></form-alipay>
                        </div>
                        <hr>
                        <div style="display:none">
                            <label for="form-description">{{ $l('play.modal_des_credit') }}</label>
                            <textarea id="form-description" class="form-control" v-model="description"></textarea>
                        </div>
                        <coupon :discount.sync="discount" :coupon.sync="coupon"></coupon>
                    </form>
                </div>

            </div>
            <div class="modal-footer" v-if="!$loadingAsyncData">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-success" @click.stop="closeModal">
                            {{ $l('play.modal_button_cancel') }}
                        </button>
                    </div>
                    <div class="btn-group" role="group">
                        <button
                                type="button"
                                class="btn btn-danger btn-hover-green"
                                :disabled="!readySubmit"
                                @click="onSubmit">{{ $l('play.modal_button_submit') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import laroute from '../../../laroute';
    import BOX from '../../../common';
    import FormCard from './FormCard.vue';
    import FormAlipay from './FormAlipay.vue';
    import async from 'async';
    import Coupon from './Coupon.vue';

    export default {
        props: ['tickets', 'total', 'extra', 'submiting', 'name'],

        data() {
            return {
                message: '',
                amount: 0,
                payments: [],
                method: 0,
                payment: null,
                description: '',
                checkLogin: false,
                linkTo: {
                    winning: laroute.route('front::settings.winning'),
                    payment: laroute.route('front::settings.payment')
                },
                source: null,
                formInputs: {
                    exp_month: 1,
                    exp_year: new Date().getFullYear()
                },
                discount: 0,
                coupon: '',
                sms_id : '',
                stripe: _stripKey,
            }
        },

        computed: {
            readySubmit() {
                if((this.method == 2) ||(this.method == 3)|| (this.method == 1 && this.amount >= this.total)) {
                    return true;
                }

                return false;
            },

            totalView() {
                return this.total - (this.total * this.discount) / 100;
            }
        },

        asyncData(resolve, reject) {
            this.$http.get(laroute.route('front::purchase.payment')).then(res => {
                resolve({ ...res.data, checkLogin: true});
        }, res => {
                let message = '';
                if(res.status === 401) {
                    this.checkLogin = false;
                    message = this.$l('play.message');
                } else if(res.status === 500) {
                    message = this.$l('play.message_err');
                }
                this.message = message;
            });
        },

        methods: {
            onSubmit() {
                swal({
                    text: this.$l('play.modal_swal'),
                    title: this.$options.filters.currency(this.totalView),
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, () => {
                    const vm = this;
                this.submiting = true;
                this.message = '';
                async.waterfall([
                            (cb) => {
                            if(vm.method == 2) {
                    Stripe.card.createToken(this.formInputs, (status, res) => {
                        if(res.error) {
                        cb(new Error(res.error.message));
                    } else {
                        console.log(res.id);
                        cb(null, res.id);
                    }
                });
                } else if (vm.method == 3) {
                    $.ajax({
                        url: 'https://api.stripe.com/v1/alipay/verify_user?email='+this.formInputs.email+'&sms_id='+this.sms_id+'&user_last5='+this.formInputs.id5+'&sms_verification_code='+this.formInputs.sms_code+'&key='+this.stripe,
                        method: 'post',
                        success: function(res) {
                            if(res.error) {
                                cb(new Error(res.error.message));
                            } else {
                                console.log(res.id);
                                cb(null, res.id);
                            }
                        },
                        error: function(xhr, status, text) {
                            var response = $.parseJSON(xhr.responseText);

                            console.log('111111!');

                            if (response) {
                                cb(new Error(response.error.message));
                            } else {
                                // This would mean an invalid response from the server - maybe the site went down or whatever...
                            }
                        }
                    });
                } else {
                    cb(null, null);
                }
            }
            ], (err, result) => {
                    if(err) {
                        swal(this.$l('message.payment_invalid'), err.message, "error");
                    } else {
                        vm.$http.post(laroute.route(`front::post.${vm.name}`), {
                            tickets: vm.tickets,
                            extra: vm.extra,
                            method: vm.method,
                            payment: vm.payment,
                            description: vm.description,
                            source: result,
                            coupon: vm.coupon
                        }).then(res => {
                            swal({
                                    title: this.$l('message.success'),
                                text: this.$l('message.ticket_purchased'),
                                type: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: this.$l('message.go_to_order'),
                                closeOnConfirm: false
                    }, () => {
                            location.href = laroute.route('front::orders.index');
                        });
                        localStorage.removeItem(`tickets_${_game_id}`);
                        localStorage.removeItem(`extra_${_game_id}`);
                        vm.closeModal();
                    }, res => {
                            if(res.status === 400)  {
                                swal.close();
                                swal(this.$l('message.payment_invalid'), res.data.message, "error");
                            } else {
                                BOX.alertError();
                            }
                            vm.submiting = false;
                        });
                    }

                });

            });
            },

            closeModal() {
                $('#squarespaceModal').modal('hide');
                this.submiting = false;
            }
        },

        components: { FormCard, Coupon, FormAlipay }
    }
</script>