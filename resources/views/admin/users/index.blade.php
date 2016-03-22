@extends('admin.layouts.master')

@section('content')
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Your Activity</span>
                            <span class="caption-helper hide">weekly stats...</span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="table-scrollable table-scrollable-borderless">
                            <users-list></users-list>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>

        </div>


    </div>

@stop
