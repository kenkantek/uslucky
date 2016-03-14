@extends('layouts.master')

@section('body-class', 'setting')

@section('title') Account Setting @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-3 col-lg-4">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-8">
                <h2> Update Your Account </h2>
                <hr>
                <setting-account></setting-account>
            </div>
        </div>
    </div>
@stop
