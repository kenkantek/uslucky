@extends('layouts.master')

@section('title') My Prizes @stop

@section('body-class') winnings @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-3 col-lg-4">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-8">
                <h2>Withdraw your winnings now</h2>
                <hr>
                <winning>
                    <div class="error-notice" slot="notice-minimum">
                        <div class="oaerror info">
                            <p>
                                *The minimum amount you can withdraw is <strong>US $ {{ env('MINIMUM_AMOUNT', 25) }}</strong>
                            </p>
                        </div>
                    </div>
                </winning>
            </div>
        </div>
    </div>
@stop
