<template>
	<table class="table table-bordered table-hover trans" v-if="histories.length">
	    <thead>
	        <tr>
	            <th>Date</th>
	            <th>Description</th>
	            <th>Amount</th>
	            <th>Blance</th>
	            <th>Status</th>
	            <th>Cancel</th>
	            
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="(index,history) in histories">
	            <td>{{ history.created_at }}</td>
	            <td>{{ history.description }}</td>
	            <td>
	            	<span v-if="history.type == 1" style="color:#0062FF;">+{{ history.amount | currency }}</span>
	            	<span v-else="history.type == 0" style="color:#F00;">-{{ history.amount | currency }}</span>
	            </td>
	            <td>{{ history.amount_total | currency }}</td>
	            <td>	
					<label class="label label-success" v-if="history.status.status == 'succeeded'">{{ history.status.status }}</label>
					<label class="label label-danger" v-if="history.status.status == 'canceled'">{{ history.status.status }}</label>
					<label class="label label-warning" v-if="history.status.status == 'pendding'">{{ history.status.status }}</label>
					
	            </td>
	            <td v-if="history.status.status == 'pendding'"><a @click.prevent="onCancel(index,history.id)" class="link" style="opacity:0.5; background-color:#F00"	>Cancel</a></td>
	            <td v-else align="center">N/A</td>
	        </tr>
	    </tbody>
	</table>
	<div v-else>
		<div class="error-notice" slot="notice-minimum">
		    <div class="oaerror info">
		        <p>
		            *You have not transacsion!
		        </p>
		    </div>
		</div>
	</div>
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
    methods: {
    	onCancel(index,id) {
				swal({
				    title: "Are you sure cancel it?",
				    type: "info",
				    showCancelButton: true,
				    closeOnConfirm: false,
				    showLoaderOnConfirm: true,
				}, () => {
					this.$http.put(laroute.route('front::payment.put.cancel', {one: id})).then(res => {
				    	toastr.success('Your transacsion was canceled.', 'Success!');
				    	this.histories[index].status.status = 'canceled';
				    	swal.close();
				    }, res => {
				    	toastr.error('Can not cancel this transacsion. Please try again!', 'Error!');
				    	swal.close();
				    	console.warn(res);
				    });
				});
			}
    },
 }
</script>