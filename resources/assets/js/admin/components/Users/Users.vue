<template>	
<table class="table table-hover table-light">
    <thead>
        <tr class="uppercase">
            <th colspan="2"> MEMBER </th>
            <th colspan="2"> Ticket total bought </th>
            <th> DEPOSIT Total </th>
            <th> WITHDRAW/CLAIM Total </th>
            <th> Blance </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="user in users">
            <td class="fit">
                <img class="user-pic" :src="user.image"> </td>
            <td>
                <a href="javascript:;" class="primary-link">{{user.fullname}}</a>
            </td>
            <td> {{user.ticket_total}} </td>
            <td> {{user.price_total | currency}} </td>
            <td class="font-blue-madison"> +{{user.deposit_total | currency}} </td>
            <td class="font-red-mint"> -{{user.withdraw_total | currency}} </td>
            <td>
                <span class="bold theme-font">{{user.balance | currency}}</span>
            </td>
            <td><a href="" style="color: #f60000"><i class="fa fa-trash"></i></a></td>
        </tr>
    </tbody>
</table>
</template>

<script>
import laroute from '../../../laroute';
import COMMON from '../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                users: [],
                total: null,
                numberMore: 10,
                loading: false,
                totalUsers: null,
                nextPageUrl: null
            }
        },

        asyncData(resolve, reject) {
            this._fetchUser(laroute.route('admin.get.users'), this.numberMore).done(users => {
                resolve({
                    users
                });
            }, err => {
                COMMON.alertError();
            });
        },
   
        methods: {
            _fetchUser(api, take = 10) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api, { take }).then(res => {
                    const { data } = res;
                    this.loading = false;
                    this.totalUsers = data.total;
                    this.nextPageUrl = data.next_page_url;
                    def.resolve(data.data);
                }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            },
            nextPagination() {
                this._fetchUser(this.nextPageUrl).done(users => {
                    this.users = this.users.concat(users);
                }, err => {
                    COMMON.alertError();
                });
            }
        },
}
</script>