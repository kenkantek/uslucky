<template>
    <section class="main-game">
        <header-power 
            :powerball="powerball"
            :tickets="tickets" 
            :ticket-template="ticketTemplate"
            :each-per-ticket="eachPerTicket"
        >
        </header-power>

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
                    {{$l('powerball.luckynumber')}}</button>
                    <strong 
                        @click="saveLucky"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Save lucky numbers"
                    ><i class="fa fa-floppy-o fa-lg"></i></strong>
                </span>
                <button class="btn btn-info text-uppercase" @click="quickPick"> {{$l('powerball.button')}}</button>
                <button class="btn btn-danger" 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Clear all lines"
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
                        <input type="checkbox" v-model="extra"> <strong>{{$l('powerball.extra',{'extra' : extraPerTicket})}}</strong>
                    </label>
                </div>

                <div class="total">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>{{$l('powerball.price')}} ({{ ticketsActive.length }} {{ ticketsActive.length | pluralize 'Line'}} X {{ eachPerTicket | currency }})</td>
                                <td>{{ priceTickets | currency }}</td>
                                <td></td>
                            </tr>
                            <tr v-show="extra">
                                <td>Extra ({{ ticketsActive.length }} {{ ticketsActive.length | pluralize 'Line'}} X {{ extraPerTicket | currency }})</td>
                                <td>{{ priceExtraTickets | currency }}</td>
                                <td></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>{{$l('powerball.total')}}</th>
                                <th>{{ total | currency }}</th>
                                <td class="text-right">
                                     <button 
                                        data-toggle="modal" 
                                        data-target="#squarespaceModal" 
                                        class="btn btn-primary center-block" 
                                        data-backdrop="static" 
                                        :disabled="disabledPlay"
                                        @click="openModal"
                                        data-keyboard="false">{{$l('powerball.play')}}
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </section>

            
        </article>
    </section>
    <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog">
    <form-modal v-if="submiting" :submiting.sync="submiting" :tickets="ticketsActive" :extra="extra" :total="total"></form-modal>
    </div>
</template>


<script>
    import HeaderPower from './HeaderPower.vue';
    import Ticket from './Ticket.vue';
    import FormModal from './FormModal.vue';
    import ChooseLine from './ChooseLine.vue';
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
                powerball: {..._powerball},
                eachPerTicket: each_per_ticket,
                extraPerTicket: extra_per_ticket,
                extra: Boolean(Number(localStorage.extra)) || null,
                submiting: false,
                numberLineDefault: 3,
                luckys: _.mapValues(_luckys, lucky => JSON.parse(lucky))
            }
        },

        computed: {
            lineDefault() {
                return this.tickets.length || 3;
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
                    localStorage.tickets = JSON.stringify(tickets);
                },
                deep: true
            },
            extra(val) {
                localStorage.extra = Number(val);
            }
        },

        ready() {
            if(localStorage.tickets) {
                this.tickets = JSON.parse(localStorage.tickets);
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
                    return toastr.warning('Login to play this lottery with your lucky numbers');
                }
                this.$http.put(laroute.route('front::put.luckys'), {
                    line: this.lineDefault,
                    tickets: this.tickets
                }).then(res => {
                    this.luckys[this.lineDefault] = _.cloneDeep(this.tickets);
                    toastr.success('Numbers saved!');
                }, res => {
                    COMMON.alertError();
                });
            },
            applyLucky() {
                this.tickets = _.cloneDeep(this.luckys[this.lineDefault]);
                toastr.success('Apply lucky numbers success!');
            }
        },

        events: {
            'remove-ticket'(ticket) {
                this.tickets.$remove(ticket);
            }
        },

        components: { HeaderPower, Ticket, FormModal, ChooseLine }
    }

</script>