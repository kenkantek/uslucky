@extends('admin.layouts.master')

@section('title', 'Order details')

@section('content')
    <h3 class="page-title"> Manage Orders
        <small>Order details</small>
    </h3>

    {!! Breadcrumbs::render('ecommerce.order.show', $order) !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">

                <ecommerce-order-show id="{{ $order->id }}"></ecommerce-order-show>

            </div>
        </div>
    </div>
@stop
