@extends('admin.layouts.master')

@section('title') All Withdraws request @stop

@section('content')
    <h3 class="page-title"> Manage Withdraw request
        <small>All request</small>
    </h3>

    {!! Breadcrumbs::render('withdraw') !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <request-list></request-list>
            </div>
        </div>
    </div>
@stop
