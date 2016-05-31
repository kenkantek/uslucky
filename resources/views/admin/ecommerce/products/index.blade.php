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
                    <ecommerce-product-list></ecommerce-product-list>
                </div>
            </div>
        </div>
    </div>
@stop