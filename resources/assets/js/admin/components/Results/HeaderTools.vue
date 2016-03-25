<template>
    <div class="portlet-title">
        <slot name="header"></slot>
        <div class="table-group-actions pull-right">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <label>From:</label>
                    <datepicker :value.sync="date.dateFrom | formatDate" format="MM/DD/YYYY" name="closing_date"><datepicker>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label>To:</label>
                    <datepicker :value.sync="date.dateTo | formatDate" format="MM/DD/YYYY" name="closing_date"><datepicker>
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
        props: ['date'],

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