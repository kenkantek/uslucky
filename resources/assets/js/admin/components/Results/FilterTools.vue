<template>
    <div class="row" v-if="data">
        <div class="col-md-8 col-sm-12">
            <div class="pagination-panel"> Page 
                <a href="#" class="btn btn-sm default prev" @click.prevent="prevPage" :disabled="!data.previousPageUrl">
                    <i class="fa fa-angle-left"></i>
                </a>
                    <label>
                        <select class="form-control input-xs input-sm input-inline" v-model="currentPage">
                            <option v-for="page in data.pageUrls" v-text="$index + 1" :value="page"></option>
                            <option value="1" v-if="!data.pageUrls">1</option>
                        </select>
                    </label>
                <a href="#" class="btn btn-sm default next"  @click.prevent="prevNext" :disabled="!data.nextPageUrl">
                    <i class="fa fa-angle-right"></i>
                </a>
                 of <span class="pagination-panel-total">{{ totalPages }}</span>

                 <label><span class="seperator">|</span>View
                     <select class="form-control input-xs input-sm input-inline" v-model="size">
                         <option value="20">20</option>
                         <option value="50">50</option>
                         <option value="100">100</option>
                         <option value="150">150</option>
                         <option value="200">200</option>
                     </select> records
                 </label>
            </div>
        </div>
    </div>
</template>

<script>
    import laroute from '../../../laroute.js';

    export default {
        props: ['data', 'size'],

        data() {
            return {
                currentPage: 1
            }
        },

        computed: {
            totalPages() {
                return this.data.pageUrls ? Object.keys(this.data.pageUrls).length : 1;
            }
        },

        watch: {
            currentPage(val, old) {
                if(val){
                    this.$dispatch('go-to-page', this._urlToOj(val));
                }
            }
        },

        methods: {
            _urlToOj(val) {
                let url = val.substr(val.indexOf('?') + 1);
                const arr = url.split('&');
                const params = {};

                for(let i of arr) {
                  const tmp = i.split('=');
                  params[tmp[0]] = tmp[1];
                }
                return params;
            },

            onKeyup() {
                this.keyword = this.$els.keyword.value.trim();
            },

            prevPage() {
                this.data.previousPageUrl && 
                this.$dispatch('go-to-page', this._urlToOj(this.data.previousPageUrl));
            },

            prevNext() {
                this.data.nextPageUrl && 
                this.$dispatch('go-to-page', this._urlToOj(this.data.nextPageUrl));
            }
        },
    }
</script>