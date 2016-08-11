@extends('layouts.master')

@section('title') My Prizes @stop

@section('body-class') winnings @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2>{{trans('setting.title_winning')}}</h2>
                <hr>
                <winnumber></winnumber>
            </div>
        </div>
    </div>
@stop
