<script>
    import laroute from '../../../laroute';
    export default{
        data(){
            return{
                inputs:{},
                status: '',
                submitting: false
            }
        },
        asyncData(resolve, reject){
            this.$http.get(laroute.route('admin.api.affiliate')).then(res => {
               this.inputs = res.data;
                this.status = this.inputs.status == 1 ? 'On' : 'Off';
            });
        },
        methods: {
            onSubmit()
            {
                this.submitting = true;
                this.$http.put(laroute.route('admin.affiliate.update',{'affiliate': this.inputs.id}),this.inputs).then(res => {
                    this.submitting = false;
                    toastr.success('Affiliate Program info was updated!', 'Success!');
                });
            },

            onCheck()
            {
                this.status = this.inputs.status ? 'On' : 'Off'
            }
        }
    }
</script>
