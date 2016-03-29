@extends('admin.layouts.master')

@section('title') Award Matching Module @stop

@section('content')
    <h3 class="page-title"> Award Module
        <small>Module & statistics</small>
    </h3>
    {!! Breadcrumbs::render('result.award.module') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <award-powerball>
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Award Results</span>
                    </div>
                </award-powerball>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
