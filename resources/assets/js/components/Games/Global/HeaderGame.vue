<template>
    <article class="header-game clearfix">
        <div class="jackpot pull-right text-center">
            <span><strong>{{ $l('play.estimated_jackpot') }}</strong></span>
            <h1><strong>{{ nextTime.amount | currency }}</strong></h1>
        </div>
        <div class="draw-date">
            <h5 class="text-right" :title="nextTime.time">
                {{ $l('game.draw_closed') }}: <strong>{{ downTime | countdown }}</strong>
            </h5>
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