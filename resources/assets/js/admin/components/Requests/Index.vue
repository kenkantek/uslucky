<template>
	<div class="portlet light ">
		<div class="portlet-title">
			<div class="caption" slot="header">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject font-dark sbold uppercase">All Requests</span>
            </div>
		</div>
		<div class="portlet-body">
			<div class="table-scrollable table-scrollable-borderless">
			<div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
			<filter-tools :data.sync="data"></filter-tools>
				<table v-else class="table-striped table-checkable table table-hover table-bordered admin">
					<thead>
						<tr>
							<th>#ID</th>
							<th colspan="2">User</th>
							<th>Amount</th>
							<th>Date Request</th>
							<th>Description</th>
							<th>Status</th>
							<th>Tools</th>
						</tr>
					</thead>

					<tbody>
						<tr v-for="request in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
							<td v-text="request.id"></td>
							<td class="fit">
                                <img class="user-pic" :src="request.user.image" width="30px">
                            </td>
                            <td v-text="request.user.fullname"></td>
                            <td v-text="request.amount | currency"></td>
                            <td v-text="request.created_at"></td>
                            <td v-text="request.description"></td>
                            <td><span class="label" :class="{'label-success': request.status.status == 'succeeded', 'label-danger': request.status.status == 'pendding', 'label-warning': request.status.status=='processing'}" v-text="request.status.status"></span></td>
                            <td>
                            	<div class="btn-group btn-group-circle">
	                                <button :disabled="submitting" v-if="request.status.status == 'pendding'" type="button" @click.prevet="onClick(request.id,status='processing')" class="btn btn-outline yellow btn-sm">
	                                <i v-show="submitting" class="fa fa-circle-o-notch fa-spin"></i> change to processing
	                                </button>
	                                <button :disabled="submitting" v-if="request.status.status == 'processing'" type="button" @click.prevet="onClick(request.id,status='succeeded')" class="btn btn-outline green btn-sm">
	                                <i v-show="submitting" class="fa fa-circle-o-notch fa-spin"></i> change to succeeded
	                                </button>
	                                <span v-if="request.status.status == 'succeeded'" class="label label-success">N/A</span>
	                            </div>
                            </td>
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
	import deferred from 'deferred';
	import FilterTools from '../Users/Filters/FilterTools.vue';

	export default{
		data(){
			return{
				api: laroute.route('admin.get.transactions'),
				data: {
					'per_page': "10",
				},
				submitting: false,
			}
		},

		asyncData(resolve, reject){
			this._fetchRequests(this.api).done(data => {
			    resolve({ data });
			}, err => {
			    COMMON.alertError();
			    console.warn(err);
			});
		},

		methods: {
			_fetchRequests(api, take = this.data.per_page) {
                const def = deferred();
                this.$http.get(api, { take }).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },

            onClick(id, status){
            	this.submitting = true;
            	this.$http.put(laroute.route('admin.request-list.update', {'request_list': id, status})).then(res => {
            		this.reloadAsyncData();
            		swal({
                        title: "Request was changed to "+ status +"!",
                        type: "info",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: false,
                    }, function() {
                        swal.close();
                    });
                    this.submitting = false;
            	});
            }
		},

		events: {
            'go-to-page'(api) {
                this.api = api;
                this.reloadAsyncData();
            }
        },

        components:{
        	FilterTools
        }
	}
</script>