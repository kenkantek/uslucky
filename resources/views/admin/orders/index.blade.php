@extends('admin.layouts.master')

@section('title') All Orders @stop

@section('content')
    <h3 class="page-title"> Manage Orders
        <small>Order & statistics</small>
    </h3>

    {!! Breadcrumbs::render('order') !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <order>
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">All Orders</span>
                    </div>
                </order>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
