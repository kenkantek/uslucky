<template>
	<form id="contact-form" @submit.prevent="onSubmit" novalidate>
	    <fieldset>
	        <div class="form-group">
	        	<input class="form-control" type="text" v-model="formInputs.name" placeholder="{{ $l('contact.name') }}">
        	    <span class="err" v-show="formErrors.name" v-text="formErrors.name"></span>
	        </div>
	        <div class="form-group">
	        	<input class="form-control" type="text" v-model="formInputs.email" placeholder="{{ $l('contact.email') }}">
	        	<span class="err" v-show="formErrors.email" v-text="formErrors.email"></span>
	        </div>
	        <div class="form-group">
	        	<input class="form-control" type="text" v-model="formInputs.phone" placeholder="{{ $l('contact.phone') }}">
	        	<span class="err" v-show="formErrors.phone" v-text="formErrors.phone"></span>
	        </div>
	        <div class="form-group">
	        	<textarea class="form-control" v-model="formInputs.message" placeholder="{{ $l('contact.message') }}"></textarea>
	        	<span class="err"v-show="formErrors.message" v-text="formErrors.message"></span>
	        </div>
	        <div class="form-group">
				<button type="submit" class="btn btn-primary" :disabled="submiting">
					<i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> 
					{{ $l('contact.submit') }}
				</button>
				<button type="reset" class="btn btn-default">
					{{ $l('contact.reset') }}
				</button>
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
            onSubmmit : false
		}),

		methods: {
            onSubmit(e) {
                const contact = this.formInputs,
                	form = e.currentTarget;
                this.submiting = true;
                this.formErrors = {};
                this.$http.put(laroute.route('front::put.contact'), this.formInputs).then(res => {
                    this.submiting = false;
                    swal({
                        title: this.$l('message.contact_sent'),
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: false,
                    }, () => {
                        swal.close();
                        form.reset();
                    });

                }, (res) => {
                    this.formErrors = res.data;
                    this.submiting = false;
                    if(res.status === 422) {
                        toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
                    } else  {
                        BOX.alertError();
                    }
                });

            },
        }
	}
</script>