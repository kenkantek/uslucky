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
                    <h3 class="modal-title">Purchase {{ total | currency }}</h3>
                </div>
                <div class="modal-body">
                    <div v-if="$loadingAsyncData">
                        <div v-if="message">
                            {{{ message }}}
                            <span v-show="!checkLogin">
                                Click <a  @click.stop="closeModal" href="/login?redirect=front::game.powerball">here</a> and try again.
                            </span>
                        </div>
                        <loading v-else></loading>
                    </div>
                    <div v-else>
                        <form class="form-horizontal" v-else>
                            <div class="">
                                <label for="payment-switch">Choose method payment <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" v-model="method" value="1">
                                Account balance <strong>({{ amount | currency }})</strong>.
                                <span class="text-danger" v-show="method == 1 && amount < total">
                                    You can not afford to buy it.
                                    <a @click.stop="closeModal" :href="linkTo.winning" target="_blank">Add now</a>
                                </span>
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" v-model="method" value="2">
                                By credit card
                              </label>
                              <form-card v-show="method == 2" :form-inputs.sync="formInputs"></form-card>
                            </div>
                            <hr>
                            <div class="">
                                <label for="form-description">Description</label>
                                <textarea id="form-description" class="form-control" v-model="description"></textarea>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="modal-footer" v-if="!$loadingAsyncData">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success" @click.stop="closeModal">Cancle</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button 
                                type="button" 
                                class="btn btn-danger btn-hover-green" 
                                :disabled="!readySubmit"
                                @click="onSubmit">Submit
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
    import async from 'async';

    export default {
        props: ['tickets', 'total', 'extra', 'submiting'],

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
            }
        },

        computed: {
            readySubmit() {
                if((this.method == 2) || (this.method == 1 && this.amount >= this.total)) {
                    return true;
                }

                return false;
            }
        },

        asyncData(resolve, reject) {
            this.$http.get(laroute.route('front::game.get.payment')).then(res => {
                resolve({ ...res.data, checkLogin: true});
            }, res => {
                let message = '';
                if(res.status === 401) {
                    this.checkLogin = false;
                    message = `You need login to Purchase ticket.`;
                } else if(res.status === 500) {
                    message = 'Something wrong, please try again!';
                }
                this.message = message;
            });
        },

        methods: {
            onSubmit() {
                swal({
                    text: "Are you sure purchase it?",
                    title: this.$options.filters.currency(this.total),
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
                                        cb(null, res.id);
                                    }
                                });
                            } else {
                                cb(null, null);
                            }
                        }
                    ], (err, result) => {
                        if(err) {
                            swal("Payment Invalid", err.message, "error");
                        } else {
                            vm.$http.post(laroute.route('front::post.powerball'), { tickets: vm.tickets, extra: vm.extra, method: vm.method, payment: vm.payment, description: vm.description, source: result }).then(res => {
                                swal({
                                    title: "Success!",
                                    text: "You has been purchased tickets successfully!",
                                    type: "success",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Go to Your Orders!",
                                    closeOnConfirm: false
                                }, () => {
                                    location.href = laroute.route('front::orders.index');
                                });
                                localStorage.removeItem("tickets");
                                localStorage.removeItem("extra");
                                vm.closeModal();
                            }, res => {
                                if(res.status === 400)  {
                                    swal.close();
                                    swal("Payment Invalid", res.data.message, "error");
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

        components: { FormCard }
    }
</script>