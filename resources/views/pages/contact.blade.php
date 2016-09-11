@extends('layouts.master')
@section('content')
<div class="bg4 p9">
	<div class="container">
		<div class="row">

			<div class="col-md-8">
				{{--<h2>UsLucky</h2>--}}
				{!! HTML::image('images/contactus.jpg', 'contactus', ['class' => 'img-responsive']) !!}
			</div>

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<h2>{{ trans('contact.title') }}</h2>
						<contact></contact>
						<hr>
					</div>

					<div class="col-md-12">
						<address class="address1">
			                <p>85 Broad Street, 19th Fl. <strong>New York, NY 10004</strong></p>

			                <dl>
			                    <dt></dt>
			                    <dd>{{ trans('contact.phone') }}: <span>888.587.6885</span></dd>
			                    {{--<dd>FAX: <span>+1 504 889 9898</span></dd>--}}
			                    <dd>E-mail: <span><a href="#">hello@uslucky.com</a></span></dd>
								<dd><a href="{{route('front::contact.partner')}}">Partnership with us</a></dd>
			                </dl>
			            </address>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

@stop