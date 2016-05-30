@extends('admin.layouts.master')

@section('title', 'Order details')

@section('content')
    <h3 class="page-title"> Manage Orders
        <small>Order details</small>
    </h3>
    {!! Breadcrumbs::render('order') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <div class="portlet light ">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <dl class="dl-horizontal">
                                <dt>Customer Name</dt>
                                <dd>Name</dd>

                                <dt>Bought date</dt>
                                <dd>Apr 27, 2016</dd>

                                <dt>Qty</dt>
                                <dd>4</dd>
                            </dl>
                        </div>

                        <div class="col-xs-6 col-md-4">
                            <dl class="dl-horizontal">
                                <dt>Total</dt>
                                <dd>$400</dd>

                                <dt>Status</dt>
                                <dd><span class="label label-danger">Pending</span></dd>

                            </dl>
                        </div>

                        <div class="col-xs-6 col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Change status to ...</label>
                                    <select class="form-control status">
                                        <option value="canceled">Cancel</option>
                                        <option value="order placed">Success</option>
                                        <option value="pending purchase">Pending</option>
                                    </select>
                                    <div v-if="submiting"><loading></loading></div>
                                </div>
                                <div class="col-md-6">
                                    <a target="_blank" href="#">
                                        <i class="fa fa-print fa-5x margin-top-30"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table-striped table-checkable table table-hover table-bordered admin">
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
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
