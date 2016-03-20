<template>
	<div v-if="$loadingAsyncData"><loading></loading></div>
	<div  v-if="!$loadingAsyncData">
		<table style="margin:0" class="table table-bordered table-hover trans" v-if="histories.length">
		    <thead>
		        <tr>
                    <th>#</th>
		            <th>Updated At</th>
		            <th>Description</th>
		            <th>Amount</th>
		            <th>Paid with</th>
		            <th>Status</th>
		            <th>Cancel</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr v-for="(index, history) in histories" id="transaction-{{ history.id }}">
                    <td>{{ history.id }}</td>
		            <td>{{ history.updated_at }}</td>
		            <td>{{{ history.description }}}</td>
		            <td>
		            	<span v-if="history.type == 1" style="color:#0062FF;">+{{ history.amount | currency }}</span>
		            	<span v-else="history.type == 0" style="color:#F00;">-{{ history.amount | currency }}</span>
		            </td>
		            <td>
                        <span v-if="history.transactionable_type=='App\\Models\\Payment'">CreditCard</span>
                        <span v-else="history.transactionable_type == 'App\\Models\\User'">Account Blance</span>
                    </td>
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
		<button style="margin:0; width:100%" class="link" @click="nextPagination" v-show="nextPageUrl" :disabled="loading">Load more {{ numberMore }} record</button>
		<div v-show="nextPageUrl" style="width:100%; text-align:center; margin-top:10px">
			Show {{ histories.length }} of {{ totalHistories }} record.
		</div>
	</div>
</template>

<script>
import laroute from '../../../../laroute';
import BOX from '../../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                histories: [],
                total: null,
                numberMore: 10,
                loading: false,
                totalHistories: null,
                nextPageUrl: null
            }
        },

        asyncData(resolve, reject) {
            this._fetchHistory(laroute.route('front::get.transaction', { one: this.numberMore })).done(histories => {
                resolve({
                    histories
                });
            }, err => {
                BOX.alertError();
            });
        },
        watch: {
            total: 'reloadAsyncData'
        },
        methods: {
        	_fetchHistory(api) {
        		this.loading = true;
        		let def = deferred();
        		this.$http.get(api).then(res => {
        		    const { data } = res;
        		    this.loading = false;
        		    this.totalHistories = data.total;
        		    this.nextPageUrl = data.next_page_url;
        		    def.resolve(data.data);
        		}, (res) => {
        		    def.reject(res);
        		    this.loading = false;
        		});
        		return def.promise;
        	},

            onCancel(index, id) {
                swal({
                    title: "Are you sure cancel it?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, () => {
                    this.$http.put(laroute.route('front::put.cancel.transaction', {
                        one: id
                    })).then(res => {
                        toastr.success('Your transacsion was canceled.', 'Success!');
                        this.histories[index].status.status = 'canceled';
                        swal.close();
                        this.total = res.data;
                    }, res => {
                        if(res.status === 500) {
                            BOX.alertError();
                        }else {
                            toastr.error('Can not cancel this transacsion. Please try again!', 'Error!');
                            swal.close();
                        }
                    });
                });
            },

            nextPagination() {
            	this._fetchHistory(this.nextPageUrl).done(histories => {
            		this.histories = this.histories.concat(histories);
            	}, err => {
            		BOX.alertError();
            	});
            }
        },
}
</script>
