<template>
	<form class="form-horizontal" @submit.prevent="onSubmit" novalidate>
		<div class="form-group" :class="{'has-error': formErrors.email}">
			<label class="col-md-4 control-label">{{ $l('auth.email') }} <sup class="text-danger">*</sup></label>
			<div class="col-md-4">
				<input type="email" class="form-control" v-model="formInputs.email" autocomplete="off">
				<span class="help-block" v-show="formErrors.email" v-text="formErrors.email"></span>
			</div>
		</div>

		<div class="form-group" :class="{'has-error': formErrors.password}">
			<label class="col-md-4 control-label">{{ $l('auth.password') }} <sup class="text-danger">*</sup></label>
			<div class="col-md-4">
				<input type="password" class="form-control" v-model="formInputs.password" autocomplete="off">
				<span class="help-block" v-show="formErrors.password" v-text="formErrors.password"></span>
			</div>
		</div>
		<div class="form-group" v-show="formErrors.message">
			<div class="col-md-4 col-md-offset-4">
				<span class="help-block err" v-text="formErrors.message"></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-4">
				<div class="checkbox">
					<label>
						<input type="checkbox" v-model="formInputs.remember"> {{ $l('auth.remember_me') }}
					</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-4 col-md-offset-4">
				<button type="submit" class="link" :disabled="submiting">
					<i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> {{ $l('auth.signin') }}
				</button>
				<!--<a href="auth/facebook" class="link">-->
					<!--<i class="fa fa-facebook"></i> {{ $l('auth.signin_fb') }}-->
				<!--</a>--><br>
				<a href="password/reset" class="btn btn-link">{{ $l('auth.forgot_password') }}</a>
				<br>
				<a href="register" class="btn btn-link">{{ $l('auth.or_register') }}</a>
			</div>
		</div>
	</form>
</template>

<script>
	import laroute from '../../laroute';
	import COMMOM from '../../common';

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
					const redirect = COMMOM.getQuerystring('redirect');
					const route = redirect ? redirect : 'front::home';
					location.href = laroute.route(route);

			}, (res) => {
					const status = res.status;
					this.formErrors = {...res.formErrors, ...res.data};
					this.submiting = false;
					if(res.status === 500) {
						COMMOM.alertError();
					} else if(status === 422)  {
						toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
					}
				});
			}
		}
	}
</script>