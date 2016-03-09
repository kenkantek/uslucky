<template>
	You currently have
	<h3>US <span>{{ amount | currency }}</span> </h3>
	in your account balance
	<hr>
	<slot name="notice-minimum"></slot>
	<hr>
	<div class="actions">
	    <button class="btn btn-danger" @click="openDeposit" :disabled="statusForm.deposit">
	    	Deposit account <i class="fa fa-play"></i>
	    </button>
	    <button class="btn btn-info"  @click="openClaim" :disabled="statusForm.claim">
	    	Claim your winnings <i class="fa fa-play"></i>
	    </button>
	</div>

	<div class="transactions">
		<hr>
		<form-deposit :payments="payments" :status-form.sync="statusForm" :amount.sync="amount"></form-deposit>
		<form-claim :status-form.sync="statusForm" :amount.sync="amount"></form-claim>
	</div>
</template>

<script>
	import laroute from '../../../../laroute';
	import FormDeposit from './FormDeposit.vue';
	import FormClaim from './FormClaim.vue';

	export default {
		data() {
			return {
                amount: _amount,
                minimum: _minimum_amount,
				payments: [],
				statusForm: {
					deposit: false,
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
					this.statusForm = {
						deposit: true,
						claim: false
					};
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
						location.href = laroute.route('front::settings.payment');
					});
				}
			},

			openClaim() {
				if(Number(this.amount) > Number(this.minimum)) {
					this.statusForm = {
					    deposit: false,
					    claim: true
					};
				} else {
					toastr.warning(`Your currenttly $${this.amount} is less than $${this.minimum}.`, 'Warning!');
				}
			}
		},

		components: { FormDeposit, FormClaim }
	}
</script>