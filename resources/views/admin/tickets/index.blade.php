@extends('admin.layouts.master')

@section('title') All Tickets @stop

@section('content')
    <h3 class="page-title"> Manage Tickets
        <small>Ticket & statistics</small>
    </h3>
    {!! Breadcrumbs::render('ticket') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Your Activity</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr class="uppercase">
                                        <th colspan="2"> MEMBER </th>
                                        <th colspan="2"> Ticket total bought </th>
                                        <th> DEPOSIT Total </th>
                                        <th> WITHDRAW/CLAIM Total </th>
                                        <th> Blance </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic" src="{{asset('tadmin/assets/layouts/layout/img/avatar10.jpg')}}">
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="primary-link">Brain</a>
                                        </td>
                                        <td> 5 </td>
                                        <td> $345 </td>
                                        <td> 45 </td>
                                        <td> 124 </td>
                                        <td>
                                            <span class="bold theme-font">80%</span>
                                        </td>
                                        <td><a href="#" class="text-danger"><i class="fa fa-trash"></i></a></td>
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
