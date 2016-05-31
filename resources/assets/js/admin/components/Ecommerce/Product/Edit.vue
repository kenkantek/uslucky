<script>
    import NOTIFY from '../../../../common.js';
    import laroute from '../../../../laroute';

    export default {
        props: ['id'],

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

        asyncData(resolve, reject) {
            this.$http.get(laroute.route('ecommerce.api.edit',{ id : this.id })).then(({data}) => {
                resolve({
                        formInputs : data
                });
        }, err => {
                NOTIFY.alertError();
            });
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