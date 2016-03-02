<template>
    <div v-if="$loadingAsyncData">Loading...</div>
    <form  v-if="!$loadingAsyncData" class="" @submit.prevent="onSubmit" novalidate>
        <div class="form-group">
            <label>Avatar: <sup class="text-danger">*</sup></label>
            <img :src="user.avatar" alt="" @click="getFilePathFromDialog($event)">
            <span>Click image to change</span><br />
            <span class="help-block" v-show="formErrors.avatar" v-text="formErrors.avatar"></span><br>
            <input type="file" @change="onChangeAvatar($event)" accept="image/*" v-el:input-avatar class="hidden" />
        </div>
        <div class="form-group" :class="{'has-error': formErrors.first_name}">
            <label>First Name: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.first_name">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.first_name"></span>
        </div>
        <div class="form-group" :class="{'has-error': formErrors.last_name}">
            <label>Last Name: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.last_name">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.last_name"></span>
        </div>
        <div class="form-group" :class="{'has-error': formErrors.email}">
            <label>Email:</label>
            <input readonly type="text" class="form-control" autocomplete="off" v-model="user.email">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.email"></span>
        </div>
        <div class="form-group" :class="{'has-error': formErrors.birthday}">
            <label>Birthday: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.birthday">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.birthday"></span>
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


                var formData = new FormData();

                if (images.length) {
                    formData.append('avatar', images[0]);
                }
//                console.log(images);return;
                this.submiting = true;
                this.$http.post(_api.put_avatar, formData).then(res => {
                    this.submiting = false;
                    swal({
                        title: "Your avatar was updated!",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    },function() {
                        location.href = 'account';
                        setTimeout(() =>{}, 1);
                    });
                }, (res) => {
                    this.formErrors = res.data;
                    this.submiting = false;
                    if(res.status === 500) {
                        BOX.alertError();
                    } else  {
                        toastr.error('Please check input field!.', 'Validate!');
                    }
                }

            );
            }
        }

    }

</script>