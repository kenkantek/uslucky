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
                <div class="portlet light ">
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table-striped table-checkable table table-hover table-bordered admin">
                                <thead>
                                <tr class="uppercase">
                                    <th><input type="checkbox" v-model="checkAll"></th>
                                    <th>#ID</th>
                                    <th colspan="2">Customer Name</th>
                                    <th> Bought date</th>
                                    <th> Qty</th>
                                    <th> Total</th>
                                    <th colspan="2"> Description</th>
                                    <th> Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox" v-model="ids" value="1"></td>

                                    <td>112</td>

                                    <td colspan="2">
                                        <img height="50" :src="order.user.image">
                                        <a href="javascript:;" class="primary-link">Customer name</a>
                                    </td>

                                    <td>Apr 27, 2016</td>

                                    <td>4</td>

                                    <td>
                                        $400
                                    </td>

                                    <td colspan="2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. </td>

                                    <td>
                                <span class="label label-success">Success</span>
                                    </td>

                                    <td class="text-center">
                                        <a class="label label-default" href="{{route('admin.product-orders.show',1)}}"><i
                                                    class="fa fa-eye"></i></a>
                                        <a class="label label-info" target="_blank" href="#"><i
                                                    class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
