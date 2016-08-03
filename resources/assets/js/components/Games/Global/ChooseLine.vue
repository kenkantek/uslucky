<template>
    <div class="choose-lines">
        <a href="#" @click.prevent="chooseLines(line)" v-for="line in lines" :class="{active: line == lineDefault}">
            {{ line }} 注<!--{{line}} {{line | pluralize '注'}}-->
        </a>
    </div>
</template>

<script>
    export default {
        props: ['tickets', 'ticketTemplate', 'lineDefault'],

        data() {
            return {
                lines: [1, 3, 5, 7, 10, 15, 20, 25]
            }
        },

        methods: {
            chooseLines(line) {
                const deviation = Math.abs(line - this.tickets.length);
                for(let i = 0; i < deviation; i++) {
                    if(line > this.lineDefault) {
                        this.tickets.push({...this.ticketTemplate, uuid: Math.random()});
                    } else {
                        this.tickets.pop();
                    }
                }
                this.lineDefault = line;
            }
        }
    }
</script>