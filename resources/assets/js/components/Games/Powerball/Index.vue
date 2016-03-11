<template>

    <section class="main-game">
        <header-power :powerball="powerball" :total="total" :tickets="tickets"></header-power>

        <article class="view-game clearfix">
            <section class="top-controls pull-right">
                <button class="btn btn-info text-upercase"> Quick Pick</button>
                <button class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i></button>
            </section>

            <section class="tickets">
                <div class="ticket" v-for="ticket in tickets">
                    <ticket :ticket.sync="ticket"></ticket>
                </div>
            </section>
        </article>
    </section>

</template>


<script>
    import laroute from '../../../laroute';
    import BOX from '../../../common';
    import HeaderPower from './HeaderPower.vue';
    import Ticket from './Ticket.vue';
    
    export default {
        data() {
            return {
                ticket: {
                    numbers: '',
                    ball: ''
                },
                tickets: [],
                powerball: {..._powerball},
                multiplier: false
            }
        },

        computed: {
            total() {
                return 0
            }
        },

        ready() {
            this.tickets.push(this.ticket);
        },

        components: { HeaderPower, Ticket }
    }

</script>