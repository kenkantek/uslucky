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
        <div class="row">
            <div class="row" style="text-align: right">
                <span>Read More About Playing on Uslucky</span>
                <a onclick="show()" class="btn">Show / Hide</a>
            </div>
            <div class="col-md-8 col-md-offset-2 new-game" id="show">
                <div class="row">
                    <div class="col-md-5">
                        {!! HTML::image('images/1.png','simple',['width' => 200]) !!}
                    </div>
                    <div class="col-md-7">
                        <div class="text-game">
                            <ul>
                                <li>选择您要投注的彩票类型</li>
                                <li>选号投注</li>
                                <li>我们美国公司工作人员会到彩票官方指定点，帮您代购</li>
                                <li>您拥有100%彩票所有权，中奖后彩金100%归您所有，我们不收取任何彩金的佣金</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        {!! HTML::image('images/2.png','simple',['width' => 200]) !!}
                    </div>
                    <div class="col-md-7">
                        <div class="text-game">
                            <ul>
                                <li>您的彩票被扫描到您个人帐户，您可在账户中看见真实票根</li>
                                <li>网上付费加密加锁系统，保证了网上支付的安全性</li>
                                <li>您的彩票安全妥善的保存在美国银行的保险箱里，直到开奖结束</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        {!! HTML::image('images/3.png','simple',['width' => 200]) !!}
                    </div>
                    <div class="col-md-7">
                        <div class="text-game">
                            <ul>
                                <li>足不出户，便可以买到美国官方彩票</li>
                                <li>自动兑奖系统，及时通知您中奖</li>
                                <li>奖金即时兑现，存入您的账户</li>
                            </ul>
                        </div>
                    </div>
                </div>
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
<script>
    function show() {
        var n = $('#show').css("display");
        if(n == 'none')
        {
            $('#show').show()
        } else {
            $('#show').hide()
        }

    }
</script>
@stop
