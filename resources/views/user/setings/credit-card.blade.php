@extends('layouts.master')

@section('title') Credit Card Setting @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-3 col-lg-4">
                @include('user.setings._sizebar')
            </div>

            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-8">
                <h2> Update Your Credit Card </h2>
                <hr>
                <p>
                    Want to update the credit card that we have on file? Provide the new details here. Do not worry your card information will never touch our servers.
                </p>
                <hr>

                <credit-card>
                	<div slot="warning-no-payment" class="error-notice">
                		<div class="oaerror warning">
                			<strong><i class="fa fa-info-circle fa-lg"></i></strong> - No payment methods available
                		</div>
                		<hr>
                	</div>
                </credit-card>
            </div>
        </div>
    </div>
@stop

@section('scripts')
{!! HTML::script('https://js.stripe.com/v2/') !!}
@stop
