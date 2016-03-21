<template>
	<form id="contact-form" @submit.prevent="onSubmit" novalidate>
	    <div v-if="load === true" class="contact-form-loader"></div>
	    <fieldset>
	        <label>
	            <input type="text" v-model="formInputs.name" placeholder="Your Name">
	            <span class="err" v-show="formErrors.name" v-text="formErrors.name"></span>
	        </label>
	        <label>
	            <input type="text" v-model="formInputs.email" placeholder="Your Email">
	            <span class="err" v-show="formErrors.email" v-text="formErrors.email"></span>
	        </label>
	        <label>
	            <input type="text" v-model="formInputs.phone" placeholder="Your Phone Number">
	            <span class="err" v-show="formErrors.phone" v-text="formErrors.phone"></span>
	        </label>
	        <label>
	            <textarea v-model="formInputs.message" placeholder="Message"></textarea>
	            <span class="err" v-show="formErrors.message" v-text="formErrors.message"></span>
	        </label>
	        <!-- <label class="recaptcha"><span class="empty-message">*This field is required.</span></label> -->
	        <div class="btns">
	            <button type="reset" class="link">reset</button>
	            <button type="submit" class="link" :disabled="submiting">
	                <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"> submit
	            </button>
	        </div>
	    </fieldset>
	</form>
</template>

<script>
	import laroute from '../../laroute';
	import BOX from '../../common';

	export default {
		data() {
			return {
				formInputs: typeof _userFb === 'undefined' ? {} : {..._userFb},
				formErrors: {},
				submiting: false
			}
		},

		methods: {
			onSubmit(e) {
				this.submiting = true;
				this.$http.post('/register', this.formInputs).then(res => {
					this.submiting = false;
					swal({
					    title: "Account create successfully!",
					    timer: 2000,
					    text: "Auto redirect to profile in 2 seconds.",
					    type: "info",
					    closeOnConfirm: false,
					    showLoaderOnConfirm: true,
					}, () => {
						location.href = laroute.route('front::settings.account');
					    setTimeout(() =>{}, 2000);
					});

				}, (res) => {
					this.formErrors = res.data;
					this.submiting = false;
					if(res.status === 500) {
						BOX.alertError();
					} else  {
						toastr.error('Please check input field!.', 'Validate!');
					}
				});
			}
		}
	}
</script>