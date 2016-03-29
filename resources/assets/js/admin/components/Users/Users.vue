<template>
    <div class="portlet light ">
        <header-tools :ids="ids">
            <slot slot="header" name="header"></slot>
        </header-tools>
        <div class="portlet-body">
            <filter-tools :data.sync="data" :keyword.sync="keyword">
            </filter-tools>
            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top-10">
                    <loading></loading>
                </div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th>
                                <input type="checkbox" v-model="checkAll">
                            </th>
                            <th colspan="2"> MEMBER </th>
                            <th colspan="2"> Ticket total bought </th>
                            <th> DEPOSIT Total </th>
                            <th> WITHDRAW/CLAIM Total </th>
                            <th> Blance </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td>
                                <input type="checkbox" v-model="ids" :value="user.id">
                            </td>
                            <td class="fit">
                                <img class="user-pic" :src="user.image" width="30px"> </td>
                            <td>
                                <a :href="user.id | linkShow" class="primary-link">{{user.fullname}}</a>
                            </td>
                            <td> {{user.ticket_total}} </td>
                            <td> {{user.price_total | currency}} </td>
                            <td class="font-blue-madison"> +{{user.deposit_total | currency}} </td>
                            <td class="font-red-mint"> -{{user.withdraw_total | currency}} </td>
                            <td>
                                <span class="bold theme-font">{{user.balance | currency}}</span>
                            </td>
                            <td><a class="label label-danger" href="" @click.prevent="onDelete(user.id)"><i class="fa fa-remove"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import laroute from '../../../laroute';
import COMMON from '../../../common';
import HeaderTools from './HeaderTool.vue';
import deferred from 'deferred';
import FilterTools from '../Globals/FilterTools.vue';

export default {
    data() {
            return {
                api: laroute.route('admin.get.users'),
                data: {
                    per_page: "10",
                },
                keyword: '',
                ids: [],
                checkAll: false,
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

        components: { HeaderTools, FilterTools }
}
</script>