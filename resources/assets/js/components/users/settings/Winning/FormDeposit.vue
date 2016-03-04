<template>
	<form class="deposit"  @submit.prevent="onSubmit" v-show="status" novalidate>
		<h2>Payment on account:</h2>
		<hr>

		<div class="form-group">
			<label>Select Credit card: <sup class="text-danger">*</sup></label>
	        <select class="form-control" v-model="formInpus.payment">
	        	<option 
	        		v-for="payment in payments" 
	        		v-text="payment.card_brand + ' **** ' + payment.card_last_four + ' ' + payment.card_name" 
	        		:value="payment.id"></option>
	        </select>
		</div>

		<div class="form-group">
	        <label>The money transfer: <sup class="text-danger">*</sup></label>
	        <input type="text" class="form-control" autocomplete="off" v-model="formInpus.amount">
	    </div>

	    <div class="form-group">
	        <label>Description:</label>
	        <textarea class="form-control" maxlength="255" v-model="formInpus.description"></textarea>
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

	        <button type="submit" class="btn btn-info" :disabled="submiting" @click="onCancle"> Cancle </button>
	    </div>

	</form>
</template>

<script>

	export default {
		props: ['payments', 'status'],

		data() {
			return {
				submiting: false,
				message: '',
				formInpus: {}
			}
		},

		ready() {
			// let payment_default = this.payments.filter(payment => payment.default === 1);
			let payment_default = _.find(this.payments, {default: 1});
			console.log(payment_default);
		},

		methods: {
			onSubmit() {

			},
			onCancle() {
				this.status = false;
			}
		}
	}
</script>