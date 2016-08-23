<template>
    <loading v-if="$loadingAsyncData"></loading>
    <div v-else>

        <div v-if="affiliate.length" class="notifications">
            <div v-if="affiliate[0].type == 0">
                <div class="error-notice" slot="notice-minimum">
                    <div class="oaerror info">
                        <p>
                            *Your request become a member of Affiliate Program is considering. Please wait until administrator approve.!
                        </p>
                    </div>
                </div>
            </div>

            <div v-else>

            </div>
        </div>

        <div v-else>
            <div class="error-notice" slot="notice-minimum">
                <div class="oaerror info">
                    <p>
                        *You do not belong affiliate program!
                    </p>
                    <a @click.prevent="onAffiliate" class="btn btn-primary">I want become to member of Affiliate program!</a>
                </div>
            </div>
        </div>
    </div>
    
</template>

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
            },
            onDelete(notify) {
                swal({
                    title: "Are you sure delete?",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, (isConfirm) => {
                    if(isConfirm) {
                        this.$http.delete(laroute.route('front::api::delete.notification', { notification: notify.id })).then(res => {
                            swal.close();
                            toastr.success('Notify has been deleted');
                            this.notifications.$remove(notify);
                        }, (res) => {
                                COMMON.alertError();
                            }
                        );
                    } else {
                        swal.close();
                    }
                });
            },
            onMarkRead(notify) {
                if(notify.is_read) {
                    return toastr.warning('Notify readed');
                }
                this.$http.put(laroute.route('front::api::put.isread.notification', { notification: notify.id })).then(res => {
                    notify.is_read = 1;
                }, (res) => {
                        COMMON.alertError();
                    }
                );
            }
        }
    }
</script>