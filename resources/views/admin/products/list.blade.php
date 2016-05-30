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
                        <li>
                            <a href="javascript:;"> Export to CSV </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Export to XML </a>
                        </li>
                        <li class="divider"></li>
                        <a href="javascript:;"> Print Invoices </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container" style="">

                <div id="datatable_products_wrapper" class="dataTables_wrapper dataTables_extended_wrapper no-footer">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="dataTables_paginate paging_bootstrap_extended" id="datatable_products_paginate">
                                <div class="pagination-panel"> Page <a href="#"
                                                                       class="btn btn-sm default prev disabled"><i
                                                class="fa fa-angle-left"></i></a><input type="text"
                                                                                        class="pagination-panel-input form-control input-sm input-inline input-mini"
                                                                                        maxlenght="5"
                                                                                        style="text-align:center; margin: 0 5px;"><a
                                            href="#" class="btn btn-sm default next disabled"><i
                                                class="fa fa-angle-right"></i></a> of <span
                                            class="pagination-panel-total"></span></div>
                            </div>
                            <div class="dataTables_length" id="datatable_products_length"><label><span
                                            class="seperator">|</span>View <select name="datatable_products_length"
                                                                                   aria-controls="datatable_products"
                                                                                   class="form-control input-xs input-sm input-inline">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="150">150</option>
                                    </select> records</label></div>
                            <div class="dataTables_info" id="datatable_products_info" role="status"
                                 aria-live="polite"></div>
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
                            </div>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="dataTables_paginate paging_bootstrap_extended">
                                <div class="pagination-panel"> Page <a href="#"
                                                                       class="btn btn-sm default prev disabled"><i
                                                class="fa fa-angle-left"></i></a><input type="text"
                                                                                        class="pagination-panel-input form-control input-sm input-inline input-mini"
                                                                                        maxlenght="5"
                                                                                        style="text-align:center; margin: 0 5px;"><a
                                            href="#" class="btn btn-sm default next disabled"><i
                                                class="fa fa-angle-right"></i></a> of <span
                                            class="pagination-panel-total"></span></div>
                            </div>
                            <div class="dataTables_length"><label><span class="seperator">|</span>View <select
                                            name="datatable_products_length" aria-controls="datatable_products"
                                            class="form-control input-xs input-sm input-inline">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="150">150</option>
                                    </select> records</label></div>
                            <div class="dataTables_info"></div>
                        </div>
                        <div class="col-md-4 col-sm-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop