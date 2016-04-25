<template>
	<div v-if="$loadingAsyncData" class="text-center text-danger">Loading ...</div>
	<table v-else class="table-striped table-checkable table table-hover table-bordered admin">
	    <tbody>
	        <tr v-for="ticket in data" track-by="$index">
	            <td width="240">
	                <ul class="list">
	                    <li v-for="number in ticket.numbers" track-by="$index">
	                    	<span> <strong v-text="number"></strong> </span>
	                    </li>
	                    <li class="powerball">
							<span class="clearfix"><strong class="powerball" v-text="ticket.ball"></strong></span>
	                    </li>
	                </ul>
	            </td>
	            <td width="200">{{ ticket.award.level.label }}</td>
	            <td>{{ ticket.reward | currency }}</td>
	        </tr>
	    </tbody>
	</table>
</template>

<script>
	import laroute from '../../../../laroute';
	import COMMON from '../../../../common';

	export default {
		props: ['user', 'game', 'result'],

		data() {
			return {
				data: []
			}
		},

		asyncData(resolve, reject) {
			this.$http.get(laroute.route('admin.get.winners.tickets'), { user_id: this.user, game_id: this.game, result_id: this.result }).then(({data}) => {
				resolve({ data });
			}, res => {
				COMMON.alertError();
			});
		},
	}
</script>