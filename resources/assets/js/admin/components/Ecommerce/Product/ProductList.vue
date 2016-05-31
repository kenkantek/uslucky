<template>
    <filter-tool
            :data.sync="data"
            :link-create="linkCreate"></filter-tool>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer"
               id="datatable_products" aria-describedby="datatable_products_info" role="grid">
            <thead>
            <tr role="row" class="heading">
                <th width="1%" class="sorting_disabled" rowspan="1" colspan="1">
                    <div class="checker"><span><input type="checkbox" v-model="checkAll"></span>
                    </div>
                </th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="1"> ID
                </th>
                <th width="30%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="2"> Product&nbsp;Name
                </th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="1"> Price
                </th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="1"> Date&nbsp;Created
                </th>
                <!--<th width="10%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="1"> Status
                </th>-->
                <th width="10%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="1"> Actions
                </th>
            </tr>
            <tr role="row" v-for="product in data.data" class="filter" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                <td rowspan="1" colspan="1"><input type="checkbox" v-model="ids" :value="product.id"></td>
                <td rowspan="1" colspan="1" v-text="product.id"></td>
                <td rowspan="1" colspan="1">
                    <img :src="product.thumb" alt="" width="150px">
                </td>
                <td rowspan="1" colspan="1" v-text="product.name"></td>
                <td rowspan="1" colspan="1" v-text="product.price | currency"></td>
                <td rowspan="1" colspan="1" v-text="product.created_at"></td>
                <!--<td rowspan="1" colspan="1">
                    <span class="label label-danger">Un-publish</span>
                </td>-->
                <td rowspan="1" colspan="1">
                    <div class="margin-bottom-5">
                        <a :href="product.id | linkEdit" class="btn btn-sm btn-success filter-submit margin-bottom">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </div>
                    <button class="btn btn-sm btn-default filter-cancel">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</template>

<script>
    import laroute from '../../../../laroute';
    import FilterTool from './FilterTools.vue';
    import deferred from 'deferred';

    export default{
        data(){
            return{
                api: laroute.route('ecommerce.api.list'),
                data: {
                    per_page: "10",
                },
                linkCreate: laroute.route('ecommerce.admin.ecommerce.products.create'),
                ids: []
            }
        },

        asyncData(resolve, reject) {
            this._fetchProducts(this.api).done(data => {
                resolve({ data });
        }, err => {
                console.warn(err);
            });
        },

        watch: {
            checkAll(val) {
                this.ids = val ? this.data.data.map(product => { return product.id }) : [];
            }
        },

        methods: {
            _fetchProducts(api, take = this.data.per_page) {
                const def = deferred();
                this.$http.get(api, { take }).then(res => {
                    const { data } = res;
                def.resolve(data);
            }, res => {
                    def.reject(res);
                });
                return  def.promise;
            },
        },

        filters: {
            linkEdit(products) {
                return laroute.route('ecommerce.admin.ecommerce.products.edit', { products });
            },
        },


        components: {FilterTool}
    }
</script>