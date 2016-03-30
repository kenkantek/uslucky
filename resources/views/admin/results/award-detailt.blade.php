@extends('admin.layouts.master')

@section('title') Award Detail Result @stop

@section('content')
    <h3 class="page-title"> Award Detail Result
        <small>Module & statistics</small>
    </h3>
    {!! Breadcrumbs::render('result.award.detail', $result) !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <award-detail>
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Award Detail Result</span>
                    </div>
                </award-detail>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
