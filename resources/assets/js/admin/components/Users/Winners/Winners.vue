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
                            <th>
                                No.
                            </th>
                            <th colspan="2"> MEMBER </th>
                            <th> Ticket number </th>
                            <th>Ticket status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            <td>
                                #{{$index+1}}
                            </td>
                            <td class="fit">
                                <img class="user-pic" :src="user.image" width="30px"> </td>
                            <td>
                                <a :href="user.id | linkShow" class="primary-link">{{user.fullname}}</a>
                            </td>
                            <td> 
                                <ul class="list">
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li class="powerball">6</li>
                                </ul>
                            </td>
                            <td> <span class="label label-danger">unpaid</span> </td>
                            <td><a class="label label-primary" href=""><i class="fa fa-info"></i></a></td>
                        </tr>
                        <tr v-if="!data.data || !data.data.length">
                            <td colspan="9">No have record.</td>
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
            console.log(this.keyword)
            this._fetchUsers(this.api).done(data => {
                resolve({ data });
            }, err => {
                COMMON.alertError();
                console.warn(err);
            });
        },

         watch: {
            timeForReload: 'reloadAsyncData',
            'data.per_page'(val, old) {
                (val && old) && this.reloadAsyncData();
            },
        },

        computed: {
            timeForReload() {
            return Math.random(this.keyword);
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

        components: { HeaderTools, FilterTools }
}
</script>