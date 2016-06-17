@extends('layouts.master')
@section('content')
<div class="bg4 p9">
	<div class="container">
		<div class="row">

			<div class="col-md-8">
				<h2>UsLucky</h2>
				<img src="{{ asset('images/usa-powerball.jpg') }}">
			</div>

			<div class="col-md-4">
				<h2>{{ trans('contact.title') }}</h2>
				<contact></contact>
				<hr>
				<address class="address1">
	                <p>8901 Marmora Road, <br>Glasgow, D04 89GR.</p>
	                <dl>
	                    <dt></dt>
	                    <dd>{{ trans('contact.mobile') }}: <span>+1 800 559 6580</span></dd>
	                    <dd>{{ trans('contact.telephone') }}: <span>+1 959 603 6035</span></dd>
	                    <dd>FAX: <span>+1 504 889 9898</span></dd>
	                    <dd>E-mail:&nbsp;<span><a href="#">mail@demolink.org</a></span></dd>
	                </dl>
	            </address>
			</div>

		</div>
	</div>
</div>

@stop
