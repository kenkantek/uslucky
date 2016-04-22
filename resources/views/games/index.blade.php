@extends('layouts.master')

@section('title' , 'Games')

@section('content')
<div class="bg4 p8">
	<div class="container">
		<h2>OUR GAMES</h2>
		<div class="col-md-6">
			<div class="thumbs">
				<img class="img-responsive" src="https://tribwpix.files.wordpress.com/2016/01/powerball-11.jpg" alt="">
                 <div class="capture">
                   <h2><a href="{{route('front::game.powerball')}}">powerball</a></h2>
                   <p>{{trans('game.des_powerball')}}</p>
                   <center><a href="{{route('front::game.powerball')}}" class="link">{{trans('game.button')}}</a></center>
                 </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="thumbs">
				<img class="img-responsive" src="http://casinoonline.it/assets/Uploads/Lottery-Mega-Millions.jpg" alt="">
                 <div class="capture">
                   <h2><a href="#">mega millions</a></h2>
                   <p>{{trans('game.des_mega')}}</p>
                   <center><a href="#" class="link">{{trans('game.button')}}</a></center>
                 </div>
			</div>
		</div>
	</div>
</div>
@stop
