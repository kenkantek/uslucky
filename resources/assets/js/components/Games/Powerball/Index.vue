
<template>

    <section class="main-game">
        <header-power 
            :powerball="powerball" 
            :total="total" 
            :tickets="tickets" 
            :ticket-template="ticketTemplate"
            :each-per-ticket="eachPerTicket"
        >
        </header-power>

        <article class="view-game clearfix">
            <section class="pull-left">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_sharing_toolbox"></div>
            </section>
            <section class="top-controls pull-right">

                <button class="btn btn-info text-upercase" @click="quickPick"> Quick Pick</button>
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
                <div class="list-ticket clearfix">
                    <div class="ticket" v-for="ticket in tickets" track-by="$index" :class="{active: _ticketActive(ticket)}">
                        <ticket :ticket.sync="ticket" :i="$index" :status-disable="statusDisable"></ticket>
                    </div>
                </div>

                <div class="multiplier checkbox">
                    <label>
                        <input type="checkbox" v-model="extra"> <strong>For An Extra {{ extraPerTicket | currency }} Per Ticket, Make It A Power Play</strong>
                    </label>
                </div>

                <div class="total">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>Ticket Price ({{ ticketsActive.length }} {{ ticketsActive.length | pluralize 'Line'}} X {{ eachPerTicket | currency }})</td>
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
                                <th>Total</th>
                                <th>{{ total | currency }}</th>
                                <td class="text-right">
                                     <button 
                                        data-toggle="modal" 
                                        data-target="#squarespaceModal" 
                                        class="btn btn-primary center-block" 
                                        data-backdrop="static" 
                                        :disabled="disabledPlay"
                                        @click="openModal"
                                        data-keyboard="false">Play Now
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </section>

            
        </article>
    </section>
    <form-modal v-if="submiting" :submiting.sync="submiting" :tickets="ticketsActive" :extra="extra" :total="total"></form-modal>
</template>


<script>
    import HeaderPower from './HeaderPower.vue';
    import Ticket from './Ticket.vue';
    import FormModal from './FormModal.vue';
    
    export default {
        data() {
            return {
                ticketTemplate: {
                    numbers: [],
                    ball: null
                },
                tickets: [],
                powerball: {..._powerball},
                eachPerTicket: _each_per_ticket,
                extraPerTicket: _extra_per_ticket,
                extra: Boolean(Number(localStorage.extra)) || null,
                submiting: false
            }
        },

        computed: {
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
                this.tickets.push({...this.ticketTemplate, uudi: Math.random()});
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
            }
        },

        events: {
            'remove-ticket'(ticket) {
                this.tickets.$remove(ticket);
            }
        },

        components: { HeaderPower, Ticket, FormModal }
    }

</script>