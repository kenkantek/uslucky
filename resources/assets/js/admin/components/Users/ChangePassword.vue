<template>
	<form @submit.prevent="onSubmit" novalidate>
	    <div class="form-group" :class="{'has-error' : formErrors.password}">
	        <label class="control-label">New Password</label>
	        <input type="password" v-model="formInputs.password" class="form-control" />
	        <span class="help-block" v-show="formErrors.password" v-text="formErrors.password"></span> 
	    </div>
	    <div class="form-group" :class="{'has-error' : formErrors.password_confirmation}">
	        <label class="control-label">Re-type New Password</label>
	        <input type="password" v-model="formInputs.password_confirmation" class="form-control" /> 
			<span class="help-block" v-show="formErrors.password_confirmation" v-text="formErrors.password_confirmation"></span>
	    </div>
	    <div class="margin-top-10">
	        <button type="submit" :disabled="submiting" class="btn green"> Change Password</button>
	        <a href="javascript:;" class="btn default"> Cancel </a>
	    </div>
	</form>
</template>

<script>
	import laroute from '../../../laroute.js';
	import COMMON from '../../../common.js';

	export default{
        data(){
            return{
                formInputs : {},
                formErrors : {},
                onSubmmit : false,
                submiting: false,
            }
        },

        props: ['id','fullname'],

        methods: {
            onSubmit(){
                const change_pass = this.formInputs;
                this.submiting = true;
                this.$http.put(laroute.route('admin.put.password',{'user': this.id}), change_pass).then(res => {
                    this.submiting = false;
                    swal({
                        title: "Password of "+ this.fullname +" was changed!",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: false,
                    }, function() {
                        $('#myModal').modal('hide');
                        swal.close();
                    });

                },(res) => {
                    this.formErrors = res.data;
                    this.submiting = false;
                    if(res.status === 500) {
                        COMMON.alertError();
                    } else  {
                        toastr.error('Please check input field!.', 'Validate!');
                    }
                });

            },
        },

    }
</script>