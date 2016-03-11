<template>
    <section class="numbers">
        <div class="controls clearfix">
            <button class="btn btn-info btn-xs pull-left">Quick Pick</button>
            <button class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash-o fa-lg"></i></button>
        </div>
        <div class="choose">
            <i class="fa fa-plus"></i> Choose <span>5</span>
        </div>
        <div class="list-numbers">
            <span v-for="number in 69" class="numner">{{ number + 1 }}</span>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['ticket']
    }
</script>