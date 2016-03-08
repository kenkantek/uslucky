<template>
	<form class="form-horizontal" @submit.prevent="onSubmit" novalidate>
		<div class="form-group" :class="{'has-error': formErrors.email}">
			<label class="col-md-4 control-label">E-Mail <sup class="text-danger">*</sup></label>
			<div class="col-md-6">
				<input type="email" class="form-control" v-model="formInputs.email" autocomplete="off">
				<span class="help-block" v-show="formErrors.email" v-text="formErrors.email"></span>
			</div>
		</div>

		<div class="form-group" :class="{'has-error': formErrors.password}">
			<label class="col-md-4 control-label">Password <sup class="text-danger">*</sup></label>
			<div class="col-md-6">
				<input type="password" class="form-control" v-model="formInputs.password" autocomplete="off">
				<span class="help-block" v-show="formErrors.password" v-text="formErrors.password"></span>
			</div>
		</div>
		<div class="form-group" v-show="formErrors.message">
			<div class="col-md-6 col-md-offset-4">
				<span class="help-block err" v-text="formErrors.message"></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<div class="checkbox">
					<label>
						<input type="checkbox" v-model="formInputs.remember"> Remember Me
					</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary" :disabled="submiting">
					<i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Sign In
				</button>
				<a class="btn btn-link" href="">Forgot Your Password?</a>
			</div>
		</div>
	</form>
</template>

<script>
	import laroute from '../../laroute';
	import BOX from '../../common';

	export default {
		data() {
			return {
				formInputs: {},
				formErrors: {
					message: ''
				},
				submiting: false
			}
		},

		methods: {
			onSubmit(e) {
				this.submiting = true;
				this.$http.post('/login', this.formInputs).then(res => {
					this.submiting = false;
					swal({
					    title: "Sign In Successful!",
						timer: 2000,
					    text: "Auto redirect to profile",
					    type: "info",
					    closeOnConfirm: false,
					    showLoaderOnConfirm: true,
					}, () => {
						location.href = laroute.route('front::settings.account');
						setTimeout(() =>{}, 2000);
					});

			}, (res) => {
					const status = res.status;
					this.formErrors = {...res.formErrors, ...res.data};
					this.submiting = false;
					if(res.status === 500) {
						BOX.alertError();
					} else if(status === 422)  {
						toastr.error('Please check input field!.', 'Validate!');
					}
				});
			}
		}
	}
</script>