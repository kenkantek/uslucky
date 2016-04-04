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
                   <p>Powerball is a lottery operated by New South Wales Lotteries in New South Wales and the Australian Capital Territory, Tattersalls in Victoria and Tasmania, Golden Casket in Queensland, the South Australia Lotteries Commission, and Lotterywest in Western Australia.</p>
                   <center><a href="{{route('front::game.powerball')}}" class="link">play now</a></center>
                 </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="thumbs">
				<img class="img-responsive" src="http://casinoonline.it/assets/Uploads/Lottery-Mega-Millions.jpg" alt="">
                 <div class="capture">
                   <h2><a href="#">mega millions</a></h2>
                   <p>Mega Millions (which began as The Big Game in 1996, with the name modified to The Big Game Mega Millions six years later) is an American multi-jurisdictional lottery game; it is offered in 44 states, the District of Columbia, and the U.S. Virgin Islands.</p>
                   <center><a href="#" class="link">play now</a></center>
                 </div>
			</div>
		</div>
	</div>
</div>
@stop
