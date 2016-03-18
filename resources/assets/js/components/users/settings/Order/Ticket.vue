<template>
    <table style="margin:0" class="table table-bordered table-hover trans">
        <thead>
            <tr>
                <th>#</th>
                <th>Buy date</th>
                <th>Your number</th>
                <th>Price</th>
                <th>Status</th>
                <th>Draw date</th>
                <th>Reward</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2016-03-17 10:47:43</td>
                <td>
                    <ul class="list">
                        <li>19</li>
                        <li>24</li>
                        <li>45</li>
                        <li>18</li>
                        <li>36</li>
                        <li class="powerball">5</li>
                    </ul>
                </td>
                <td>$2</td>
                <td>Win</td>
                <td>16-3-2016</td>
                <td>$1.600.000.000</td>
            </tr>
        </tbody>
    </table>
</template>


<script>
import laroute from '../../../../laroute';
import BOX from '../../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                tickets: [],
                total: null,
                numberMore: 10,
                loading: false,
                totalTickets: null,
                nextPageUrl: null
            }
        },
        asyncData(resolve, reject) {
            this._fetchTickets(laroute.route('front::order.list', { one: this.numberMore })).done(tickets => {
                resolve({
                    tickets
                });
            }, err => {
                BOX.alertError();
            });
        },
   
        methods: {
            _fetchTickets(api) {
                this.loading = true;
                let def = deferred();
                this.$http.get(api).then(res => {
                    const { data } = res;
                    this.loading = false;
                    this.totalTickets = data.total;
                    this.nextPageUrl = data.next_page_url;
                    def.resolve(data.data);
                }, (res) => {
                    def.reject(res);
                    this.loading = false;
                });
                return def.promise;
            },
            nextPagination() {
                this._fetchTickets(this.nextPageUrl).done(tickets => {
                    this.tickets = this.tickets.concat(tickets);
                }, err => {
                    BOX.alertError();
                });
            }
        },
}
</script>
