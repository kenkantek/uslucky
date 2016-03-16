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
</style>

<template>
    <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" @click.stop="closeModal">
                        <span>×</span><span class="sr-only">Close</span>
                    </button>
                    <h3 class="modal-title">Purchase {{ total | currency }}</h3>
                </div>
                <div class="modal-body">
                    <div v-if="$loadingAsyncData">
                        <div v-if="message">{{{ message }}}</div>
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
                                Account balance <strong>({{ amount | currency }})</strong>
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" v-model="method" value="2">
                                By credit card
                              </label>
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
                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancle</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-danger btn-hover-green" @click="comingSoon('coming soon...')">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import laroute from '../../../laroute';
    import BOX from '../../../common';

    export default {
        props: ['ticketsActive', 'total', 'extra', 'submiting'],

        data() {
            return {
                message: '',
                amount: 0,
                payments: [],
                method: 1,
                description: ''
            }
        },

        asyncData(resolve, reject) {
            this.$http.get(laroute.route('front::game.get.payment')).then(res => {
                const { payments, amount: {amount} }  = res.data;
                resolve({ amount, payments });
            }, res => {
                let message = '';
                if(res.status === 401) {
                    message = `You need login to Purchase ticket. Click <a data-dismiss="modal" onClick="window.open('/login')">here</a> and try again.`;
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
                    this.submiting = true;
                    this.$http.post(laroute.route('front::post.powerball'), { tickets: this.ticketsActive, extra: this.extra }).then(res => {
                        swal({
                            title: "Notice!",
                            text: "You has been purchased tickets successfully!",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Go to Payment History",
                            closeOnConfirm: false
                        }, () => {
                            location.href = laroute.route('front::payment.history');
                        });
                        this.submiting = false;
                    }, res => {
                        if(res.status === 500) {
                            BOX.alertError();
                        } else  {
                            toastr.error('Can not purchase tickets, Please try again!', 'Error!');
                        }
                        swal.close();
                        this.submiting = false;
                        console.warn(res);
                    });
                });
            },

            closeModal() {
                $('#squarespaceModal').modal('hide');
                if(this.message) {
                    this.submiting = false;
                }
            },

            comingSoon(m) {
                alert(m);
            }
        }
    }
</script>