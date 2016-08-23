<script>
    import laroute from '../../../laroute';
    import COMMON from '../../../common';
    import deferred from 'deferred';
    import FilterTools from '../Globals/FilterTools.vue';

    export default {
        data() {
            return {
                api: laroute.route('admin.api.affiliates.list'),
                data: {
                    per_page: "10",
                },
                keyword: '',
                ids: [],
                checkAll: false,
                type: '',
                values: ''
            }
        },

        asyncData(resolve, reject) {
            console.log(this.keyword)
            this._fetchUsers(this.api).done(data => {
                resolve({ data });
        }, err => {
                COMMON.alertError();
                console.warn(err);
            });
        },

        watch: {
            timeForReload: 'reloadAsyncData',
            'data.per_page'(val, old) {
                (val && old) && this.reloadAsyncData();
            },
            checkAll(val) {
                this.ids = val ? this.data.data.map(user => { return user.id }) : [];
            }
        },

        computed: {
            timeForReload() {
                return Math.random(this.keyword);
            },
        },

        methods: {
            _fetchUsers(api, take = this.data.per_page, keyword = this.keyword) {
                const def = deferred();
                this.$http.get(api, { take, keyword }).then(res => {
                    const { data } = res;
                def.resolve(data);
            }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },
            onDelete(ids){
                swal({
                    title: "Are you sure delete this User?",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, (isConfirm) => {
                    if(isConfirm) {
                        this.$http.delete(laroute.route('admin.users.destroy', { 'users': [ids]})).then(res => {
                            swal.close();
                        this.reloadAsyncData();
                        return res;
                    }, (res) => {
                            if(res.status === 500) {
                                COMMON.alertError('Can not delete yourself!');
                            }
                        }
                    );
                    } else {
                        swal.close();
            }
            });
            },

            onActive(ids){
                this.$http.put(laroute.route('user.post.active',{ 'users': [ids]})).then(res => {
                    this.reloadAsyncData();
                swal({
                    title: "This user was approved to member of affiliate program!",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: false,
                }, function() {
                    swal.close();
                });

            },(res) => {
                    if(res.status === 500) {
                        COMMON.alertError();
                    } else  {
                        toastr.error('Please check input field!.', 'Validate!');
                    }
                });
            },

            onChange(id,index) {
                this.$http.put(laroute.route('admin.api.affiliates.put.type', {'id': id}), this.data.data[index].affiliate).then(res => {
                    toastr.success('User was set to member of Affiliate Program!', 'SUCCESS');
                return;
                });
            }
        },

        filters:{
            linkShow(users) {
                return laroute.route('admin.users.show', { users });
            },
        },

        events: {
            'go-to-page'(api) {
                this.api = api;
                this.reloadAsyncData();
            }
        },

        components: { FilterTools }
    }
</script>