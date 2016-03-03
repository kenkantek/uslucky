<template>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="onSubmit" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group" :class="{'has-error' : formErrors.old_password}">
                            <label>Your old password: <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" autocomplete="off" v-model="formInputs.old_password">
                            <span class="help-block" v-show="formErrors.old_password" v-text="formErrors.old_password"></span>
                        </div>
                        <div class="form-group" :class="{'has-error' : formErrors.password}">
                            <label>New password: <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" autocomplete="off" v-model="formInputs.password">
                            <span class="help-block" v-show="formErrors.password" v-text="formErrors.password"></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm your new password: <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" autocomplete="off" v-model="formInputs.password_confirmation">
                            <span class="help-block" v-show="formErrors.password_confirmation" v-text="formErrors.password_confirmation"></span>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary":disabled="submiting">
                        <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Save changes
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>
<script>
    import BOX from '../../../../common'
    export default{
        data(){
            return{
                formInputs : {},
                formErrors : {},
                onSubmmit : false
            }
        },

        methods: {
            onSubmit(){
                const change_pass = this.formInputs;
                this.submiting = true;
                this.$http.put(_changepass, change_pass).then(res => {
                    this.submiting = false;
                    swal({
                        title: "Your password was changed!",
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
                        BOX.alertError();
                    } else  {
                        toastr.error('Please check input field!.', 'Validate!');
                    }
                });

            },
        },

    }
</script>