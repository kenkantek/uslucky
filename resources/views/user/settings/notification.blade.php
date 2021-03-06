@extends('layouts.master')

@section('body-class', 'noti')

@section('title') {{trans('setting.title_notifications')}} @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> {{trans('setting.title_notifications')}} </h2>
                <hr>
                <notification></notification>
            </div>
        </div>
    </div>
@stop
