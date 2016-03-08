<template>
	<form class="deposit"  @submit.prevent="onSubmit" v-show="status" novalidate>
		<h2>Payment on account:</h2>
		<hr>

		<div class="form-group" :class="{'has-error': formErrors.payment}">
			<label>Select Credit card: <sup class="text-danger">*</sup></label>
	        <select class="form-control" v-model="formInputs.payment">
	        	<option 
	        		v-for="payment in payments" 
	        		v-text="payment.card_brand + ' **** ' + payment.card_last_four + ' ' + payment.card_name" 
	        		:value="payment.id"></option>
	        </select>
            <span class="help-block" v-show="formErrors.payment" v-text="formErrors.payment"></span>
		</div>

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
	            <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Continue
	        </button>

	        <button type="button" class="btn btn-info" :disabled="submiting" @click="onCancle"> Cancle </button>
	    </div>

	</form>
</template>

<script>
    import BOX from '../../../../common';

	export default {
		props: ['amount', 'payments', 'status'],

		data() {			
			return {
				submiting: false,
				message: '',
				formInputs: {},
                formErrors: {}
			}
		},

		watch: {
			payments(payments, o) {
				let payment = _.find(payments, { default: 1 });
				payment = payment ? payment : payments[0];
				this.$set('formInputs.payment', payment.id);
			}
		},

		methods: {
			onSubmit() {
                this.message = '';
                this.formErrors = {};
                swal({
                    title: "Are you sure?",
                    text: "Submit to run ajax request",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, (isConfirm) => {

                    if(isConfirm) {
                        this.submiting = true;
                        this.$http.post(_api.charge, this.formInputs).then(res => {
                            this.submiting = false;
                            swal("Charged!", "Charged successfully!", "success");
                        }, res => {
                            this.submiting = false;
                            if(res.status === 500) {
                                BOX.alertError('Ooop!', "Something wrong! Plesae check your credit card.");
                            } else if(res.status === 422) { // validate
                                swal.close();
                                this.formErrors = res.data;
                            } else { // 401 eror payment
                                swal.close();
                                this.message = res.data.message;
                            }
                        });    
                    }
                    
                });
			},
			onCancle() {
				this.status = false;
			}
		}
	}
</script>