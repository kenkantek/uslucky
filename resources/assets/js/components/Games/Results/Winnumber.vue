<template>
<div class="col-md-12">
	<header-tools :date.sync="date" :game.sync="game_id" :games="games"></header-tools>
</div>
<div class="col-md-12">
	<div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
	<div class="table-responsive">
		<table v-else class="table table-hover">
		    <tbody>
		        <tr>
		        	<th>{{$l('winning.name')}}</th>
		            <th>{{$l('winning.result')}}</th>
		            <th>{{$l('winning.date')}}</th>
		            <th>{{$l('winning.play')}}</th>
		            <th>{{$l('winning.jackpot')}}</th>
		        </tr>
		        <tr v-for="pb in data.draws">
		        	<td class="c1">{{ pb.gameName == 'Mega Millions' ? '百万大博彩' : '强力球' }}</td>
		            <td>
		            	<span v-if="checkWaiting(pb)" class="c1"> {{$l('winning.wait')}}</span>
		                <ul v-else class="list">
		                    <li v-for="number in pb.results[0].primary">
                                <div v-if="$index < 5">{{number}}</div>
                                <div v-if="$index == 6" class="powerball">{{number.slice(-2)}}</div>
                            </li>
		                </ul>
		            </td>
		            <td>
		                <time datetime="{{ pb.drawTime | timestamp2date}}">{{ pb.drawTime | timestamp2date}}</time>
		            </td>
		            <td class="c1">
			            <span v-if="checkWaiting(pb)"> {{$l('winning.wait')}}</span>
	                    <span v-else>{{ pb.results[0].multiplier }}</span>
	                </td>
		            <td class="c1">{{ pb.estimatedJackpot | remove2CharLast | currency }}</td>
		        </tr>  
		    </tbody>
		</table>		
	</div>	
</div>
</template>

<script>
    import laroute  from '../../../laroute.js';
    import deferred from 'deferred';
    import async from 'async';
    import COMMON from '../../../common.js';
    import HeaderTools from '../../../admin/components/Results/HeaderTools.vue';
    import moment from 'moment';
    import timestamp2date from '../../../filter/timestamp2date.js';
    import _ from 'lodash';

    export default {
        data() {
            const week = moment().weekday();
            const dateTo = week >= 3 && week != 6 ? moment().endOf('week') : moment().startOf('week').add(3, 'days');
            const date = {
                dateFrom: moment().add(-1, 'months'),
                dateTo: dateTo, // thứ 4 hoặc thứ 7 tiếp theo
            };
            //console.log(week, date)
            return {
                game_id: 1,
                games: _games,
                date,
                data: {},
                api: laroute.route('api::get.game.results'),
                size: 20,
                params: { 
                    page: 0,
                },
                checkAll: false,
            }
        },


        asyncData(resolve, reject) {
            const vm = this;
            async.parallel({
                data(cb) {
                    vm._fetcDatas(vm.api, {...vm.params, 'game-names': vm.gameName, size: vm.size, 'date-from': vm._makeTimestamp(vm.date.dateFrom), 'date-to': vm._makeTimestamp(vm.date.dateTo)}).done(data => {
                        cb(null, data);
                    }, err => {
                        cb(new Error(err));
                    });
                }
            }, (err, results) => {
                if(err) {
                    COMMON.alertError();
                } else {
                    resolve({ ...results });
                }
            });
            
        },

        watch: {
            size() {
                this.$emit('go-to-page', { page: 0 });
            },
        },

        computed: {
            gameName() {
                return _.find(this.games, { id: this.game_id }).name;
            }
        },

        methods: {
            _fetcDatas(api, params={}) {
                const def = deferred();
                this.$http.get(api, params).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },
            _makeTimestamp(date) {
                const d = typeof date === 'string' ? date : date.format('MM/DD/YYYY hh:mm:ss');
                return new Date(d).getTime();
            },
            checkWaiting(pb) {
                return pb.status === 'OPEN' || !pb.results;
            }
        },

        filters: {
            timestamp2date,
            remove2CharLast(val) {
                return String(val).slice(0, -2)
            }
        },

        events: {
            'go-to-page'(params) {
                Object.assign(this.params, params);
                this.reloadAsyncData();
            }
        },

        components: { HeaderTools }
    }
</script>