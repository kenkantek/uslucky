<template>
	<form class="form-group" @submit.prevent="onSubmit" novalidate>
        <div class="row">
            <div class="col-xs-12">
                <h3><i class="icon-action-redo"></i> Ticket Reply</h3>
                <textarea :disabled="submiting" v-model="formInputs.message" class="ticket-reply-msg" row="10"></textarea>
                <div v-show="formErrors.message" class="alert alert-danger">
                    {{formErrors.message}} 
                </div>
            </div>
        </div>
        <button class="btn btn-square uppercase bold green" type="submit" :disabled="submiting">
        	<i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Submit
        </button>
    </form>
</template>

<script>
	import laroute from '../../../laroute';
	import COMMON from '../../../common';

	export default {
		props:[
			'id'
		],
		data() {
			return {
				formInputs: {},
				formErrors: {},
				submiting: false,
				onSubmmit: false
			}
		},
		methods: {
			onSubmit(){
				this.submiting = true;
				this.$http.put(laroute.route('admin.contact.update', { 'contact': this.id}),this.formInputs).then(res => {
                    $(".btn").remove('button');
                    swal({
                        title: "Your message was sent!",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: false,
                    }, function() {
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
		}
	}
</script>