@extends('layouts.master')

@section('body-class','order')

@section('title') {{trans('setting.title_order_ticket')}} @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> {{trans('setting.title_order_ticket')}} </h2>
                <hr>
                <table class="table table-bordered table-hover trans" style="margin-bottom: 0px">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Bought date</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Apr 27, 2016</td>
                        <td>4</td>
                        <td>$400</td>
                        <td><span class="label label-danger">Pending</span></td>
                        <td class="text-center"><a class="link" href="{{route('front::product-orders.show',1)}}">{{trans('setting.button_details')}}</a></td>
                    </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
    </div>
@stop
