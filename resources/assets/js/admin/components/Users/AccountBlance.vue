<template>
	<h2>Balance: {{balance | currency}}</h2>
	<form role="form" @submit.prevent="onSubmit">
		<div class="form-group">
			<label class="label-form label label-success" :class="{'label-danger' : formError.amount}">ADD AMOUNT:</label>
			<input v-model="formInput.amount" type="text" class="form-control" style="margin-top: 3px; border: #36c6d3 solid 1px !important;" placeholder="Enter money">
			<span class="font-red-mint" v-show="formError.amount" v-text="formError.amount"></span> 
		</div>
		<div class="form-group">
			<label class="label-form label label-success" :class="{'label-danger' : formError.description}">DESCRIPTION:</label>
			<textarea v-model="formInput.description" class="form-control" style="margin-top: 3px; border: #36c6d3 solid 1px !important;" placeholder="Content" rows="5"></textarea>
			<span class="font-red-mint" v-show="formError.description" v-text="formError.description"></span> 
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Submit</button>
		</div>
	</form>
</template>

<script>
import laroute from '../../../laroute';
import COMMON from '../../../common';
import deferred from 'deferred';

export default{
	props:['balance', 'id'],

	data(){
		return{
			formInput: {},
			formError: {}
		}
	},

	methods:{
		onSubmit(){
			this.$http.post(laroute.route('admin.post.user.deposit',{'user': this.id}), this.formInput).then(res => {
			    swal({
			        title: "Balance of this user was updated!",
			        type: "info",
			        closeOnConfirm: false,
			        showLoaderOnConfirm: false,
			    }, function() {
			    	window.location.reload();
			        swal.close();
			    });

			},(res) => {
			    this.formError = res.data;
			    if(res.status === 500) {
			        COMMON.alertError();
			    } else  {
			        toastr.error('Please check input field!.', 'Validate!');
			    }
			});
		}
	}
}
</script>