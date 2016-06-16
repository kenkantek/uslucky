@extends('admin.layouts.master')

@section('title') Products @stop

@section('content')
    <h3 class="page-title"> Products
        <small>All products</small>
    </h3>

    {!! Breadcrumbs::render('product.index') !!}

    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart"></i>Product Listing
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <ecommerce-product-list inline-template>
                    <filter-tool
                        :data.sync="data"
                        :link-create="linkCreate"
                    >
                    </filter-tool>

                    <div v-if="$loadingAsyncData">
                        <loading></loading>
                    </div>

                    <div v-else class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable  no-footer">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="1%" class="hidden" rowspan="1">
                                        <div class="checker"><span><input type="checkbox" v-model="checkAll"></span>
                                        </div>
                                    </th>
                                    <th width="1%">ID</th>
                                    <th width="30%" rowspan="1" colspan="2"> Product Name
                                    </th>
                                    <th width="10%" rowspan="1" colspan="1"> Price
                                    </th>
                                    <th width="15%" rowspan="1" colspan="1"> Date Created
                                    </th>
                                    <th width="10%" rowspan="1" colspan="1"> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in data.data" class="filter" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                                    <td class="hidden" rowspan="1">
                                        <div class="checker">
                                            <span>
                                                <input type="checkbox">
                                            </span>
                                        </div>
                                    </td>
                                    <td v-text="product.id"></td>
                                    <td rowspan="1" colspan="1">
                                        <img :src="product.thumb" alt="" width="150px">
                                    </td>
                                    <td rowspan="1" colspan="1" v-text="product.name"></td>
                                    <td rowspan="1" colspan="1" v-text="product.price | currency"></td>
                                    <td rowspan="1" colspan="1" v-text="product.created_at"></td>
                                    <td rowspan="1" colspan="1">
                                        <a :href="product.id | linkEdit" class="btn btn-sm btn-success filter-submit margin-bottom">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-default filter-cancel" @click="deleteProduct(product)">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="!data.data.length">
                                    <td colspan="9">Product empty</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </ecommerce-product-list>
            </div>
        </div>
    </div>
@stop
