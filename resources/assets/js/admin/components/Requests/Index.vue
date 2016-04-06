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
						<tr>
							<td>1</td>
							<td class="fit">
                                <img class="user-pic" src="https://ssl.gstatic.com/accounts/ui/avatar_1x.png" width="30px">
                            </td>
                            <td>Name name</td>
                            <td>$200</td>
                            <td>Date 1</td>
                            <td>Description</td>
                            <td><span class="label label-success">Successed</span></td>
                            <td>
                            	<div class="btn-group btn-group-circle">
	                                <button type="button" class="btn btn-outline green btn-sm">Appove
	                                </button>
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

	export default{
		data(){
			return{
				api: laroute.route('admin.get.user.transaction'),
				data: {
					'per_page': "10",
				},
			}
		},

		asyncData(resolve, reject){

		},

		methods:{

		}
	}
</script>