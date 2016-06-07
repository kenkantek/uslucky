<script>
    import laroute from '../../../laroute';
    import BOX from '../../../common';
    import deferred from 'deferred';

    export default{
        data(){
            return{
                orders: [],
                total: null,
                numberMore: 10,
                loading: false,
                totalOrders: null,
                nextPageUrl: null
            }
        },

        asyncData(resolve, reject) {
            this._fetchOrder(laroute.route('front::api::get.ecommerce.orders'), this.numberMore).done((orders = []) => {
                resolve({
                    orders
                });
            }, err => {
                BOX.alertError();
            });
        },

        methods: {
            _fetchOrder(api, take = 10) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api, { take }).then(res => {
                    const { data } = res;
                this.loading = false;
                this.totalOrders = data.total;
                this.nextPageUrl = data.next_page_url;
                def.resolve(data.data);
            }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            },
            nextPagination() {
                this._fetchOrder(this.nextPageUrl).done(orders => {
                    this.orders = this.orders.concat(orders);
            }, err => {
                    BOX.alertError();
                });
            }
        },
    }
</script>

