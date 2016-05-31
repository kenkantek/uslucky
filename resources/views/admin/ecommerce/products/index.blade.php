@extends('admin.layouts.master')

@section('title') Products @stop

@section('content')
    <h3 class="page-title"> Products
        <small>All products</small>
    </h3>
    {!! Breadcrumbs::render('result.index') !!}
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart"></i>Product Listing
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="btn btn-circle btn-default dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                        <i class="fa fa-share"></i>
                        <span class="hidden-xs"> Tools </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;"> Export to Excel </a>
                        </li>
                        <li class="divider"></li>
                    </div>
                </div>
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
                                    <th width="1%" class="sorting_disabled" rowspan="1">
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
                                    <td rowspan="1">
                                        <input type="checkbox" v-model="ids" :value="product.id">
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
                                        <button class="btn btn-sm btn-default filter-cancel">
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