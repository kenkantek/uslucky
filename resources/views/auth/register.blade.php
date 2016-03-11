@extends('layouts.master')

@section('title') Sign Up @stop

@section('content')
<div class="container" style="padding-top:30px; padding-bottom: 20px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                    <sign-up></sign-up>
        </div>
    </div>
</div>

@stop

@section('scripts')
@if(Session::has('userFb'))
<script>
var _userFb = {!! json_encode(Session::get('userFb')) !!};
</script>
@endif
@stop
