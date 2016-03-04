@extends('layouts.master')

@section('title') My Prizes @stop

@section('body-class') winnings @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-3 col-lg-4">
                @include('user.setings._sizebar')
            </div>

            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-8">
                <h2>Withdraw your winnings now</h2>
                <hr>
                You currently have
                <h3>US <span>$ 0.00</span> </h3>
                in your account balance
                <hr>
                <div class="error-notice">
                    <div class="oaerror info">
                        <p>
                            *The minimum amount you can withdraw is <strong>US $ {{ env('MINIMUM_AMOUNT', 25) }}</strong>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="actions">
                    <button class="btn btn-danger">Deposit account <i class="fa fa-play"></i></button>
                    <button class="btn btn-info">Claim your winnings <i class="fa fa-play"></i></button>
                </div>
            </div>
        </div>
    </div>
@stop
