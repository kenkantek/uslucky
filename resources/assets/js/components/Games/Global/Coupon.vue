<template>
	<br>
	<form 
		method="post"
		:action="applyUrl"
		v-submit="formInputs"
		:submiting="onSubmiting"
		:complete="onComplete"
		:error="onError"
	>
	    <label for="form-coupon">{{ $l('play.coupon') }} 
	    	<strong class="text-danger" v-show="discount">(-{{ discount }} %)</strong>
	    </label>
	    <div class="row">
	        <div class="col-xs-10">
	            <input v-model="formInputs.coupon" id="form-coupon" type="text" class="form-control" :placeholder="$l('play.coupon')" autocomplete="off">
	        </div>
	        <div class="col-xs-2">
	            <button :disabled="submiting || !formInputs.coupon.trim().length" class="btn btn-info">
					<i v-show="submiting" class="fa fa-circle-o-notch fa-spin fa-fw"></i>
	            	{{ $l('play.apply') }}
	            </button>
	        </div>
	    </div>
	</form>
</template>

<script>
	import laroute from '../../../laroute';
	import COMMON from '../../../common';

	export default {
		props: {
			coupon: {
				type: String
			},
			discount: {
				type: [Number, String],
				required: true
			}
		},

		data: () => ({
			formInputs: {
				coupon: ''
			},
			submiting: false
		}),

		computed: {
			applyUrl() {
				return laroute.route('front::api::discount.apply.game', { game: _game_id })
			},

			coupon() {
				return this.discount ? this.formInputs.coupon : '';
			}
		},

		methods: {
			onSubmiting(data) {
				this.submiting = true;
			},
			onComplete({ status, value }) {
				this.submiting = false;

				if(value) {
					if(status === 'expired') {
						return toastr.warning(this.$l('message.coupon_expired'));
					} else {
						toastr.success(this.$l('message.coupon_apply_success'));
						this.discount = value;
						return;
					}
				}
				return toastr.warning(this.$l('message.coupon_404'));
				
			},
			onError(data) {
				this.submiting = false;
				COMMON.alertError();
			}
		}
	}
</script>