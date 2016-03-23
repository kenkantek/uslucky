@extends('admin.layouts.master')

@section('title', 'Order details')

@section('content')
    <h3 class="page-title"> Manage Orders
        <small>Order details</small>
    </h3>
    {!! Breadcrumbs::render('order.show', $orders) !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <order-details>
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Order details</span>
                    </div>
                </order-details>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
