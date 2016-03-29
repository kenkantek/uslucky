@extends('admin.layouts.master')

@section('title') Daily Results @stop

@section('content')
    <h3 class="page-title"> Daily Results
        <small>Results & statistics</small>
    </h3>
    {!! Breadcrumbs::render('result.index') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <results-daily>
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Daily Results</span>
                    </div>
                </results-daily>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
