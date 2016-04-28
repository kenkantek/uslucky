<style scoped>
    .time {
        padding: 3px;
        background: #E5EBF1;
        color: #191818;
    }
</style>
<template>
    <article class="header-game clearfix">
        <div class="jackpot pull-right text-center">
            <span><strong>{{$l('powerball.jackpot')}}</strong></span>
            <h1><strong>{{ nextTime.amount | currency }}</strong></h1>
        </div>
        <div class="draw-date clearfix">
            <div class="col-xs-4 col-md-offset-2">
                
            </div>
            <div class="col-xs-6">
                <h5 class="text-right">
                    {{ $l('game.next_draw') }}: <time class="time" :title="nextTime.time">{{ nextTime.time }}</time>
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
    import { countDown } from '../../../common.js';
    import countdown from '../../../filter/countdown.js';

    export default {
        props: ['nextTime', 'tickets', 'ticketTemplate', 'eachPerTicket'],

        data() {
            return {
                timeOutId: null,
                downTime: null
            }
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