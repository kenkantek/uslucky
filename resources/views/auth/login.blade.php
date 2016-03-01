@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login to {!! env('TITLE') !!}</div>
                <div class="panel-body">
                    <sign-in></sign-in>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
