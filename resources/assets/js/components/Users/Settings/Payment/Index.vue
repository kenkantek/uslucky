<style scoped>
	.btn-edit {
		margin-right: 10px;
	}
</style>

<template>
	<div v-if="$loadingAsyncData"> <loading></loading> </div>
	<div v-else>
		<button class="btn btn-danger" @click="addNewCard">Add payment methods</button>
		<hr>

		<div v-show="!payments.length">
			<slot name="warning-no-payment"></slot>
		</div>

		<div v-el v-for="payment in payments">
			<div class="panel panel-default" v-show="payment.id && payment.show">
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>{{ payment.card_brand | uppercase }} ****{{ payment.card_last_four }} </strong>
						<small class="pull-right"><strong>Last updated</strong> <em>{{ payment.updated_at }}</em></small>
					</h3>
				</div>
				<div class="panel-body">
					<p><strong>FULL NAME:</strong> 
						<span>{{ payment.card_name }}</span>
						<span v-show="payment.default" class="label label-info pull-right">Default</span>
					</p>
					<p><strong>EXPIRY DATE:</strong> <span>{{ payment.month_exp | twoChaMonth }} / {{ payment.year_exp }}</span></p>
				</div>
				<div class="panel-footer clearfix">
					<a href="#" class="pull-right label label-danger" @click.prevent="onDelete(payment.id, $event)"><strong>Delete</strong></a>
					<a href="#" class="btn-edit pull-right label label-warning" @click.prevent="onOpenEdit(payment.id, $event)"><strong>Edit</strong></a>
				</div>
			</div>
			<form-card :payment.sync="payment"></form-card>
		</div>
	</div>
</template>

<script>
	import laroute from  '../../../../laroute';
	import FormCard  from './Form.vue';

	export default {
		data() {
			return {
				date: _date,
				payments: [],
				payment: {
					card_name: '',
					card_brand: '',
					card_last_four: '',
					default: 0,
					month_exp: 1,
					year_exp: new Date().getFullYear(),
					show: false
				},
				random_for_reload: null
			}
		},

		asyncData(resolve, reject) {
			this.$http.get(laroute.route('front::get.payments')).then(res => {
				const payments =  res.data.map(payment => ({...payment, show: true}));
				resolve({ payments});
			}, res => {
				BOX.alertError();
				console.warn(res);
			});
		},

		watch: {
			random_for_reload: 'reloadAsyncData'
		},

		methods: {
			onOpenEdit(id) {
				this.$broadcast('change-status', id);
			},

			addNewCard() {
				this.payments.unshift({...this.payment, uid: Math.random()});
			},

			onDelete(id) {
				swal({
				    title: "Are you sure delete it?",
				    type: "info",
				    showCancelButton: true,
				    closeOnConfirm: false,
				    showLoaderOnConfirm: true,
				}, () => {
					this.$http.delete(laroute.route('front::put.payment', {one: id})).then(res => {
				    	toastr.success('Delete Credit card success.', 'Success!');
				    	this.payments = this.payments.filter(payment => payment.id !== id);
				    	swal.close();
				    }, res => {
				    	toastr.error('Can not delete Credit card. Please try again!', 'Error!');
				    	swal.close();
				    	console.warn(res);
				    });
				});
			}
		},

		filters: {
			twoChaMonth(data) {
				return data < 10 ? '0' + data : data;
			}
		},

		events: {
            'remove-form-card'(payment) {
                this.payments.$remove(payment);
            }
        },

		components: { FormCard }
	}
</script>