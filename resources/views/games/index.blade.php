@extends('layouts.master')

@section('title' , 'Games')

@section('content')
<div class="bg4 p8">
	<div class="container">
		<div class="col-md-6">
			<div class="thumbs">
				<img class="img-responsive" src="https://tribwpix.files.wordpress.com/2016/01/powerball-11.jpg" alt="">
                 <div class="capture">
                   <h2><a href="{{route('front::game.powerball')}}">
                   	{{ trans('nav.powerball') }}
                   </a></h2>
                   <p style="color: #0b97c4;font-size: 14pt;">{{ trans('game.des_powerball') }}</p>
                   <a href="{{ route('front::game.powerball') }}" class="btn btn-danger">{{trans('game.button')}}</a>
                 </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="thumbs">
				<img class="img-responsive" src="http://casinoonline.it/assets/Uploads/Lottery-Mega-Millions.jpg" alt="">
                 <div class="capture">
                   <h2><a href="#">
						{{ trans('nav.megamilions') }}
                   </a></h2>
                   <p style="color: #0b97c4;font-size: 14pt; height: 156px">{{ trans('game.des_mega') }}</p>
                   <a href="{{ route('front::game.megamillions') }}" class="btn btn-danger">
                   {{ trans('game.button') }}
                   </a>
                 </div>
			</div>
		</div>

		<div class="col-md-12 new-game">
			<div class="row">
				<div class="col-md-4">
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
				<div class="col-md-4">
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
				<div class="col-md-4">
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
