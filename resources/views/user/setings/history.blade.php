@extends('layouts.master')

@section('body-class','history')

@section('title') Transacsion history @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-3 col-lg-4">
                @include('user.setings._sizebar')
            </div>

            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-8">
                <h2> Your Transacsion History </h2>
                <hr>
                <history></history>

                <hr>

            </div>
        </div>
    </div>
@stop
