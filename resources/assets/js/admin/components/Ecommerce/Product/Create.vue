<script>
	import NOTIFY from '../../../../common.js';

	export default {
		data() {
			return {
				formData: new FormData,
				formInputs: {
					thumb: '/images/image-default.png'
				},
				formErrors: {},
				submiting: false
			}
		},

		methods: {
			onSubmiting(data) {
			    this.submiting = true;
                this.formErrors = {};

                for(let i in this.formInputs) {
	                this.formData.set(i, this.formInputs[i]);
                }
			},
			onComplete({ redirect, message }) {
			    message && toastr.success(message);
			    redirect && (window.location = redirect);
			    this.submiting = false;
			},
			onError(data, status) {
			    if(status === 422) {
                    this.formErrors = data;
                    toastr.error(this.$l('message.check_field'));
                } else { //500
                    NOTIFY.alertError();
                }
			    this.submiting = false;
			},
        },
	}

</script>