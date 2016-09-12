<script>
    import BOX from '../../common'
    import laroute from '../../laroute';
    export default{
        data(){
            return{
                submiting: false,
                formInputs : {},
                formErrors : {},
            }
        },
        methods: {
            onSubmit() {
                this.submiting = true;
                this.$http.post(laroute.route('front::contact.partner.post'),this.formInputs).then(res => {
                    this.submiting = false;
                    this.formInputs = {};
                    swal({
                        title: "Your infomation was sent!",
                        text: "We will reply soon!",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    })
                }, (err) => {
                    this.formErrors = res.data;
                    this.submiting = false;
                    if(res.status === 422) {
                        toastr.error(this.$l('message.check_field'), this.$l('message.validate'));
                    } else  {
                        BOX.alertError();
                    }
                });
            }
        }
    }
</script>
