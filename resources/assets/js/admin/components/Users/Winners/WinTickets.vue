<style scoped>
	ul{
		list-style:none;
	}
	.tickets li span{
		display: inline-block;
	}
</style>
<template>
	<div v-if="$loadingAsyncData" class="text-center text-danger">Loading ...</div>
	<ul v-else class="tickets">
	    <li v-for="ticket in data" track-by="$index">
	    	<span v-for="number in ticket.numbers" track-by="$index" class="clearfix">
	    		<strong v-text="number"></strong>
	    	</span>
	    	<span class="clearfix"><strong class="powerball" v-text="ticket.ball"></strong></span>
	    </li>
	</ul>
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
		}
	}
</script>