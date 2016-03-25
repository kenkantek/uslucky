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
	                <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
	            </li>
	            <li>
	                <a href="#tab_1_3" data-toggle="tab">Change Password</a>
	            </li>
	        </ul>
	    </div>
	    <div class="portlet-body">
			<div class="tab-content">
			    <!-- PERSONAL INFO TAB -->
			    <div class="tab-pane active" id="tab_1_1">
			        <form role="form" action="#">
			            <div class="form-group col-md-4">
			                <label class="control-label">First Name</label>
			                <input type="text" placeholder="John" class="form-control" /> </div>
			            <div class="form-group col-md-4">
			                <label class="control-label">Last Name</label>
			                <input type="text" placeholder="Doe" class="form-control" /> </div>
			            <div class="form-group col-md-4">
			                <label class="control-label">Birthday</label>
			                <input type="text" placeholder="Design, Web etc." class="form-control" /> </div>
			            <div class="form-group col-md-6">
			                <label class="control-label">Email:</label>
			                <input type="text" placeholder="example@gmail.com" class="form-control" /> </div>
			            <div class="form-group col-md-6">
			                <label class="control-label">Mobile Number</label>
			                <input type="text" placeholder="+1 646 580 DEMO (6284)" class="form-control" /> </div>
			            <div class="form-group col-md-4">
			                <label class="control-label">Address</label>
			                <input type="text" placeholder="Address" class="form-control" /> </div>
			            <div class="form-group col-md-4">
			                <label class="control-label">City</label>
			                <input type="text" placeholder="Address" class="form-control" /> </div>
			            <div class="form-group col-md-4">
			                <label class="control-label">Zipcode</label>
			                <input type="text" placeholder="Address" class="form-control" /> </div>   
			            <div class="form-group col-md-12">
			                <label class="control-label">Country</label>
			            	<select name="" id="" class="form-control">
			            		<option value="">EN</option>
			            		<option value="">US</option>
			            	</select>    
			            </div>
			            <div class="margiv-top-10">
			                <a href="javascript:;" class="btn green"> Save Changes </a>
			                <a href="javascript:;" class="btn default"> Cancel </a>
			            </div>
			        </form>
			    </div>
			    <!-- END PERSONAL INFO TAB -->
			    <!-- CHANGE AVATAR TAB -->
			    <div class="tab-pane" id="tab_1_2">

			        <form action="#" role="form">
			            <div class="form-group">
			                <div class="fileinput fileinput-new" data-provides="fileinput">
			                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
			                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
			                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
			                    <div>
			                        <span class="btn default btn-file">
			                            <span class="fileinput-new"> Select image </span>
			                            <span class="fileinput-exists"> Change </span>
			                            <input type="file" name="..."> </span>
			                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
			                    </div>
			                </div>
			                <div class="clearfix margin-top-10">
			                    <span class="label label-danger">NOTE! </span>
			                    <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
			                </div>
			            </div>
			            <div class="margin-top-10">
			                <a href="javascript:;" class="btn green"> Submit </a>
			                <a href="javascript:;" class="btn default"> Cancel </a>
			            </div>
			        </form>
			    </div>
			    <!-- END CHANGE AVATAR TAB -->
			    <!-- CHANGE PASSWORD TAB -->
			    <div class="tab-pane" id="tab_1_3">
			        <form action="#">
			            <div class="form-group">
			                <label class="control-label">Current Password</label>
			                <input type="password" class="form-control" /> </div>
			            <div class="form-group">
			                <label class="control-label">New Password</label>
			                <input type="password" class="form-control" /> </div>
			            <div class="form-group">
			                <label class="control-label">Re-type New Password</label>
			                <input type="password" class="form-control" /> </div>
			            <div class="margin-top-10">
			                <a href="javascript:;" class="btn green"> Change Password </a>
			                <a href="javascript:;" class="btn default"> Cancel </a>
			            </div>
			        </form>
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

	export default{
		data(){
			return{
				user: {},
			}
		},

		asyncData(resolve, reject){
            this._fetchUser(laroute.route('admin.get.user', {'user': user_id})).done(user => {
                resolve({
                    user
                });

            }, err => {
                COMMON.alertError();
            });
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
            }
        },
	}
</script>