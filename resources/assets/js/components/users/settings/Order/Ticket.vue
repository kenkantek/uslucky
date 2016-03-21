<template>
    <div v-if="$loadingAsyncData">
        <loading></loading>
    </div>
    <div v-if="!$loadingAsyncData">
        <table style="margin:0" class="table table-bordered table-hover trans" v-if="tickets.length">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Buy date</th>
                    <th>Your number</th>
                    <th>Status</th>
                    <th>Draw date</th>
                    <th>Reward</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket in tickets">
                    <td>{{ticket.id}}</td>
                    <td>{{ticket.created_at}}</td>
                    <td>
                        <ul class="list">
                            <li v-for="number in ticket.numbers">{{number}}</li>
                            <li class="powerball">{{ticket.ball}}</li>
                        </ul>
                    </td>
                    <td>
                        <label style="font-size:12px" class="label label-success" v-if="ticket.status.status == 'win'">{{ ticket.status.status }}</label>
                        <label style="font-size:12px" class="label label-danger" v-if="ticket.status.status == 'lost'">{{ ticket.status.status }}</label>
                        <label style="font-size:12px" class="label label-warning" v-if="ticket.status.status == 'waiting'">{{ ticket.status.status }}</label>
                    </td>
                    <td>{{ticket.order.draw_at}}</td>
                    <td>$1.600.000.000</td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <div class="error-notice" slot="notice-minimum">
                <div class="oaerror info">
                    <p>
                        *You have not order!
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import laroute from '../../../../laroute';
import BOX from '../../../../common';
import deferred from 'deferred';

export default {
    props: ['orderId'],
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
            this._fetchTicket(laroute.route('front::order.ticket', { one:this.orderId,two: this.numberMore })).done(tickets => {
                resolve({
                    tickets
                });
            }, err => {
                BOX.alertError();
            });
        },
   
        methods: {
            _fetchTicket(api) {
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
                this._fetchTicket(this.nextPageUrl).done(tickets => {
                    this.tickets = this.tickets.concat(tickets);
                }, err => {
                    BOX.alertError();
                });
            }
        },
}
</script>
