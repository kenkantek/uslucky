<template>
	<form class="form-horizontal"  @submit.prevent="onSubmit" novalidate>

	    <div class="form-group" :class="{'has-error': formErrors.first_name}">
	        <label class="col-md-4 control-label">First Name <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="text" class="form-control" v-model="formInputs.first_name" autocomplete="off">
	            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.first_name"></span>
	        </div>
	    </div>

	    <div class="form-group" :class="{'has-error': formErrors.last_name}">
	        <label class="col-md-4 control-label">Last Name <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="text" class="form-control" v-model="formInputs.last_name" autocomplete="off">
	            <span class="help-block" v-show="formErrors.last_name" v-text="formErrors.last_name"></span>
	        </div>
	    </div>



	    <hr>

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

	    <div class="form-group">
	        <label class="col-md-4 control-label">Re-enter Password <sup class="text-danger">*</sup></label>
	        <div class="col-md-6">
	            <input type="password" class="form-control" v-model="formInputs.password_confirmation" autocomplete="off">
	        </div>
	    </div>

	    <div class="form-group">
	        <div class="col-md-6 col-md-offset-4">
	            <button type="submit" class="btn btn-primary" :disabled="submiting">
	                <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Sign Up
	            </button>
	        </div>
	    </div>

	</form>
</template>

<script>
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
					}, function() {
						location.href = _link.account;
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