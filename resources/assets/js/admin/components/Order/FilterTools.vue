<template>
    <div class="row" v-if="data">
        <div class="col-md-8 col-sm-12">
            <div class="pagination-panel"> Page 
                <a href="#" class="btn btn-sm default prev" @click.prevent="prevPage" :disabled="!data.prev_page_url">
                    <i class="fa fa-angle-left"></i>
                </a>
                    <input type="text" class="pagination-panel-input form-control input-sm input-inline input-mini" v-model="data.current_page">
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
                         <option value="-1">All</option>
                     </select> records
                 </label>
                 <span class="seperator">|</span>Found total {{ data.total }} records
            </div>
        </div>

        <div class="col-md-4 col-xs-12">
            <div class="pull-right">
                <label>Search:
                    <input type="search" 
                        class="form-control input-sm input-small input-inline" 
                        placeholder="keyword ..." 
                        v-el:keyword
                         @keyup="onKeyup | debounce 500"
                        >
                </label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data', 'keyword'],

        data() {
            keyuping: false
        },

        methods: {
            onKeyup() {
                this.keyword = this.$els.keyword.value.trim();
            },

            prevPage() {
                if(this.data.prev_page_url) {
                    this.$parent._fetchOrders(this.data.prev_page_url).done(data => {
                        this.data = data
                    });
                }
            },

            prevNext() {
                if((this.data.next_page_url)) {
                    this.$parent._fetchOrders(this.data.next_page_url).done(data => {
                        this.data = data
                    });
                }
            }
        } 
    }
</script>