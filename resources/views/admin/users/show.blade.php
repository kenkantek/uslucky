@extends('admin.layouts.master')

@section('title') User details @stop
@section('css')
<link href="{{asset('tadmin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <h3 class="page-title"> Manage User
        <small>User details</small>
    </h3>
    {!! Breadcrumbs::render('user.show', $users) !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <show-user>
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">User details</span>
                    </div>
                </show-user>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop

@section('script')
<script src="{{asset('tadmin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
@stop
