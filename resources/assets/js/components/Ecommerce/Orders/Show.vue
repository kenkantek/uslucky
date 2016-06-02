<script>
    import laroute from '../../../laroute';
    import COMMON from '../../../common';
    import deferred from 'deferred';

    export default {
        data() {
            return {
                order: {}
            }
        },

        asyncData(resolve, reject) {
            this._fetchOrder(laroute.route('front::api::get.ecommerce.show.order', {order: order_id})).done(order => {
                resolve({
                        order
                });
        }, err => {
                COMMON.alertError();
            });
        },

        methods: {
            _fetchOrder(api) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api).then(res => {
                    def.resolve(res.data);
            }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            },
        }
    }
</script>