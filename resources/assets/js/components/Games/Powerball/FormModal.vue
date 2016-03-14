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
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span><span class="sr-only">Close</span>
                    </button>
                    <h3 class="modal-title">Purchase {{ total | currency }}</h3>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form class="form-horizontal">
                        <div class="">
                            <label for="payment-switch">Choose method payment <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="methods">
                            Account balance
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="methods">
                            By credit card
                          </label>
                        </div>
                        <div class="">
                            <label for="form-description">Description</label>
                            <textarea id="form-description" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
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
        props: ['ticketsActive', 'total', 'extra'],

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

            comingSoon(m) {
                alert(m);
            }
        }
    }
</script>