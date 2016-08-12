<template>
    <div class="portlet-title">
        <slot name="header"></slot>
        <div class="table-group-actions pull-right">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label>{{$l('winning.from')}}:</label>
                    <datepicker :value.sync="date.dateFrom | formatDate" format="MM/DD/YYYY" name="closing_date"><datepicker>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label>{{$l('winning.to')}}:</label>
                    <datepicker :value.sync="date.dateTo | formatDate" format="MM/DD/YYYY" name="closing_date"><datepicker>
                </div>
                <div class="col-xs-12 col-md-2">
                    <label>{{$l('winning.game')}}:</label>
                    <select class="form-control" v-model="game">
                        <option v-for="game in games" :value="game.id" v-text="game.name == 'Mega Millions' ? '百万大博彩' : '强力球'"></option>
                    </select>
                </div>
                <div class="col-xs-12 col-md-3">
                    <br>
                    <button style="margin-top:8px" class="btn btn-sm green table-group-action-submit move-top--25" @click="onSearch">
                        <i class="fa fa-check"></i> {{$l('winning.search')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from '../../../components/Globals/Datepicker.vue';

    export default {
        props: ['date', 'game', 'games'],

        methods: {
            onSearch() {
                this.$dispatch('go-to-page', {page: 0});
            }
        },

        filters: {
            formatDate(val) {
                return typeof val === 'string' ? val : val.format('MM/DD/YYYY');
            }
        },

        components: { Datepicker }
    }
</script>