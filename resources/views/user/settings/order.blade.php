@extends('layouts.master')

@section('body-class','order')

@section('title') Your order @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> Your order </h2>
                <hr>
                <order></order>

                <hr>

            </div>
        </div>
    </div>
@stop
