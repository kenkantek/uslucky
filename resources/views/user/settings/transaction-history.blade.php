@extends('layouts.master')

@section('body-class','history')

@section('title') Transacsion history @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> Your Transacsion History </h2>
                <div class="pull-right">
                    <h3>Your Account Blance: ${{number_format($amount,2)}}</h3>
                </div>
                <hr>
                <transaction></transaction>

                <hr>

            </div>
        </div>
    </div>
@stop
