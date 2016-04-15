<template>
    <div class="portlet light ">
        <header-tools :game.sync="game_id" :games="games" :draw-at.sync="drawAt">
            <slot slot="header" name="header"></slot>
        </header-tools>
        <div class="portlet-body">
            <filter-tools :data.sync="data" :keyword.sync="keyword">
            </filter-tools>
            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top-10">
                    <loading></loading>
                </div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th> No. </th>
                            <th colspan="2"> MEMBER </th>
                            <th width="60%"> Ticket number </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td>
                                #{{$index+1}}
                            </td>
                            <td colspan="2">
                                <img class="user-pic" :src="user.image" width="30px"> 
                                <a :href="user.id | linkShow" class="primary-link">{{user.fullname}}</a>
                            </td>
                            <td width="60%"> 
                                <win-tickets :user="user.id" :game="game_id" :result="drawAt"></win-tickets>
                            </td>
                        </tr>
                        <tr v-if="!drawAt || !data.data || !data.data.length">
                            <td colspan="9" v-if="!drawAt">Please choose Draw Date and search.</td>
                            <td colspan="9" v-else>No have record.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import laroute from '../../../../laroute.js';
import COMMON from '../../../../common';
import HeaderTools from './HeaderTools.vue';
import deferred from 'deferred';
import moment from 'moment';
import FilterTools from '../../Globals/FilterTools.vue';
import WinTickets from './WinTickets.vue';
import async from 'async';

export default {
    data() {
            return {
                api: laroute.route('admin.get.winners'),
                data: {
                    per_page: "10",
                },
                keyword: '',
                ids: [],
                game_id: 1,
                games: _games,
                drawAt: null
            }
        },

        asyncData(resolve, reject) {
            const vm = this;
            if(this.drawAt) {
                async.waterfall([
                    (cb) => {
                        vm._fetchUsers(vm.api).done(data => {
                            cb(null, data);
                        }, err => {
                            cb(new Error(err));
                        });
                    },
                    (data, cb) => {
                        cb(null, data);
                    }
                ], (err, data) => {
                    resolve({data});
                });
            } else {
                resolve();
            }
            
            
        },

         watch: {
            timeForReload: 'reloadAsyncData',
            'data.per_page'(val, old) {
                (val && old) && this.reloadAsyncData();
            },
        },

        computed: {
            timeForReload() {
                return Math.random(this.keyword + this.drawAt + this.game_id);
            },
        },
   
        methods: {
            _fetchUsers(api, take = this.data.per_page, keyword = this.keyword, game_id = this.game_id, result_id = this.drawAt) {
                const def = deferred();
                this.$http.get(api, { take, keyword, game_id, result_id }).then(res => {
                    const { data } = res;
                    def.resolve(data);
                }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },
        },

        filters:{
            linkShow(users) {
                return laroute.route('admin.users.show', { users });
            },
        },

        events: {
            'go-to-page'(api = null) {
                this.api = api ? api : this.api;
                this.reloadAsyncData();
            }
        },

        components: { HeaderTools, FilterTools, WinTickets }
}
</script>