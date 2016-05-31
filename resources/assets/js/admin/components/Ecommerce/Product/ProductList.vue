<script>
    import laroute from '../../../../laroute';
    import FilterTool from './FilterTools.vue';
    import deferred from 'deferred';

    export default{
        data(){
            return{
                api: laroute.route('ecommerce.api.list'),
                data: {
                    per_page: "10",
                },
                linkCreate: laroute.route('ecommerce.admin.ecommerce.products.create'),
                ids: []
            }
        },

        asyncData(resolve, reject) {
            this._fetchProduct(this.api).done(data => {
                resolve({ data });
        }, err => {
                console.warn(err);
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
        },

        filters: {
            linkEdit(products) {
                return laroute.route('ecommerce.admin.ecommerce.products.edit', { products });
            },
        },


        components: { FilterTool }
    }
</script>