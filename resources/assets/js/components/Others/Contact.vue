<template>
	<form id="contact-form" class="form-horizontal" @submit.prevent="onSubmit" novalidate>
	    <div v-if="load" class="contact-form-loader"></div>
	    <fieldset>
	        <div class="form-group">
	        	<label>
	        	    <input class="form-control" type="text" v-model="formInputs.name" placeholder="{{ $l('contact.name') }}">
	        	    <span class="err" v-show="formErrors.name" v-text="formErrors.name"></span>
	        	</label>
	        </div>
	        <div class="form-group">
	        	<label>
	        	    <input class="form-control" type="text" v-model="formInputs.email" placeholder="{{ $l('contact.email') }}">
	        	    <span class="err" v-show="formErrors.email" v-text="formErrors.email"></span>
	        	</label>
	        </div>
	        <div class="form-group">
	        	<label>
	        	    <input class="form-control" type="text" v-model="formInputs.phone" placeholder="{{ $l('contact.phone') }}">
	        	    <span class="err" v-show="formErrors.phone" v-text="formErrors.phone"></span>
				</label>
	        </div>
	        <div class="form-group">
	        	<label>
	        	    <textarea class="form-control" v-model="formInputs.message" placeholder="{{ $l('contact.message') }}"></textarea>
	        	    <span class="err"v-show="formErrors.message" v-text="formErrors.message"></span>
	        	</label>
	        </div>
	        <div class="form-group">
	        	<div class="btns">
	        	  <button type="submit" class="btn btn-primary" :disabled="submiting">
    	                <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> 
    	                {{ $l('contact.submit') }}
	                </button>
	        	  <button type="reset" class="btn btn-default">{{ $l('contact.reset') }}</button>
	        	</div>
	        </div>
	    </fieldset>
    </form>
</template>

<script>
	import BOX from '../../common'
	import laroute from '../../laroute';
	export default{
		data: () => ({
            submiting: false,
			formInputs : {},
            formErrors : {},
            onSubmmit : false,
            load : false
		}),

		methods: {
            onSubmit() {
                const contact = this.formInputs;
                this.submiting = true;
                this.$http.put(laroute.route('front::put.contact'), this.formInputs).then(res => {
                    this.submiting = false;
                    this.load = true;
                    swal({
                        title: this.$l('message.contact_sent'),
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: false,
                    }, function() {
                    	$('.contact-form-loader').remove('div');
                    	$('input').val('');
                    	$('textarea').val('');
                        swal.close();
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
        }
	}
</script>