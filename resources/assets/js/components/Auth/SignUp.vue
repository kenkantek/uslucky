<template>
	<form class="form-horizontal"  @submit.prevent="onSubmit" novalidate>

	    <div class="form-group" :class="{'has-error': formErrors.first_name}">
	        <label class="col-md-4 control-label">{{ $l('auth.first_name') }} <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="text" class="form-control" v-model="formInputs.first_name" autocomplete="off">
	            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.first_name"></span>
	        </div>
	    </div>

	    <div class="form-group" :class="{'has-error': formErrors.last_name}">
	        <label class="col-md-4 control-label">{{ $l('auth.last_name') }} <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="text" class="form-control" v-model="formInputs.last_name" autocomplete="off">
	            <span class="help-block" v-show="formErrors.last_name" v-text="formErrors.last_name"></span>
	        </div>
	    </div>

	    <div class="form-group" :class="{'has-error': formErrors.birthday}">
	        <label class="col-md-4 control-label">{{ $l('auth.birthday') }} <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">

	            <div class="row">
					<div class="col-xs-3">
						<label>{{ $l('auth.day') }}</label>
						<select class="form-control" v-model="birthday.day">
							<option v-for="day in date.day" :value="day" v-text="day"></option>
						</select>
					</div>

					<div class="col-xs-5">
						<label>{{ $l('auth.month') }}</label>
						<select class="form-control" v-model="birthday.month">
							<option v-for="month in date.month" :value="$index + 1 | padLeft 2 '0'" v-text="month"></option>
						</select>
					</div>

					<div class="col-xs-4">
						<label>{{ $l('auth.year') }}</label>
						<select class="form-control" v-model="birthday.year">
							<option v-for="year in date.year" :value="year" v-text="year"></option>
						</select>
					</div>
              	</div>

	            <span class="help-block" v-show="formErrors.birthday" v-text="formErrors.birthday"></span>
	        </div>
	    </div>

	    <hr>

	    <div class="form-group" :class="{'has-error': formErrors.email}">
	        <label class="col-md-4 control-label">{{ $l('auth.email') }} <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="email" class="form-control" v-model="formInputs.email" autocomplete="off">
	            <span class="help-block" v-show="formErrors.email" v-text="formErrors.email"></span>
	        </div>
	    </div>

	    <div class="form-group" :class="{'has-error': formErrors.password}">
	        <label class="col-md-4 control-label">{{ $l('auth.password') }} <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="password" class="form-control" v-model="formInputs.password" autocomplete="off">
	            <span class="help-block" v-show="formErrors.password" v-text="formErrors.password"></span>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-4 control-label">{{ $l('auth.confirm_password') }} <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="password" class="form-control" v-model="formInputs.password_confirmation" autocomplete="off">
	        </div>
	    </div>

	    <div class="form-group">
	        <div class="col-md-6 col-md-offset-4">
	            <button type="submit" class="link" :disabled="submiting">
	                <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> {{ $l('auth.signup') }}
	            </button> 
	            <a class="link" href="/login">{{ $l('auth.or_login') }}</a>
	        </div>
	    </div>

	</form>
</template>

<script>
	import _ from 'lodash';

	import Datepicker from '../Globals/Datepicker.vue';
	import laroute from '../../laroute';
	import COMMON from '../../common';

	export default {
		data() {
			return {
				date: _date,
				birthday: {},
				formInputs: typeof _userFb === 'undefined' ? {} : {..._userFb},
				formErrors: {},
				submiting: false
			}
		},

		watch: {
			birthday: {
				deep: true,
				handler(val) {
					this.formInputs.birthday = `${val.year}-${val.month}-${val.day}`;
				}
			}
		},

		methods: {
			onSubmit(e) {
				this.submiting = true;
				this.$http.post('/register', this.formInputs).then(res => {
					this.submiting = false;
					swal({
					    title: this.$l('message.signup_success'),
					    timer: 2000,
					    text: this.$l('message.wait_redirect'),
					    type: "info",
					    closeOnConfirm: false,
					    showLoaderOnConfirm: true,
					}, () => {
						location.href = laroute.route('front::settings.account');
					    setTimeout(() =>{}, 1000);
					});

				}, (res) => {
					this.formErrors = res.data;
					this.submiting = false;
					if(res.status === 500) {
						COMMON.alertError();
					} else  {
						toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
					}
				});
			}
		},

		filters: {
			padLeft(val, length = 0, str = '') {
				return _.padStart(val, length, str);
			}
		},

		components: { Datepicker }
	}
</script>