<template>
    <div class="portlet">
        <div class="portlet-body">
            
            <filter-tools 
                :data.sync="data"
                :keyword.sync="keyword"
            >
            </filter-tools>

            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th><input type="checkbox" v-model="checkAll"></th>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Begin at</th>
                            <th>End at</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="discount in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td><input type="checkbox" v-model="ids" :value="discount.id"></td>

                            <td>{{ discount.id }}</td>

                            <td> 
                                {{ discount.name }}
                            </td>

                            <td>
                                {{ discount.code }}
                            </td>

                            <td>
                                {{ discount.description }}
                            </td>

                            <td>
                                {{ discount.begin_at }}
                            </td>

                            <td>
                                {{ discount.end_at }}
                            </td>
    
                            <td>
                                <span class="label" 
                                :class="[discount.status === 'expired' || discount.status === 'disabled' ? 'label-danger' : 'label-success']"
                                v-text="discount.status"
                                >
                                </span>
                            </td>

                            <td class="text-center">
                                <a class="label label-default" :href="discount.id | linkShow"><i class="fa fa-eye"></i></a>
                                <a class="label label-danger" href="#" @click.prevent="deleteDiscount(discount)"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>

                        <tr v-if="!data.data || !data.data.length">
                            <td colspan="9" class="text-center text-danger">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../laroute';
    import COMMON from '../../../common';
    import FilterTools from '../Globals/FilterTools.vue';

    export default {
        data() {
            return {
                api: laroute.route('admin.api.discounts'),
                data: {
                    per_page: "10",
                },
                keyword: '',
                ids: [],
                checkAll: false
            }
        },

        asyncData(resolve, reject) {
            this._fetchDiscounts(this.api).then(data => {
                resolve({ data });
            })
            .catch(err => {
                COMMON.alertError();
            });
        },

        watch: {
            timeForReload: 'reloadAsyncData',
            'data.per_page'(val, old) {
                (val && old) && this.reloadAsyncData();
            },
            checkAll(val) {
                this.ids = val ? this.data.data.map(discount => discount.id ) : [];
            }
        },

        computed: {
            timeForReload() {
                return Math.random(this.keyword);
            }
        },

        methods: {
            _fetchDiscounts(api, take = this.data.per_page, keyword = this.keyword) {
                return new Promise((resolve, reject) => {
                    this.$http.get(api, { take, keyword }).then(({ data }) => {
                        resolve(data);
                    }, res => {
                        reject(res);
                    });

                });
            },
            deleteDiscount(discount) {
                swal({
                    title: "Are you sure delete this discount?",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, (isConfirm) => {
                    if(isConfirm) {
                        this.$http.delete(laroute.route('admin.discount.destroy', { discount: discount.id }))
                        .then(({ data: {message} }) => {
                            swal.close();
                            this.data.data.$remove(discount);
                            message && toastr.success(message);
                        }, (res) => {
                                COMMON.alertError();
                            }
                        );
                    } else {
                        swal.close();
                    }
                });
            }
        },

        filters: {
            linkShow(discount) {
                return laroute.route('admin.discount.edit', { discount });
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