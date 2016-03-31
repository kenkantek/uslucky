<template>
    <div class="portlet light ">
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th width="200">Winner</th>
                            <th>Order #ID</th>
                            <th>Winning Numbers</th>
                            <th>Extra</th>
                            <th>Prize</th>
                            <th>Prize Money</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="award in data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td width="200">
                                <a :href="award.ticket.order.user.id | linkUser">{{ award.ticket.order.user.fullname }}</a>
                            </td>
                            <td>
                                <a :href="award.ticket.order.id | linkOrder">#{{ award.ticket.order.id }}</a>
                            </td>
                            <td>
                                <span v-for="number in award.ticket.numbers">
                                    <strong v-text="number"></strong>
                                </span>
                                <span><strong class="powerball">{{ award.ticket.ball }}</strong></span>
                            </td>
                            <td>
                                <span class="label" :class="[award.ticket.order.extra ? 'label-success' : 'label-default']">
                                    {{ award.ticket.order.extra ? 'YES' : 'NO' }}
                                </span>
                            </td>
                            <td>
                                <span class="label" :class="[award.level.level == 1] ? 'label-success' : 'label-info'">
                                    {{ award.level.label }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ prizeMoney(award.level.award, award.add_award, award.ticket.order.extra) | currency }}</strong>
                            </td>
                            <td>
                                <span class="label" :class="[award.status.status == 'paid' ? 'label-success' : 'label-danger']">
                                    {{ award.status.status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger" 
                                v-if="award.status.status === 'unpaid'"
                                @click="changeToPaid(award)"
                                :disabled="award.changestatusding"
                                >
                                    <i class="fa fa-circle-o-notch fa-spin" v-show="award.changestatusding"></i> 
                                    Change To Paid
                                </button>
                                <span v-else>N/A</span>
                            </td>
                        </tr>
                        <tr v-if="!data || !data.length">
                            <td colspan="8">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../../laroute';
    import COMMON from '../../../../common';

    export default {
        props: ['result'],

        data() {
            return {
                data: []
            }
        },

        asyncData(resolve, reject) {
            this.$http.get(laroute.route('admin.get.award.result.detail', { result: this.result.id })).then((res) => {
                const data = res.data.map(d => {
                    d.changestatusding = false;
                    return d;
                });
                resolve({ data })
            }, res => {
                COMMON.alertError();
            });
        },

        methods: {
            prizeMoney(award, add_award, extra) {
                let prize = parseFloat(award) + parseFloat(add_award);
                return extra ? prize * this.result.multiplier : prize;
            },
            changeToPaid(award) {
                award.changestatusding = true;
                this.$http.put(laroute.route('admin.put.award.changestatus', {award: award.id})).then(res => {
                    award.status.status = res.data.status;
                    toastr.success('Change status success');
                }, res => {
                    award.changestatus = false;
                    COMMON.alertError();
                });
            }
        },

        filters: {
            linkOrder(orders) {
                return laroute.route('admin.orders.show', { orders });
            },
            linkUser(users) {
                return laroute.route('admin.users.show', { users });
            }
        },

        components: {  }
    }
</script>