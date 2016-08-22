<template>
    <loading v-if="$loadingAsyncData"></loading>
    <div v-else>
        <ul v-if="notifications.length" class="notifications">
            <li 
                :class="{
                    refund: notify.subject === 'canceled',
                    reward: notify.subject === 'award',
                    purchased: notify.subject === 'purchased',
                    paid: notify.subject === 'claimrequest',
                    unread: !notify.is_read
                }"
                v-for="notify in notifications"
            >
                <a :href="notify.url" target="_blank">
                    <p>{{{ notify.body }}}<br>
                        <small>{{ notify.created_at }}</small>
                    </p>
                </a>
                <div class="controls">
                    <span title="Delete" data-toggle="tooltip" data-placement="top"
                        @click="onDelete(notify)"
                    >
                        <i class="fa fa-times"></i>
                    </span>
                    <span title="{{ notify.is_read ? 'Readed' : 'Mark read' }}" data-toggle="tooltip" data-placement="top"
                        @click="onMarkRead(notify)"
                    >
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
            </li>
            <li class="text-center" v-show="next_page_url">
                <button class="btn btn-warning" :disabled="loading" @click="onLoadMore">
                    <i class="fa fa-circle-o-notch fa-spin" v-show="loading"></i> Load more {{ perPage }} notifications
                </button>
                <div class="text-right">
                    Show {{ notifications.length }} of {{ total }} record.
                </div>
            </li>
        </ul>

        <div v-else>
            <div class="error-notice" slot="notice-minimum">
                <div class="oaerror info">
                    <p>
                        *You have not notifications!
                    </p>
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
                notifications: [],
                next_page_url: null,
                total: 0,
                api: laroute.route('front::api::get.notifications'),
                loading: false
            }
        },

        asyncData(resolve, reject) {
            this._fetchNotifications(this.api, { per_page: this.perPage }).done(({data, next_page_url, total}) => {
                resolve({ notifications: data, next_page_url, total });
            }, err => {
                COMMON.alertError();
            });
        },

        methods: {
            _fetchNotifications(api, params = {}) {
                const def = deferred();
                this.$http.get(api, params).then(res => {
                    def.resolve(res.data);
                }, res => {
                    def.reject(res);
                });
                return def.promise;
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