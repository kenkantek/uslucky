<template>
	<div class="table-scrollable table-scrollable-borderless">
		<div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
        <filter-tools :data.sync="data"></filter-tools>
		<table v-else class="table-striped table-checkable table table-hover table-bordered admin">
			<thead>
                <tr class="uppercase">
                    <th>#ID</th>
                    <th> Game Type </th>
                    <th colspan="2"> Total Ticket </th>
                    <th> Bought Date </th>
                    <th>Draw Date</th>
                    <th> Description </th>
                    <th> Status </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            	<tr v-for="order in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
            		<td v-text="order.id"></td>
            		<td v-text="order.game_name"></td>
            		<td v-text="order.ticket_total"></td>
                    <td v-text="order.price | currency"></td>
            		<td v-text="order.created_at"></td>
            		<td v-text="order.draw_at"></td>
                    <td v-text="order.description"></td>
            		<td><span class="label" :class="{'label-success':order.status.status == 'purchased', 
            		'label-warning':order.status.status == 'wait for purchase', 
            		'label-danger':order.status.status=='canceled'}" v-text="order.status.status"></span></td>
                    <td><a class="label label-default" :href="order.id | linkShow"><i class="fa fa-eye"></i></a></td>
            	</tr>
            </tbody>
		</table>
	</div>
</template>

<script>
	import laroute from '../../../laroute';
	import COMMON from '../../../common';
	import deferred from 'deferred';
	import FilterTools from './Filters/FilterTools.vue';

	export default{
		props:['id'],

		data(){
			return{
				api: laroute.route('admin.get.user.orders',{'user': this.id}),
                data: {
                    per_page: "10",
                },
			}
		},

		asyncData(resolve, reject) {
            this._fetchOrders(this.api).done(data => {
                resolve({ data });
            }, err => {
                COMMON.alertError();
                console.warn(err);
            });
        },

		methods: {
			_fetchOrders(api, take = this.data.per_page, id = this.id) {
                const def = deferred();
                this.$http.get(api, { take, id }).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },
		},

        filters: {
            linkShow(orders) {
                return laroute.route('admin.orders.show', { orders });
            },
        },

		events: {
            'go-to-page'(api) {
                this.api = api;
                this.reloadAsyncData();
            }
        },

        components: {
            FilterTools
        }

	}
</script>