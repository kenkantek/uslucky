<template>
    <div class="portlet-title">
        <slot name="header"></slot>
        <div class="table-group-actions" style="clear:both; margin-bottom:25px">
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <label>Game Type:</label>
                    <select class="form-control" v-model="game">
                        <option v-for="game in games" :value="game.id" v-text="game.name"></option>
                    </select>
                </div>
                
                <div class="col-xs-12 col-md-3">
                    <label>Draw Date:</label>
                    <select class="form-control" v-model="drawAt">
                        <option 
                        v-for="result in results |  filterBy game in 'game_id'" 
                        v-text="result.draw_at" :value="result.id">
                        </option>
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
    import _ from 'lodash';

    export default {
        props: ['game', 'games', 'drawAt'],

        data() {
            return {
                results: [],
            }
        },

        ready() {
            this.results = _results;
        },

        methods: {
            onSearch() {
                this.$dispatch('go-to-page');
            }
        },

        filters: {
            formatDate(val) {
                return typeof val === 'string' ? val : val.format('MM/DD/YYYY');
            }
        },
    }
</script>