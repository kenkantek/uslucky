<template>
        <form class="claim"  @submit.prevent="onSubmit" v-show="statusForm.claim" novalidate>
            <h2>Claim your winnings:</h2>
            <hr>

            <div class="form-group" :class="{'has-error': formErrors.amount}">
                <label>The money transfer (USD): <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" autocomplete="off" v-model="formInputs.amount">
                <span class="help-block" v-show="formErrors.amount" v-text="formErrors.amount"></span>
            </div>

            <div class="form-group" :class="{'has-error': formErrors.description}">
                <label>Description: <sup class="text-danger">*</sup></label>
                <textarea class="form-control" maxlength="255" v-model="formInputs.description"></textarea>
                <span class="help-block" v-show="formErrors.description" v-text="formErrors.description"></span>
            </div>

            <div class="form-group">
                <div class="error-notice" v-show="message">
                  <div class="oaerror danger">
                    <strong>Error</strong> - {{ message }}
                  </div>
                  <hr>
                </div>
                <button type="submit" class="btn btn-primary" :disabled="submiting">
                    <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Continue Claim
                </button>

                <button type="button" class="btn btn-info" :disabled="submiting" @click="onCancle"> Cancle </button>
            </div>

        </form>
</template>

<script>
    import laroute  from '../../../../laroute';
    import BOX from '../../../../common';


    export default {
        props: ['amount', 'statusForm'],

        data() {            
            return {
                submiting: false,
                message: '',
                formInputs: {},
                formErrors: {}
            }
        },

        methods: {
            onSubmit(e) {
                const form  = e.target;
                this.message = '';
                this.formErrors = {};
                swal({
                    title: "Are you sure?",
                    text: "Submit to claim your winnings",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, (isConfirm) => {

                    if(isConfirm) {
                        this.submiting = true;
                        this.$http.post(laroute.route('front::post.claim'), this.formInputs).then(res => {
                            if(res && typeof res.data === 'number') {
                                this.amount = res.data;
                                this.$set('statusForm.claim', false);
                                form.reset();
                            }
                            this.submiting = false;

                            swal({
                                title: "Notice!",
                                text: "Claim pendding!Please go to Payment history for view.",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Go to Payment History",
                                closeOnConfirm: false
                            }, () => {
                                location.href = laroute.route('front::payment.history');
                            });

                        }, res => {
                            this.submiting = false;
                            if(res.status === 500) {
                                BOX.alertError();
                            } else if(res.status === 422) { // validate
                                swal.close();
                                this.formErrors = res.data;
                                toastr.error('Please check input field!.', 'Validate!');
                            } else { // 400
                                swal.close();
                                this.message = res.data.message;
                            }
                        });    
                    }
                    
                });
            },
            onCancle() {
                this.$set('statusForm.claim', false);
            }
        }
    }
</script>