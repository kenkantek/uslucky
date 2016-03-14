<template>
    <article class="header-game clearfix">
        <div class="jackpot pull-right text-center">
            <span><strong>ESTIMATED JACKPOT</strong></span>
            <h1><strong>{{ powerball.amount | currency }}</strong></h1>
        </div>
        <div class="draw-date clearfix">
            <div class="col-xs-4 col-md-offset-2">
                EACH TICKET COSTS {{ eachPerTicket | currency }}
            </div>
            <div class="col-xs-6">
                <h5 class="text-right">
                    Next draw date   <time>{{ powerball.time }}</time>
                </h5>
            </div>
        </div>
        <div class="tickets clearfix">
            <div class="col-xs-10">
                How many tickets do you want to buy:
                <input type="text" :value="tickets.length" readonly>
                <input type="button" value="+1 ticket" @click="addTicket">
            </div>
            <div class="col-xs-2">
                Total: <span> <sup>$</sup>{{ total }}</span>
            </div>
        </div>
    </article>
</template>

<script>

    export default {
        props: ['total', 'powerball', 'tickets', 'ticketTemplate', 'eachPerTicket'],

        methods: {
            addTicket() {
                this.tickets.push({...this.ticketTemplate, uudi: Math.random()});
            }
        }

    }
</script>