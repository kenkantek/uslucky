<template>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="onSubmit" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{$l('setting.modal_title')}}</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group" :class="{'has-error' : formErrors.old_password}">
                            <label>{{$l('setting.modal_old')}}: <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" autocomplete="off" v-model="formInputs.old_password">
                            <span class="help-block" v-show="formErrors.old_password" v-text="formErrors.old_password"></span>
                        </div>
                        <div class="form-group" :class="{'has-error' : formErrors.password}">
                            <label>{{$l('setting.modal_pass')}}: <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" autocomplete="off" v-model="formInputs.password">
                            <span class="help-block" v-show="formErrors.password" v-text="formErrors.password"></span>
                        </div>
                        <div class="form-group">
                            <label>{{$l('setting.modal_confirm')}}: <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" autocomplete="off" v-model="formInputs.password_confirmation">
                            <span class="help-block" v-show="formErrors.password_confirmation" v-text="formErrors.password_confirmation"></span>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="link" style="opacity:0.5" data-dismiss="modal">{{$l('setting.modal_button_close')}}</button>
                    <button type="submit" class="link":disabled="submiting">
                        <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> {{$l('setting.modal_button_save')}}
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
                onSubmmit : false,
                submiting: false,
            }
        },

        methods: {
            onSubmit(){
                const change_pass = this.formInputs;
                this.submiting = true;
                this.$http.put(_changepass, change_pass).then(res => {
                    this.submiting = false;
                    swal({
                        title: this.$l('message.passwords_updated'),
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
                        toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
                    }
                });

            },
        },

    }
</script>