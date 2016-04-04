<template>
	<form class="deposit"  @submit.prevent="onSubmit" v-show="statusForm.deposit" novalidate>
		<h2>Payment on account:</h2>
		<hr>

		<div class="form-group" :class="{'has-error': formErrors.number}">
			<label>CARD NUMBER: <sup class="text-danger">*</sup></label>
	        <div class="input-group">
                <input type="text" class="form-control" placeholder="Valid Card Number" data-stripe="number" autofocus v-model="formInputs.number">
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
            </div>
            <span class="help-block" v-show="formErrors.number" v-text="formErrors.number"></span>
		</div>

        <div class="row">
            <div class="col-xs-7 col-md-7">
                
                <div class="form-group" :class="{'has-error': formErrors.exp}">
                    <label><span class="hidden-xs">EXPIRATION</span>
                    <span class="visible-xs-inline">EXP</span> DATE  <sup class="text-danger">*</sup></label>
                    <div class="row">
                        <div class="col-xs-8">                  
                            <select class="form-control" data-stripe="exp-month" v-model="formInputs.month">
                                <option v-for="val in date.month" v-text="val" :value="$index + 1"></option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control" data-stripe="exp-year" v-model="formInputs.year">
                                <option v-for="val in date.year" v-text="val" :value="val"></option>
                            </select>
                        </div>
                    </div>
                    <span class="help-block" v-show="formErrors.exp" v-text="formErrors.exp"></span>
                </div>
            </div>
            <div class="col-xs-5 col-md-5 pull-right">
                <div class="form-group" :class="{'has-error': formErrors.cvc}">
                    <label>CVC <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" data-stripe="cvc" placeholder="CVC" v-model="formInputs.cvc">
                    <span class="help-block" v-show="formErrors.cvc" v-text="formErrors.cvc"></span>
                </div>
            </div>
        </div>

		<div class="form-group" :class="{'has-error': formErrors.amount}">
	        <label>THE MONEY TRANSFER (USD): <sup class="text-danger">*</sup></label>
	        <input type="text" class="form-control" autocomplete="off" v-model="formInputs.amount">
            <span class="help-block" v-show="formErrors.amount" v-text="formErrors.amount"></span>
	    </div>

	    <div class="form-group" :class="{'has-error': formErrors.description}">
	        <label>DESCRIPTION: <sup class="text-danger">*</sup></label>
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
	            <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Continue Charge
	        </button>

	        <button type="button" class="btn btn-info" :disabled="submiting" @click="onCancle"> Cancle </button>
	    </div>

	</form>
</template>

<script>
    import laroute from '../../../../laroute';
    import BOX from '../../../../common';

	export default {
		props: ['amount', 'payments', 'statusForm'],

		data() {			
			return {
				submiting: false,
				message: '',
				formInputs: {
                    month: 1,
                    year: new Date().getFullYear(),
                },
                formErrors: {},
                date: _date
			}
		},

		methods: {
			onSubmit(e) {
                const form  = e.target;
                this.message = '';
                this.formErrors = {};
                swal({
                    title: "Are you sure?",
                    text: "Submit to payment on account",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, (isConfirm) => {

                    if(isConfirm) {
                        this.submiting = true;
                        Stripe.card.createToken($('form'), (status, res) => {
                            if (res.error) {
                                this.submiting = false;
                                this.message = res.error.message;
                                toastr.error(this.message, 'Error');
                                swal.close();
                            } else {
                                this.onCharge(res.id);
                            }
                        });
                    }
                    
                });
			},
            onCharge(source) {
                this.$http.post(laroute.route('front::post.charge'), {...this.formInputs, source}).then(res => {
                    if(res && typeof res.data === 'number') {
                        this.amount = res.data;
                        this.$set('statusForm.deposit', false);
                    }
                    this.submiting = false;
                    swal("Charged!", "Charged successfully!", "success");
                }, res => {
                    this.submiting = false;
                    if(res.status === 500) {
                        BOX.alertError();
                    } else if(res.status === 422) { // validate
                        swal.close();
                        this.formErrors = res.data;
                        toastr.warning('Please check input field!.', 'Validate!');
                    } else { // 400 error payment
                        swal.close();
                        toastr.error(res.data.message);
                        this.message = res.data.message;
                    }
                });
            },
			onCancle() {
				this.$set('statusForm.deposit', false);
			}
		}
	}
</script>