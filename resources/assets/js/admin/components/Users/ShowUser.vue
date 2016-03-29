<template>
	<div class="portlet light ">
	    <div class="portlet-title tabbable-line">
	        <div class="caption caption-md">
	            <i class="icon-globe theme-font hide"></i>
	            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
	        </div>
	        <ul class="nav nav-tabs">
	            <li class="active">
	                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
	            </li>
	            <li>
	                <a href="#tab_1_2" data-toggle="tab">Change Password</a>
	            </li>
	        </ul>
	    </div>
	    <div class="portlet-body">
	    	<div v-if="$loadingAsyncData"><loading></loading></div>
			<div class="tab-content" v-if="!$loadingAsyncData">
			    <!-- PERSONAL INFO TAB -->
			    <div class="tab-pane active" id="tab_1_1">
			        <form role="form" @submit.prevent="onSubmit" novalidate>
			            <div class="form-group col-md-4" :class="{'has-error': formErrors.first_name}">
			                <label class="control-label">First Name</label>
			                <input type="text" autocomplete="off" placeholder="first name" v-model="user.first_name" class="form-control" /> 
							<span class="help-block" v-show="formErrors.first_name" v-text="formErrors.first_name"></span>
			            </div>
			            <div class="form-group col-md-4" :class="{'has-error': formErrors.last_name}">
			                <label class="control-label">Last Name</label>
			                <input type="text" placeholder="last nam" v-model="user.last_name" class="form-control" /> 
							<span class="help-block" v-show="formErrors.first_name" v-text="formErrors.last_name"></span>
			            </div>
			            <div class="form-group col-md-4" :class="{'has-error': formErrors.birthday}">
			                <label class="control-label">Birthday</label>
			                <datepicker :value.sync = "user.birthday" format="YYYY-MM-DD" autocomplete="off" name="closing_date"></datepicker> 
							<span class="help-block" v-show="formErrors.birthday" v-text="formErrors.birthday"></span>
			            </div>
			            <div class="form-group col-md-6" :class="{'has-error': formErrors.email}">
			                <label class="control-label">Email:</label>
			                <input type="text" v-model="user.email" placeholder="example@gmail.com" class="form-control" /> 
							<span class="help-block" v-show="formErrors.email" v-text="formErrors.email"></span>
			            </div>
			            <div class="form-group col-md-6" :class="{'has-error': formErrors.phone}">
			                <label class="control-label">Mobile Number</label>
			                <input type="text" v-model="user.phone" placeholder="+1 646 580 DEMO (6284)" class="form-control" />
							<span class="help-block" v-show="formErrors.phone" v-text="formErrors.phone"></span>
			            </div>
			            <div class="form-group col-md-4" :class="{'has-error': formErrors.address}">
			                <label class="control-label">Address</label>
			                <input type="text" v-model="user.address" placeholder="Address" class="form-control" /> 
							<span class="help-block" v-show="formErrors.address" v-text="formErrors.address"></span>
			            </div>
			            <div class="form-group col-md-4" :class="{'has-error': formErrors.city}">
			                <label class="control-label">City</label>
			                <input type="text" placeholder="City" v-model="user.city" class="form-control" /> 
							<span class="help-block" v-show="formErrors.city" v-text="formErrors.city"></span>
			            </div>
			            <div class="form-group col-md-4" :class="{'has-error': formErrors.zipcode}">
			                <label class="control-label">Zipcode</label>
			                <input type="text" placeholder="Address" v-model="user.zipcode" class="form-control" /> 
							<span class="help-block" v-show="formErrors.zipcode" v-text="formErrors.zipcode"></span>
			           	</div>   
			            <div class="form-group col-md-12" :class="{'has-error': formErrors.country}">
			                <label class="control-label">Country</label>
			            	<select v-model="user.country" class="form-control">
			            		<option v-for="country in countries" v-text="country.name" :value="country.code"></option>
			            	</select>    
			            	<span class="help-block" v-show="formErrors.country" v-text="formErrors.country"></span>
			            </div>
			            <div class="form-group col-md-12" v-show="states.length">
			                <label class="control-label">States</label>
			            	<select class="form-control" v-model="user.state">
				                <option v-for="state in states" v-text="state.name" :value="state.code"></option>
				            </select> 
			            </div>
			            <div class="margiv-top-10">
			                <button type="submit" @click.prevent="onSubmit" :disabled="submiting" class="btn green">Save Changes</button>
			                <button class="btn default" type="reset">Cancel</button> 
			            </div>
			        </form>
			    </div>
			    <!-- END PERSONAL INFO TAB -->
			    <!-- CHANGE PASSWORD TAB -->
			    <div class="tab-pane" id="tab_1_2">
			        <change-password :id="user.id" :fullname="user.fullname"></change-password>
			    </div>
			    <!-- END CHANGE PASSWORD TAB -->
			</div>
	    </div>
	    </div>
</template>

<script>
	import laroute from '../../../laroute';
	import COMMON from '../../../common';
	import deferred from 'deferred';
	import Datepicker from '../../../components/Globals/Datepicker.vue';
	import ChangePassword from './ChangePassword.vue';
	import _ from 'lodash';

	export default{
		data(){
			return{
				user: {},
                submiting: false,
                formErrors: {},
                countries: [],
                states: [],
			}
		},

		asyncData(resolve, reject){
            this._fetchUser(laroute.route('admin.get.user', {'user': user_id})).then(user => {
                resolve({
                    user
                });

            }, err => {
                COMMON.alertError();
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
            _fetchUser(api) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api).then(res => {
                    def.resolve(res.data);
                }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            },

            onSubmit(){
            	    const user = this.user;
            	    this.submiting = true;
            	    this.$http.put(laroute.route('admin.users.update',{'users': this.user.id}), user).then(res => {
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
            	            COMMON.alertError();
            	        } else  {
            	            toastr.error('Please check input field!.', 'Validate!');
            	        }
            	    });
            },  
        },

        components: {
        	Datepicker, ChangePassword
        }
	}
</script>