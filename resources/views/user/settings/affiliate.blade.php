@extends('layouts.master')

@section('body-class', 'noti')

@section('title') Affiliate Program @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> Affiliate Program </h2>
                <hr>
                <affiliate></affiliate>
            </div>
        </div>
    </div>
@stop
