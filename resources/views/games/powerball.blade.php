@extends('layouts.master')

@section('title') US Powerball Tickets Online @stop

@section('body-class') content-games game-powerball @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="game col-xs-12">
                <section class="header">
                    <h1>{{trans('powerball.title')}}</h1>
                    <p>
                        {!! trans('powerball.des') !!}
                    </p>
                    <hr>
                </section>

                <powerball></powerball>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56f8b211183fa62c" async="async"></script>
{!! HTML::script('https://js.stripe.com/v2/') !!}
<script type="text/javascript">
    Stripe.setPublishableKey(_stripe.key);
</script>
@stop
