<template>
	You currently have
	<h3>US <span>$ 0.00</span> </h3>
	in your account balance
	<hr>
	<slot name="notice-minimum"></slot>
	<hr>
	<div class="actions">
	    <button class="btn btn-danger" @click="openDeposit" :disabled="statusForm.desposit">
	    	Deposit account <i class="fa fa-play"></i>
	    </button>
	    <button class="btn btn-info">Claim your winnings <i class="fa fa-play"></i></button>
	</div>

	<div class="transactions">
		<hr>
		<form-deposit :payments="payments" :status.sync="statusForm.desposit"></form-deposit>
	</div>
</template>

<script>
	import FormDeposit from './FormDeposit.vue';

	export default {
		data() {
			return {
				payments: [],
				statusForm: {
					desposit: false,
					claim: false
				}
			}
		},

		ready() {
			this.payments = _payments;
		},

		methods: {
			openDeposit(e) {
				if(this.payments.length) {
					this.$set('statusForm.desposit', true);
				} else {
					swal({
						title: "Warning!", 
						text: "Please update payment methods", 
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes",
						closeOnConfirm: false
					}, () => {
						location.href = _link.payment;
					});
				}
			}
		},

		components: { FormDeposit }
	}
</script>