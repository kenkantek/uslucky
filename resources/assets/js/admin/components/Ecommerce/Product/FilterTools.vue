<template>
    <div class="row" v-if="data">
        <div class="col-md-8 col-sm-12">
            <div class="pagination-panel"> Page
                <a href="#" class="btn btn-sm default prev" @click.prevent="prevPage" :disabled="!data.prev_page_url">
                    <i class="fa fa-angle-left"></i>
                </a>
                <input type="text" class="pagination-panel-input form-control input-sm input-inline input-mini" v-model="data.current_page" @keyup.enter="onGoPage">
                <a href="#" class="btn btn-sm default next"  @click.prevent="prevNext" :disabled="!data.next_page_url">
                    <i class="fa fa-angle-right"></i>
                </a>
                of <span class="pagination-panel-total">{{ data.last_page }}</span>

                <label><span class="seperator">|</span>View
                    <select class="form-control input-xs input-sm input-inline" v-model="data.per_page">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                    </select> records
                </label>
                <span class="seperator">|</span>Found total {{ data.total }} records
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="table-group-actions pull-right">
                <span> </span>
                <select class="table-group-action-input form-control input-inline input-small input-sm">
                    <option value="">Select...</option>
                    <option value="publish">Publish</option>
                    <option value="unpublished">Un-publish</option>
                    <option value="delete">Delete</option>
                </select>
                <button class="btn btn-sm btn-success table-group-action-submit">
                    <i class="fa fa-check"></i> Submit
                </button>
                <button class="btn btn-sm btn-success table-group-action-submit">
                    <i class="fa fa-plus"></i> Add new product
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data', 'keyword'],

        methods: {
            onKeyup() {
                this.keyword = this.$els.keyword.value.trim();
            },

            prevPage() {
                this.data.prev_page_url &&
                this.$dispatch('go-to-page', this.data.prev_page_url);
            },

            prevNext() {
                this.data.next_page_url &&
                this.$dispatch('go-to-page', this.data.next_page_url);
            },

            onGoPage() {
                const page = this.data.current_page;
                let url = this.data.next_page_url || this.data.prev_page_url || null;
                if((page > 0 && page <= this.data.last_page) && url) {
                    return this.$dispatch('go-to-page', url.replace(/page=[\d]+/, `page=${page}`));
                }

                toastr.warning('Can not go to page number ' + page);
            }
        }
    }
</script>