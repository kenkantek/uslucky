@extends('admin.layouts.master')

@section('title') All Orders @stop

@section('content')
    <h3 class="page-title"> Manage Orders
        <small>Order & statistics</small>
    </h3>

    {!! Breadcrumbs::render('ecommerce.order.index') !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <ecommerce-order-list></ecommerce-order-list>
            </div>
        </div>
    </div>
@stop
