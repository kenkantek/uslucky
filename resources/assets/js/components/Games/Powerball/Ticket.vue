<template>
    <section class="numbers">
        <div class="controls clearfix">
            <button class="btn btn-info btn-xs pull-left" @click="quickPick">Quick Pick</button>
            <button class="btn btn-danger btn-xs pull-right" @click="removeTicket" :disabled="statusDisable">
                <i class="fa fa-trash-o fa-lg"></i>
            </button>
        </div>

        <div class="choose">
            <i class="fa fa-plus"></i> Choose <span v-text="5 - ticket.numbers.length"></span>
        </div>
        <div class="list-numbers noselect" :data-index="i + 1">
            <span v-for="number in 69" 
                class="number" 
                v-text="number + 1"
                @click="selectNumber(number + 1)"
                :class="{selected: _checkSelected(number + 1)}"
            ></span>
        </div>
        <hr>
        <div class="choose">
            <i class="fa fa-plus"></i> Choose <span v-text="ticket.ball ? 0 : 1"></span>
        </div>
        <div class="list-numbers noselect number-ball">
            <span 
            v-for="number in 26" 
            class="number"
            v-text=" number + 1"
            @click="selectBall(number + 1)"
            :class="{selected: number + 1 === ticket.ball}"
            >
            </span>
        </div>
        <i class="done fa fa-check fa-3x"></i>
    </section>
</template>

<script>
    export default {
        props: ['i', 'statusDisable', 'ticket', 'eachPerTicket', 'extraPerTicket'],

        methods: {
            removeTicket() {
                this.$dispatch('remove-ticket', this.ticket);
            },

            _checkSelected(number) {
                return this.ticket.numbers.indexOf(number) === -1 ? false :  true;
            },

            _toastrWarning(number = 5) {
                toastr.warning(`Please choose max ${number} number or click number choosed for remove it.`);
            },

            selectNumber(number) {
                if(this._checkSelected(number)) {
                    this.ticket.numbers = this.ticket.numbers.filter(num => number !== num);
                } else {
                    if(this.ticket.numbers.length >= 5) 
                        return this._toastrWarning();
                    this.ticket.numbers = [...this.ticket.numbers, number];
                }
            },

            selectBall(number) {
                if(this.ticket.ball) {
                    if(this.ticket.ball === number) {
                        this.ticket.ball =  null;
                    } else  {
                        return this._toastrWarning(1);
                    }
                } else
                    this.ticket.ball = number;
            },

            quickPick() {
                const numbers = _.sampleSize(_.range(1, 69 + 1), 5),
                        ball = _.random(1, 26);

                this.ticket.numbers = numbers;
                this.ticket.ball = ball;

            }
        },

        events: {
            'quick-pick'() {
                this.quickPick();
            }
        }
    }
</script>