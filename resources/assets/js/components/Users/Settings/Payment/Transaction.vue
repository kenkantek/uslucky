<template>
	<div v-if="$loadingAsyncData"><loading></loading></div>
	<div  v-if="!$loadingAsyncData">
		<table class="table table-bordered table-hover trans" v-if="histories.length">
		    <thead>
		        <tr>
                    <th>#</th>
		            <th>{{$l('setting.up_at')}}</th>
		            <th width="250">{{$l('setting.des')}}</th>
                    <th>{{$l('setting.amount_prev')}}</th>
                    <th>{{$l('setting.amount')}}</th>
                    <th>{{$l('setting.amount_next')}}</th>
		            <th>{{$l('setting.status')}}</th>
		            <th>{{$l('setting.button_cancel')}}</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr v-for="(index, history) in histories" id="transaction-{{ history.id }}">
                    <td>{{ history.id }}</td>
		            <td>{{ history.updated_at }}</td>
		            <td width="250">{{{ history.description }}}</td>
                    <td>{{ history.amount_prev | currency }}</td>
		            <td>
		            	<span :class="[history.type == 1 ? 'text-primary' : 'text-danger']">
                            <strong>{{ history.type == 1 ? '+' : '-' }}{{ history.amount | currency }}</strong>
                        </span>
		            </td>
                    <td>{{ history.amount_total | currency }}</td>
		            <td>	
						<label class="label" :class="{'label-success': history.status.status == 'succeeded', 'label-danger':history.status.status == 'canceled', 'label-warning': history.status.status == 'pendding', 'label-primary':history.status.status == 'processing'}">{{ history.status.status }}</label>
						
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
                        {{$l('setting.not_trans')}}
			        </p>
			    </div>
			</div>
		</div>
		<button style="margin:0; width:100%" class="link" @click="nextPagination" v-show="nextPageUrl" :disabled="loading">
            <i class="fa fa-circle-o-notch fa-spin" v-show="loading"></i> {{$l('setting.load_more')}} {{ numberMore }} {{$l('setting.record')}}</button>
		<div v-show="nextPageUrl" style="width:100%; text-align:center; margin-top:10px">
            {{$l('setting.show')}} {{ histories.length }} {{$l('setting.of')}} {{ totalHistories }} {{$l('setting.record')}}.
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
        		const def = deferred();
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
                    title: this.$l('setting.sure_cancel'),
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, () => {
                    this.$http.put(laroute.route('front::put.cancel.transaction', {
                        one: id
                    })).then(res => {
                        toastr.success(this.$l('setting.canceled'), 'Success!');
                        this.histories[index].status.status = 'canceled';
                        swal.close();
                        this.total = res.data;
                    }, res => {
                        if(res.status === 500) {
                            BOX.alertError();
                        }else {
                            toastr.error(this.$l('setting.err'), 'Error!');
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
