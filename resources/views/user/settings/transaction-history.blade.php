@extends('layouts.master')

@section('body-class','history')

@section('title') {{trans('setting.title_trans')}} @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> {{trans('setting.title_trans')}} </h2>
                <div class="pull-right">
                    <h3>{{trans('setting.balance')}}: ${{number_format($amount,2)}}</h3>
                </div>
                <hr>
                <transaction></transaction>

                <hr>

            </div>
        </div>
    </div>
@stop
