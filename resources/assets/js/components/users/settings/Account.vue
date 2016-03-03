<template>
    <div v-if="$loadingAsyncData">Loading...</div>
    <div class="col-md-4 col-md-offset-8">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Change Password
        </button>
    </div>
    <form  v-if="!$loadingAsyncData" class="" @submit.prevent="onSubmit" novalidate>
        <div class="form-group">
            <label>Avatar: <sup class="text-danger">*</sup></label>
            <img :src="user.image" alt="" @click="getFilePathFromDialog($event)" style="max-width: 200px">
            <span>Click image to change</span><br />
            <span class="help-block" v-show="formErrors.avatar" v-text="formErrors.avatar"></span><br>
            <input type="file" @change="onChangeAvatar($event)" accept="image/*" v-el:input-avatar class="hidden" />
        </div>
        <div class="form-group col-md-4" :class="{'has-error': formErrors.first_name}">
            <label>First Name: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.first_name">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.first_name"></span>
        </div>
        <div class="form-group col-md-4" :class="{'has-error': formErrors.last_name}">
            <label>Last Name: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.last_name">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.last_name"></span>
        </div>
        <div class="form-group col-md-4" :class="{'has-error': formErrors.birthday}">
            <label>Birthday: <sup class="text-danger">*</sup></label>
            <input type="date" class="form-control" autocomplete="off" v-model="user.birthday">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.birthday"></span>
        </div>
        <div class="form-group" :class="{'has-error': formErrors.email}">
            <label>Email:</label>
            <input readonly type="text" class="form-control" autocomplete="off" v-model="user.email">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.email"></span>
        </div>
        <div class="form-group" :class="{'has-error': formErrors.phone}">
            <label>Phone: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.phone">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.phone"></span>
        </div>
        <div class="form-group">
            <label>Address: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.address">
        </div>
        <div class="form-group">
            <label>Country: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.county">
        </div>
        <div class="form-group">
            <label>State: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.state">
        </div>
        <div class="form-group">
            <label>City: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.city">
        </div>
        <div class="form-group" :class="{'has-error': formErrors.zipcode}">
            <label>Zipcode: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.zipcode">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.zipcode"></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Update Account
            </button>
        </div>

    </form>




    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import BOX from '../../../common';

    export default {

        data() {
            return {
                user: {},
                formErrors: {},
                submiting: false
            }
        },

        asyncData(resolve, reject){
            this.$http.get(_api.user).then(res => {
                const user = res.data;

                resolve({
                    user
                });

            }, (res) => {
                BOX.alertError();
            });
        },


        methods: {
            getFilePathFromDialog(event){
                this.$els.inputAvatar.click();
            },
            onSubmit() {
                const user = this.user;
                this.submiting = true;
                this.$http.put(_api.put_account, user).then(res => {
                    this.submiting = false;
                swal({
                    title: "Account edit successfully!",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
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
            },

            onChangeAvatar(event) {
                const images = event.target.files;




                if (images.length) {
                    let formData = new FormData();
                    let image = images[0];
                    formData.append('avatar', image);

                    var reader = new FileReader();

                    reader.onload =  (e) => {
                        this.$set('user.image', e.target.result);
                    };




                    swal({
                        title: "Your avatar was updated!",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, (isConfirm) => {

                        if(isConfirm) {
                            reader.readAsDataURL(image);

                            this.$http.post(_api.put_avatar, formData).then(res => {
                                this.submiting = false;
                                swal.close();
                            }, (res) => {
                                    this.formErrors = res.data;
                                    if(res.status === 500) {
                                        BOX.alertError();
                                    } else  {
                                        toastr.error('Please check input field!.', 'Validate!');
                                    }
                                }

                            );


                        } else {
                            swal.close();
                        }
                    });




                } else {
                    return false;
                }


            }
        }

    }

</script>