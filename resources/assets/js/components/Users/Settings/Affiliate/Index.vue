<script>
    import deferred from 'deferred';
    import laroute from '../../../../laroute';
    import COMMON from  '../../../../common';

    export default {
        data() {
            return {
                perPage: 10,
                affiliate: [],
                next_page_url: null,
                total: 0,
                api: laroute.route('front::api::get.affiliate'),
                loading: false
            }
        },

        asyncData(resolve, reject) {
            this.$http.get(this.api).then(res => {
                const affiliate = res.data;

            resolve({
                affiliate
            });
            }, (res) => {
                COMMON.alertError();
            });
        },

        methods: {
            onAffiliate() {
                swal({
                    title: "Are you sure?",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, (isConfirm) => {
                    if(isConfirm) {
                        this.$http.post(laroute.route('front::api::post.affiliate')).then(res => {
                            swal.close();
                            toastr.success('Your request was sent!');
                            this.reloadAsyncData();
                        }, (res) => {
                            COMMON.alertError();
                            this.loading = false;
                        });
                    } else {
                        swal.close();
                    }
                });
            },

            onLoadMore() {
                this.loading = true;
                this._fetchNotifications(this.next_page_url).done(({ data, next_page_url }) => {
                    this.next_page_url = next_page_url;
                    this.notifications = this.notifications.concat(data);
                    this.loading = false;
                }, err => {
                    COMMON.alertError();
                    this.loading = false;
                });
            }
        }
    }
</script>