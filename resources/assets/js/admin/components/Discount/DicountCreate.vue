<script>
	import DatePicker from '../../../components/Globals/Datepicker.vue';
	import COMMON from '../../../common.js';
	
	export default {
		data: () => ({
			formInputs: {},
			formErrors: {},
			submiting: false
		}),

		methods: {
			onSubmiting() {
				this.submiting = true;
				this.formErrors = {};
			},
			onComplete({ message, redirect }) {
				message && toastr.success(message);
				redirect && setTimeout(() => window.location = redirect, 1000);
			},
			onError(data, status) {
				if(status === 422) {
					this.formErrors = data;
					toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
				} else {
					COMMON.alertError();
				}
				this.submiting = false;
			}
		},

		components: {
			DatePicker
		}
	}

</script>