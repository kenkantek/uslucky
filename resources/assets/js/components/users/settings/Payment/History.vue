<template>
	<table class="table table-bordered table-hover trans">
	    <thead>
	        <tr>
	            <th>Date</th>
	            <th>Description</th>
	            <th>Amount</th>
	            <th>Blance</th>
	            <th>Status</th>
	            <th></th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="history in histories">
	            <td>{{ history.created_at }}</td>
	            <td>{{ history.description }}</td>
	            <td>{{ history.amount | currency }}</td>
	            <td>{{ history.amount_total | currency }}</td>
	            <td>{{ history.status.status }}</td>
	            <td v-if="history.status.status == 'succeeded'"><a class="link" href="">Delete</a></td>
	            <td v-else><a class="link" style="opacity:0.5; background-color:#F00" href="">Cancel</a></td>
	        </tr>
	    </tbody>
	</table>
</template>

<script>
	import laroute from '../../../../laroute';
    import BOX from '../../../../common';
    export default {
    data() {
            return {
                histories: {},
            }
        },

    asyncData(resolve, reject){
            this.$http.get(laroute.route('front::payment.api.history')).then(res => {
                const histories = res.data;

                resolve({
                    histories
                });

            }, (res) => {
                BOX.alertError();
            });
        },
 }
</script>