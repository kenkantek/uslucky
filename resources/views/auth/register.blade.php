@extends('layouts.master')

@section('title') Sign Up @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sign Up for your <strong>{!! env('TITLE') !!}</strong> account below</div>
                <div class="panel-body">
                    <sign-up></sign-up>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
