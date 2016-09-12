<script>
    import laroute from '../../../../laroute';
    import FilterTool from './FilterTools.vue';
    import deferred from 'deferred';
    import NOTIFY from '../../../../common.js';

    export default{
        data(){
            return{
                api: laroute.route('ecommerce.api.list'),
                data: {
                    per_page: "10",
                },
                linkCreate: laroute.route('ecommerce.admin.ecommerce.product.create'),
                ids: [],
                checkAll: false
            }
        },

        asyncData(resolve, reject) {
            this._fetchProduct(this.api).done(data => {
                resolve({ data });
        }, err => {
                NOTIFY.alertError();
            });
        },

        watch: {
            checkAll(val) {
                this.ids = val ? this.data.data.map(product => { return product.id }) : [];
            }
        },

        methods: {
            _fetchProduct(api, take = this.data.per_page) {
                const def = deferred();

                this.$http.get(api, { take }).then(( { data } ) => {
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });

                return  def.promise;
            },

            deleteProduct(product) {
                swal({
                    title: "Are you sure delete this product?",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, (isConfirm) => {
                    if(isConfirm) {
                        this.$http.delete(laroute.route('ecommerce.admin.ecommerce.product.destroy', { product: product.id })).then(res => {
                            toastr.success('Delete product success');
                            this.data.data.$remove(product);
                            swal.close();
                        }, res => {
                            NOTIFY.alertError();
                        });

                    } else {
                        swal.close();
                    }
                });

                
            }
        },

        filters: {
            linkEdit(product) {
                return laroute.route('ecommerce.admin.ecommerce.product.edit', { product });
            },
        },

        events: {
            'go-to-page'(api) {
                this.api = api;
                this.reloadAsyncData();
            }
        },


        components: { FilterTool }
    }
</script>