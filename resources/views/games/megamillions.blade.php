@extends('layouts.master')


@section('title') US MegaMillions Tickets Online @stop


@section('body-class') content-games game-megamillions @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="game col-xs-12 col-md-10">
                <section class="header">
                    <h1>{{trans('megamillions.title')}}</h1>
                    <p>
                        {!! trans('megamillions.des') !!}
                    </p>
                    <hr>
                </section>

                <mega-millions></mega-millions>
            </div>
            <div class="sizebar col-xs-12 col-md-2">
                {{--<div class="box">
                    <a href="#">
                        <img class="img-responsive" src="https://s4.thelotter.com/images/9ddac69a079eafd126ef2f4fccd5858e.png">
                    </a>
                </div>

                <div class="box">
                    <a href="#">
                        <img class="img-responsive" src="https://s4.thelotter.com/images/926e20f57aa4ea176da0a763e31bf9e0.png">
                    </a>
                </div>--}}
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
