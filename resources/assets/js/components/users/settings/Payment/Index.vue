<template>
	<button class="btn btn-danger" @click="addNewCard">Add payment methods</button>
	<hr>

	<div v-show="!payments.length">
		<slot name="warning-no-payment"></slot>
	</div>
	
	<div v-show="!payment.show">
	    <!-- <form-card :payment.sync="payment"></form-card> -->
	    <h3></h3> <h3></h3>
	</div>

	<div v-el v-for="payment in payments">
		<div class="panel panel-default" v-show="payment.show">
			<div class="panel-heading">
				<h3 class="panel-title">
					<strong>{{ payment.card_brand | uppercase }} ****{{ payment.card_last_four }} </strong>
					<small class="pull-right"><strong>Last updated</strong> <em>{{ payment.updated_at }}</em></small>
				</h3>
			</div>
			<div class="panel-body">
				<p><strong>FULL NAME:</strong> <span>{{ payment.card_name }}</span></p>
				<p><strong>EXPIRY DATE:</strong> <span>{{ payment.month_exp | twoChaMonth }} / {{ payment.year_exp }}</span></p>
			</div>
			<div class="panel-footer clearfix">
				<a href="#" class="pull-right" @click.prevent="onOpenEdit(payment.id, $event)"><strong>Edit</strong></a>
			</div>
		</div>
		<form-card :payment.sync="payment"></form-card>
	</div>
</template>

<script>
	import FormCard  from './Form.vue';

	export default {
		data() {
			return {
				payments: [],
				payment: {
					card_name: '',
					card_brand: '',
					card_last_four: '',
					month_exp: 1,
					year_exp: 2022,
					show: false
				}
			}
		},

		ready() {
			this.date = _date;
			this.payments = _payments.map(payment => ({...payment, show: true}));
			Stripe.setPublishableKey(_stripe.key);
		},

		methods: {
			onOpenEdit(id) {
				this.$broadcast('change-status', id);
			},

			addNewCard() {
				this.payments.unshift({...this.payment, uid: Math.random()});
			}
		},

		filters: {
			twoChaMonth(data) {
				return data < 10 ? '0' + data : data;
			}
		},

		components: { FormCard }
	}
</script>