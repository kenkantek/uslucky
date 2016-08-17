<template>
    <section class="main-game">
        <header-game 
            :next-time="nextTime"
            :tickets="tickets" 
            :ticket-template="ticketTemplate"
            :each-per-ticket="eachPerTicket"
        >
        </header-game>

        <article class="view-game clearfix">
            <section class="pull-left">
                <div class="addthis_sharing_toolbox"></div>
            </section>
            <section class="top-controls pull-right">
                <span class="lucky-numbers">
                    <button class="btn" type="button" 
                    :disabled="isDisabledLuckyBtn"
                    @click="applyLucky"
                    >
                        {{ $l('play.luckynumber') }}
                    </button>
                    <strong 
                        @click="saveLucky"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Save lucky numbers"
                    ><i class="fa fa-floppy-o fa-lg"></i></strong>
                </span>
                <button class="btn btn-info text-uppercase" @click="quickPick"> {{ $l('play.quick_pick') }}</button>
                <button class="btn btn-danger" 
                data-toggle="tooltip" 
                data-placement="top" 
                title="清除"
                @click="clearAll"
                :disabled="statusClearAll"
                :each-per-ticket="eachPerTicket"
                :extra-per-ticket="extraPerTicket"
                >
                    <i class="fa fa-refresh"></i>
                </button>
            </section>

            <section class="tickets">
                <choose-line 
                    :tickets="tickets" 
                    :line-default.sync="lineDefault"
                    :ticket-template="ticketTemplate">
                </choose-line>

                <div class="list-ticket clearfix">
                    <div class="ticket" v-for="ticket in tickets" track-by="$index" :class="{active: _ticketActive(ticket)}">
                        <ticket :ticket.sync="ticket" :i="$index" :status-disable="statusDisable"></ticket>
                    </div>
                </div>

                <div class="multiplier checkbox">
                    <label>
                        <input type="checkbox" v-model="extra">
                        <strong>
                            {{ $l('play.per_line_extra',{ extra : extraPerTicket }) }}
                        </strong>
                    </label>
                </div>

                <div class="total">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>
                                    {{ $l('play.per_line') }} ({{ ticketsActive.length }} 注<!--{{ ticketsActive.length | pluralize 'Line'}}--> X {{ eachPerTicket | currency }})
                                </td>
                                <td>{{ priceTickets | currency }}</td>
                                <td></td>
                            </tr>
                            <tr v-show="extra">
                                <td>{{ $l('play.extra') }} ({{ ticketsActive.length }} 注<!--{{ ticketsActive.length | pluralize 'Line'}}--> X {{ extraPerTicket | currency }})</td>
                                <td>{{ priceExtraTickets | currency }}</td>
                                <td></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>{{ $l('play.total') }}</th>
                                <th>{{ total | currency }}</th>
                                <td class="text-right">
                                     <button 
                                        data-toggle="modal" 
                                        data-target="#squarespaceModal" 
                                        class="btn btn-primary center-block" 
                                        data-backdrop="static" 
                                        :disabled="disabledPlay"
                                        @click="openModal"
                                        data-keyboard="false">{{ $l('play.play_now') }}
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">**收费说明：官方强力球彩票$2 /张，网上第三方行用卡安全支付平台收取$0.33/张，uslucky代购费$0.67/张。倍增彩官方收取$1/张。</td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </section>

            
        </article>
    </section>
    <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog">
        <form-modal v-if="submiting" name="powerball" :submiting.sync="submiting" :tickets="ticketsActive" :extra="extra" :total="total"></form-modal>
    </div>
</template>


<script>
    import HeaderGame from '../Global/HeaderGame.vue';
    import Ticket from './Ticket.vue';
    import FormModal from '../Global/FormModal.vue';
    import ChooseLine from '../Global/ChooseLine.vue';
    import laroute from '../../../laroute';
    import COMMON from '../../../common';
    import _ from 'lodash';
    
    export default {
        data() {
            return {
                isLogin: _isLogin,
                ticketTemplate: {
                    numbers: [],
                    ball: null
                },
                tickets: [],
                nextTime: {..._nextTime},
                eachPerTicket: each_per_ticket,
                extraPerTicket: extra_per_ticket,
                extra: Boolean(Number(localStorage[`extra_${_game_id}`])) || null,
                submiting: false,
                numberLineDefault: default_line_number,
                luckys: _.mapValues(_luckys, lucky => JSON.parse(lucky))
            }
        },

        computed: {
            lineDefault() {
                return this.tickets.length || default_line_number;
            },
            statusDisable() {
                return this.tickets.length > 1 ? false : true;
            },
            statusClearAll() {
                return this.tickets.every(ticket => (!ticket.numbers || !ticket.numbers.length) && !ticket.ball);
            },
            ticketsActive() {
                return this.tickets.filter(ticket => this._ticketActive(ticket));
            },
            priceTickets() {
                return this.ticketsActive.length * this.eachPerTicket;
            },
            priceExtraTickets() {
                return this.extra ? this.ticketsActive.length * this.extraPerTicket : 0;
            },
            total() {
                return this.priceTickets + this.priceExtraTickets;
            },
            disabledPlay() {
                return this.total < this.eachPerTicket;
            },
            isDisabledLuckyBtn() {
                return !this.isLogin || !this.luckys[this.lineDefault];
            }
        },

        watch: {
            tickets: {
                handler(tickets) {
                    localStorage[`tickets_${_game_id}`] = JSON.stringify(tickets);
                },
                deep: true
            },
            extra(val) {
                localStorage[`extra_${_game_id}`] = Number(val);
            }
        },

        ready() {
            if(localStorage[`tickets_${_game_id}`]) {
                this.tickets = JSON.parse(localStorage[`tickets_${_game_id}`]);
            } else {
                for(let i = 0; i < this.numberLineDefault; i++) {
                    this.tickets.push({...this.ticketTemplate, uuid: Math.random()});
                }
            }
        },

        methods: {
            quickPick() {
                this.$broadcast('quick-pick');
            },
            clearAll() {
                this.tickets.map((ticket) => {
                    ticket.numbers = [];
                    ticket.ball = null;
                    return ticket;
                });
            },
            _ticketActive(ticket) {
                return !!(ticket.numbers && ticket.numbers.length === 5 && ticket.ball);
            },
            openModal() {
                this.submiting = true;
            },
            saveLucky() {
                if(!this.isLogin) {
                    return toastr.warning(this.$l('message.login_to_luckys'));
                }
                this.$http.put(laroute.route('front::put.luckys'), {
                    line: this.lineDefault,
                    tickets: this.tickets
                }).then(res => {
                    this.luckys[this.lineDefault] = _.cloneDeep(this.tickets);
                    toastr.success(this.$l('message.number_saved'));
                }, res => {
                    COMMON.alertError();
                });
            },
            applyLucky() {
                this.tickets = _.cloneDeep(this.luckys[this.lineDefault]);
                toastr.success(this.$l('message.apply_number_lucky'));
            }
        },

        events: {
            'remove-ticket'(ticket) {
                this.tickets.$remove(ticket);
            }
        },

        components: { HeaderGame, Ticket, FormModal, ChooseLine }
    }

</script>