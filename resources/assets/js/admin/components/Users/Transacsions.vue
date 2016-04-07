<template>
	<div class="table-scrollable-borderless">
		<div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
        <filter-tools :data.sync="data"></filter-tools>
		<table v-else class="table-striped table-checkable table table-hover table-bordered admin">
			<thead>
                <tr class="uppercase">
                	<th>#ID</th>
                	<th>Update At</th>
                	<th> Description </th>
                	<th> Amount Prev </th>
                	<th> Amount </th>
                	<th>Amount Next</th>
                	<th> Status </th>
                </tr>
            </thead>
            <tbody>
            	<tr v-for="transaction in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
            		<td v-text="transaction.id"></td>
            		<td v-text="transaction.created_at"></td>
            		<td v-text="transaction.description"></td>
            		<td v-text="transaction.amount_prev | currency"></td>
            		<td>
                        <small :class="[transaction.type == 1 ? 'text-primary' : 'text-danger']">
                            <strong>{{ transaction.type == 1 ? '+' : '-' }}{{ transaction.amount | currency }}</strong>
                        </small>
                    </td>
            		<td v-text="transaction.amount_total | currency"></td>
            		<td><span class="label" :class="{'label-success':transaction.status.status == 'succeeded', 
            		'label-warning':transaction.status.status == 'pendding', 
            		'label-danger':transaction.status.status=='canceled','label-primary':transaction.status.status == 'processing'}" v-text="transaction.status.status"></span></td>
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
				api: laroute.route('admin.get.user.transaction',{'user': this.id}),
                data: {
                    per_page: "10",
                },
			}
		},

		asyncData(resolve, reject) {
            this._fetchTransacsions(this.api).done(data => {
                resolve({ data });
            }, err => {
                COMMON.alertError();
                console.warn(err);
            });
        },

		methods: {
			_fetchTransacsions(api, take = this.data.per_page, id = this.id) {
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