<template>
    <article class="header-game clearfix">
        <div class="jackpot pull-right text-center">
            <span><strong>{{ $l('play.estimated_jackpot') }}</strong></span>
            <h1><strong>{{ nextTime.amount | currency }}</strong></h1>
        </div>
        <div class="draw-date clearfix">
            <div class="col-xs-4 col-md-offset-2">
                
            </div>
            <div class="col-xs-6">
                <h5 class="text-right text-muted">
                    {{ $l('game.draw_closed') }}: <strong>{{ downTime | countdown }}</strong>
                </h5>
            </div>
        </div>
        <div class="hidden tickets clearfix">
            <div class="col-xs-10">
                {{$l('powerball.many')}}
                <input type="text" :value="tickets.length" readonly>
                <input type="button" value="+1 ticket" @click="addTicket">
            </div>
        </div>
    </article>
</template>

<script>
    import { countDownGame } from '../../../common.js';
    import countdown from '../../../filter/countdown.js';

    export default {
        props: ['nextTime', 'tickets', 'ticketTemplate', 'eachPerTicket'],

        data() {
            return {
                timeOutId: null,
                downTime: null
            }
        },

        ready() {
            const now = new Date(_date.now);
            this.timeOutId = setInterval(() => {
                now.setSeconds(now.getSeconds() + 1);
                this.downTime = countDownGame(now, this.nextTime.time, hours_before_close);
            }, 1000);
        },

        methods: {
            addTicket() {
                this.tickets.push({...this.ticketTemplate, uuid: Math.random()});
            }
        },

        filters: {
            countdown
        },

        destroy() {
            clearInterval(this.timeOutId);
        }

    }
</script>