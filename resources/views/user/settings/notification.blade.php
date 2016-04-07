@extends('layouts.master')

@section('body-class', 'noti')

@section('title') Your notifications @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> Your notifications </h2>
                <hr>
                <ul class="notifications">
                    <li class="refund">
                        <p>Because your order #11 at 2016-04-01 07:16:52 was canceled. We refund to you. Total amount: $30.<br>
                        <small>8 minutes ago</small>
                        </p>
                    </li>
                    <li class="reward">
                        <p>You are WINNER with ticket number: <b>11 22 33 44 55 <span style="color: red">06</span></b>. Prize: Jackpot with $116.000.000.<br>
                        <small>2016-04-01 07:16:52</small>
                        </p>
                    </li>
                    <li class="purchased">
                        <p>Your order #11 at 2016-04-01 07:16:52 was purchased. Please check by <a href="">Your order</a> menu.<br>
                        <small>2016-04-01 07:16:52</small>
                        </p>
                    </li>
                    <li class="paid">
                        <p>Your claim request #12 at 2016-04-01 07:16:52 was paid. Total amount: $500<br>
                        <small>2016-04-01 07:16:52</small>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop
