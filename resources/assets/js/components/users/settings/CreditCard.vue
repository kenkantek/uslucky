<template>
	<slot name="warning-no-payment" v-show="!payments.length"></slot>
	
	<form @submit.prevent="onSubmit" novalidate v-show="!payments.length || viewForm">
	    <div class="form-group">
	        <label>Credit Card Numbe: <sup class="text-danger">*</sup></label>
	        <input type="text" class="form-control" autocomplete="off" size="20" data-stripe="number" v-model="card.number">
	    </div>
	    <div class="form-group">
	        <div class="row clearfix">
    	        <label class="col-xs-12">Expiration Date: <sup class="text-danger">*</sup></label>
    	        <div class="col-xs-3">    		        
    		        <select class="form-control" data-stripe="exp-month">
    		        	<option v-for="val in date.month" v-text="val" :value="$index + 1"></option>
    		        </select>
    	        </div>
    	        <div class="col-xs-2">
    	        	<select class="form-control" data-stripe="exp-year">
    		        	<option v-for="val in date.year" v-text="val" :value="val"></option>
    		        </select>
    	        </div>
	        </div>
	    </div>
	    <div class="form-group">
	        <label>CVV Number: <sup class="text-danger">*</sup></label>
	        <input type="text" class="form-control" autocomplete="off" size="4" data-stripe="cvc" v-model="card.cvv">
	    </div>

	    <div class="form-group">
	    	<div class="error-notice" v-show="message">
	          <div class="oaerror danger">
	            <strong>Error</strong> - {{ message }}
	          </div>
	          <hr>
	        </div>
	        <button type="submit" class="btn btn-primary" :disabled="submiting">
	            <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Update Credit Card
	        </button>
	    </div>

	</form>
</template>

<script>
	export default {
		data() {
			return {
				date: {},
				payments: [],
				submiting: false,
				card: {},
				viewForm: false,
				message: ''
			}
		},

		ready() {
			this.date = _date;
			this.payments = _payments;
			Stripe.setPublishableKey(_stripe.key);
		},

		methods: {
			onSubmit(e) {
				this.submiting = true;
				const form = e.target;
				Stripe.card.createToken(form, (status, res) => {
					this.submiting = false;
					if (res.error) {
						this.message = res.error.message;
						toastr.error(this.message, 'Error');
					} else {
						this.message = '';
						const token = res.id;
					}
				});
			}
		}
	}
</script>