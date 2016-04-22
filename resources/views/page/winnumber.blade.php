@extends('layouts.master')
@section('content')
<div class="bg4 p8">
	<div class="container">
		<div class="col-md-12">
			<h2>{{trans('winning.title')}}</h2>
			{!! trans('winning.des') !!}
		</div>
		<div class="col-md-12">
			<winnumber></winnumber>
		</div>
	</div>
</div>

@stop
