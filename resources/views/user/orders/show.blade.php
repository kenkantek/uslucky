@extends('layouts.master')

@section('body-class','ticket')

@section('title') Your tickets @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> Your Tickets </h2>
                <hr>
                <show-order></show-order>

                <hr>

            </div>
        </div>
    </div>
@stop
