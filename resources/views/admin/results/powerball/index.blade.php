@extends('admin.layouts.master')

@section('title') Daily Results Powerball @stop

@section('content')
    <h3 class="page-title"> Daily Results Powerball
        <small>Results & statistics</small>
    </h3>
    {!! Breadcrumbs::render('powerball.result.index') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <results-daily-powerball>
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Daily Results Powerball</span>
                    </div>
                </results-daily-powerball>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
