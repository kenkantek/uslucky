<template>
    <div class="portlet-title">
        <slot name="header"></slot>
        <div class="table-group-actions pull-right">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label>Draw Date From:</label>
                    <datepicker :value.sync="date.dateFrom" format="YYYY/MM/DD" name="closing_date"><datepicker>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label>Draw Date To:</label>
                    <datepicker :value.sync="date.dateTo" format="YYYY/MM/DD" name="closing_date"><datepicker>
                </div>
                <div class="col-xs-12 col-md-2">
                    <label>Game Type:</label>
                    <select class="form-control" v-model="game">
                        <option v-for="game in games" :value="game.id" v-text="game.name"></option>
                    </select>
                </div>
                <div class="col-xs-12 col-md-3">
                    <button class="btn btn-sm green table-group-action-submit move-top--25" @click="onSearch">
                        <i class="fa fa-check"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from '../../../components/Globals/Datepicker.vue';

    export default {
        props: ['date', 'games', 'game'],

        methods: {
            onSearch() {
                this.$parent.reloadAsyncData();
            }
        },

        components: { Datepicker }
    }
</script>