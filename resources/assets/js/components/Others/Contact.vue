<template>
	<form id="contact-form" @submit.prevent="onSubmit" novalidate>
	    <div v-if="load === true" class="contact-form-loader"></div>
	    <fieldset>
	        <label>
	            <input type="text" v-model="formInputs.name" placeholder="Your Name">
	            <span class="err" v-show="formErrors.name" v-text="formErrors.name"></span>

	        </label>
	        <label>
	            <input type="text" v-model="formInputs.email" placeholder="Your Email">
	            <span class="err" v-show="formErrors.email" v-text="formErrors.email"></span>

	        </label>
	        <label>
	            <input type="text" v-model="formInputs.phone" placeholder="Your Phone Number">
	            <span class="err" v-show="formErrors.phone" v-text="formErrors.phone"></span>
			</label>
	        <label>
	            <textarea v-model="formInputs.message" placeholder="Message"></textarea>
	            <span class="err"v-show="formErrors.message" v-text="formErrors.message"></span>
	        </label>
	        <!-- <label class="recaptcha"><span class="empty-message">*This field is required.</span></label> -->
	        <div class="btns">
	          <button type="reset" class="link">reset</button>
	          <button type="submit" class="link" :disabled="submiting">
                <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> submit</button>
	        </div>
	    </fieldset>
    </form>
</template>

<script>
	import BOX from '../../common'
	import laroute from '../../laroute';
	export default{
		data(){
			return{
                submiting: false,
				formInputs : {},
                formErrors : {},
                onSubmmit : false,
                load : {}
			}
		},

		methods: {
            onSubmit(){
                const contact = this.formInputs;
                this.submiting = true;
                this.$http.put(laroute.route('front::put.contact'),this.formInputs).then(res => {
                    this.submiting = false;
                    this.load = true;
                    swal({
                        title: "Your message was sent!",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: false,
                    }, function() {
                    	$('.contact-form-loader').remove('div');
                    	$('input').val('');
                    	$('textarea').val('');
                        swal.close();
                    });

                },(res) => {
                    this.formErrors = res.data;
                    this.submiting = false;
                    if(res.status === 500) {
                        BOX.alertError();
                    } else  {
                        toastr.error('Please check input field!.', 'Validate!');
                    }
                });

            },
        },
	}
</script>