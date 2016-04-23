<template>
    <div v-if="$loadingAsyncData"><loading></loading></div>
    <div class="col-md-4 col-md-offset-8" v-if="!$loadingAsyncData">
        <a href="#" class="link" data-toggle="modal" data-target="#myModal">{{$l('setting.button')}}</a>
    </div>
    <form v-if="!$loadingAsyncData" class="" @submit.prevent="onSubmit" novalidate>
        <div class="form-group col-md-12">
            <label>{{$l('setting.avatar')}}: <sup class="text-danger">*</sup></label><br>
            <div style="height:200px; width:200px; overflow:hidden"><img :src="user.image" alt="" @click="getFilePathFromDialog($event)" style="width: 200px"></div>
            <br><span>{{$l('setting.click_image')}}</span><br />
            <span class="help-block" v-show="formErrors.avatar" v-text="formErrors.avatar"></span><br>
            <input type="file" @change="onChangeAvatar($event)" accept="image/*" v-el:input-avatar class="hidden" />
        </div>
        <div class="form-group col-md-4" :class="{'has-error': formErrors.first_name}">
            <label>{{$l('setting.first_name')}}: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.first_name">
            <span class="help-block" v-show="formErrors.first_name" v-text="formErrors.first_name"></span>
        </div>
        <div class="form-group col-md-4" :class="{'has-error': formErrors.last_name}">
            <label>{{$l('setting.last_name')}}: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.last_name">
            <span class="help-block" v-show="formErrors.last_name" v-text="formErrors.last_name"></span>
        </div>
        <div class="form-group col-md-4" :class="{'has-error': formErrors.birthday}">
            <label>{{$l('setting.birthday')}}: <sup class="text-danger">*</sup></label>
            <datepicker :value.sync = "user.birthday" format="YYYY-MM-DD" autocomplete="off" name="closing_date"></datepicker>
            <!-- <input type="date" class="form-control" autocomplete="off" v-model="user.birthday"> -->
            <span class="help-block" v-show="formErrors.birthday" v-text="formErrors.birthday"></span>
        </div>
        <div class="form-group col-md-6" :class="{'has-error': formErrors.email}">
            <label>Email:</label>
            <input readonly type="text" class="form-control" autocomplete="off" v-model="user.email">
            <span class="help-block" v-show="formErrors.email" v-text="formErrors.email"></span>
        </div>
        <div class="form-group col-md-6" :class="{'has-error': formErrors.phone}">
            <label>{{$l('setting.phone')}}: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.phone">
            <span class="help-block" v-show="formErrors.phone" v-text="formErrors.phone"></span>
        </div>
        <div class="form-group col-md-12" :class="{'has-error': formErrors.address}">
            <label>{{$l('setting.address')}}: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.address">
            <span class="help-block" v-show="formErrors.address" v-text="formErrors.address"></span>
        </div>
        <div class="form-group col-md-12"  :class="{'has-error': formErrors.country}">
            <label>{{$l('setting.country')}}: <sup class="text-danger">*</sup></label>
            <select class="form-control" v-model="user.country">
                <option v-for="country in countries" v-text="country.name" :value="country.code"></option>
            </select>
            <span class="help-block" v-show="formErrors.city" v-text="formErrors.country"></span>
        </div>
        <div class="form-group col-md-12" v-show="states.length">
            <label>{{$l('setting.state')}}: <sup class="text-danger">*</sup></label>
            <select class="form-control" v-model="user.state">
                <option v-for="state in states" v-text="state.name" :value="state.code"></option>
            </select>

        </div>
        <div class="form-group col-md-12" :class="{'has-error': formErrors.city}">
            <label>{{$l('setting.city')}}: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.city">
            <span class="help-block" v-show="formErrors.city" v-text="formErrors.city"></span>
        </div>
        <div class="form-group col-md-12" :class="{'has-error': formErrors.zipcode}">
            <label>{{$l('setting.zipcode')}}: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.zipcode">
            <span class="help-block" v-show="formErrors.zipcode" v-text="formErrors.zipcode"></span>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="link" :disabled="submiting">
                <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> {{$l('setting.button_update')}}
            </button>
        </div>

    </form>


    <changepass></changepass>

    <!-- Modal -->

</template>
<script>
    import laroute from '../../../../laroute';
    import BOX from '../../../../common';
    import Changepass from './Changepass.vue';
    import Datepicker from '../../../Globals/Datepicker.vue'
    import _ from 'lodash';

    export default {

        data() {
            return {
                user: {},
                formErrors: {},
                formInputs: {},
                submiting: false,
                countries: [],
                states: []
            }
        },

        asyncData(resolve, reject){
            this.$http.get(laroute.route('front::get.account')).then(res => {
                const user = res.data;

                resolve({
                    user
                });

            }, (res) => {
                BOX.alertError();
            });
        },

        ready(){
            this.countries = JSON.parse(_countries).result;
        },

        computed: {
            states() {
                if(!this.user.country) return [];

                const country = _.find(this.countries, {code: this.user.country});

                return country.states || [];
            }
        },

        methods: {
            getFilePathFromDialog(event){
                this.$els.inputAvatar.click();
            },

            onSubmit() {
                const user = this.user;
                this.submiting = true;
                this.$http.put(laroute.route('front::account.put.account'), user).then(res => {
                    this.submiting = false;
                swal({
                    title: this.$l('message.account_updated'),
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
                        toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
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
                        title: this.$l('message.avatar_updated'),
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, (isConfirm) => {

                        if(isConfirm) {
                            reader.readAsDataURL(image);
                            this.$http.post(laroute.route('front::account.avatar'), formData).then(res => {
                                this.submiting = false;
                                swal.close();
                            }, (res) => {
                                    this.formErrors = res.data;
                                    if(res.status === 500) {
                                        BOX.alertError();
                                    } else  {
                                        toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
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
        },
        components: { Changepass, Datepicker }
    }
</script>