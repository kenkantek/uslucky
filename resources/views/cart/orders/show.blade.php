@extends('layouts.master')

@section('body-class','ticket')

@section('title') Your Products @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> Your Products </h2>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <dl class="dl-horizontal">
                            <dt>#</dt>
                            <dd>01</dd>

                            <dt>Bought date</dt>
                            <dd>Apr 27, 2016</dd>

                            <dt>Qty</dt>
                            <dd>4</dd>
                        </dl>
                    </div>
                    <div class="col-xs-6">
                        <dl class="dl-horizontal">
                            <dt>Total</dt>
                            <dd>$400</dd>

                            <dt>Status</dt>
                            <dd><span class="label label-danger">Pending</span></dd>

                            <dt></dt>
                            <dd class="margin-top-10">
                                <button class="btn btn-primary">Cancel</button>
                            </dd>
                        </dl>
                    </div>
                </div>
                <table class="table table-bordered table-hover trans" style="margin-bottom: 0px">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th colspan="2">Product name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="http://dummyimage.com/300x200/000/fff" alt="" width="100px"></td>
                        <td>Product Name</td>
                        <td>$100</td>
                        <td>4</td>
                        <td>$400</td>
                    </tr>
                    </tbody>
                </table>

                <hr>

            </div>
        </div>
    </div>
@stop
