<template>
    <filter-tool :data.sync="data"></filter-tool>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer"
               id="datatable_products" aria-describedby="datatable_products_info" role="grid">
            <thead>
            <tr role="row" class="heading">
                <th width="1%" class="sorting_disabled" rowspan="1" colspan="1">
                    <div class="checker"><span><input type="checkbox" class="group-checkable"></span>
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
                <th width="10%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="1"> Status
                </th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="datatable_products"
                    rowspan="1" colspan="1"> Actions
                </th>
            </tr>
            <tr role="row" class="filter">
                <td rowspan="1" colspan="1"><input type="checkbox"></td>
                <td rowspan="1" colspan="1">
                    0001</td>
                <td rowspan="1" colspan="1">
                    <img src="http://dummyimage.com/300x200/000/fff" alt="" width="150px">
                </td>
                <td rowspan="1" colspan="1">
                    Product Name
                </td>
                <td rowspan="1" colspan="1">
                    $100</td>
                <td rowspan="1" colspan="1">
                    May 26, 2016
                </td>
                <td rowspan="1" colspan="1">
                    <span class="label label-danger">Un-publish</span>
                </td>
                <td rowspan="1" colspan="1">
                    <div class="margin-bottom-5">
                        <button class="btn btn-sm btn-success filter-submit margin-bottom">
                            <i class="fa fa-pencil"></i> Edit
                        </button>
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

    export default{
        data(){
            return{
                api: laroute.route('ecommerce.api.list'),
                data: {
                    per_page: "10",
                },
            }
        },


        components: {FilterTool}
    }
</script>