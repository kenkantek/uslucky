<template>
	<form @submit.prevent="onSubmit" novalidate v-show="!payment.show">
		<div class="form-group">
	        <label>Fullname: <sup class="text-danger">*</sup></label>
	        <input type="text" class="form-control" autocomplete="off" size="20" v-model="card.card_name">
	    </div>

	    <div class="form-group">
	        <label>Credit Card Number: <sup class="text-danger">*</sup></label>
	        <input type="text" class="form-control" autocomplete="off" size="20" data-stripe="number" v-model="card.card_number" placeholder="**** **** **** {{ card.card_last_four }}">
	    </div>
	    <div class="form-group">
	        <div class="row clearfix">
    	        <label class="col-xs-12">Expiration Date: <sup class="text-danger">*</sup></label>
    	        <div class="col-xs-3">    		        
    		        <select class="form-control" data-stripe="exp-month" v-model="card.month_exp">
    		        	<option v-for="val in date.month" v-text="val" :value="$index + 1"></option>
    		        </select>
    	        </div>
    	        <div class="col-xs-2">
    	        	<select class="form-control" data-stripe="exp-year" v-model="card.year_exp">
    		        	<option v-for="val in date.year" v-text="val" :value="val"></option>
    		        </select>
    	        </div>
	        </div>
	    </div>
	    <div class="form-group">
	        <label>CVV Number: <sup class="text-danger">*</sup></label>
	        <input type="text" class="form-control" autocomplete="off" size="4" data-stripe="cvc" v-model="card.cvv" placeholder="CVV">
	    </div>

	    <div>
	        <label>
	        	Payment default: <input type="checkbox" v-model="card.default"> 
	        </label>
	        <h3></h3>
	    </div>

	    <div class="form-group">
	    	<div class="error-notice" v-show="message">
	          <div class="oaerror danger">
	            <strong>Error</strong> - {{ message }}
	          </div>
	          <hr>
	        </div>
	        <button type="submit" class="btn btn-primary" :disabled="submiting">
	            <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> {{ card.id ? 'Update' : 'Add' }} Credit Card
	        </button>
	        <button class="btn btn-info" @click.prevent="onCloseForm" :disabled="submiting">Cancle</button>
	    </div>
		
		<hr> <h3></h3>
	</form>
</template>

<script>
	import laroute from '../../../../laroute';
	import BOX from '../../../../common';

	export default {
		props: ['payment'],

		data() {
			return {
				date: _date,
				submiting: false,
				card: {...this.payment},
				message: ''
			}
		},

		methods: {
			onCloseForm() {
				if(this.payment.id) {
					this.payment.show = true;
				} else {
					this.$dispatch('remove-form-card', this.payment);
					this.$remove();
				}
			},

			onSubmit(e) {
				this.submiting = true;
				const form = e.target;
				Stripe.card.createToken(form, (status, res) => {
					if (res.error) {
						this.submiting = false;
						this.message = res.error.message;
						toastr.error(this.message, 'Error');
					} else {
						this.message = '';
						if(this.card.id) {
							this._updateCard(res.id);
						} else {
							this._addCard(res.id);
						}
					}
				});
			},

			_addCard(source) {
				this.$http.post(laroute.route('front::post.payment'), { ...this.card, source }).then(res => {
					this.__processSuccessCard(res, 'Add ew credit card successfully.');
				}, res => {
					this.__processFailCard(res);
				});
			},

			_updateCard(source) {
				this.$http.put(laroute.route('front::put.payment', {one: this.payment.id}), { ...this.card, source }).then(res => {
					this.__processSuccessCard(res);
				}, res => {
					this.__processFailCard(res);
				});
			},

			__processSuccessCard(res, message = 'Update credit card successfully.') {
				this.submiting = false;
				toastr.success(message, 'Success!');
				this.payment = {...this.card, ...res.data, show: true};
			},

			__processFailCard(res) {
				this.submiting = false;
				if(res.status === 500) {
					BOX.alertError();
				} else  {
					this.message = res.data.card_name || 'Somthing wrong fields.';
				}
			}

		},

		events: {
			'change-status'(id) {
				if(this.payment.id === id)
					this.payment.show = false;
			}
		},
	}
</script>