@extends('layouts.master')

@section('body-class', 'product')

@section('title') {{ $product->name }} @stop

@section('content')

	<div class="container">

		{!! Breadcrumbs::render('front.product', $product) !!}

    	<section class="box-detail main-detail">
    		<div class="title-show">
	        	<h2>{{ $product->name }}</h2>
	        </div>
	        <div class="row">
	        	<div class="col-xs-12 col-md-7">
	        		<div id="slider" class="flexslider">
	        		    <ul class="slides">
	        		    	@foreach($product->images as $image)
	        		        <li>
	        		            <img src="{{ $image->image }}" />
	        		        </li>
	        		        @endforeach
	        		    </ul>
	        		</div>
	        		<div id="carousel" class="flexslider">
	        		    <ul class="slides">
	        		        @foreach($product->images as $image)
	        		        <li>
	        		            <img src="{{ $image->image }}" />
	        		        </li>
	        		        @endforeach
	        		    </ul>
	        		</div>

	        		<div class="product-description hidden">
	        			{{ $product->description }}
	        		</div>
	        	</div>

	        	<div class="col-xs-12 col-md-5">
	        		<div class="price">
	        			<p>
	        				<span>Price: </span>
	        				<strong>${{ number_format($product->price) }}</strong>
	        			</p>
	        		</div>

	        		<div class="button-add-cart">
	        			<item-product inline-template product="{{{ collect($product)->merge(['content' => '']) }}}">
	        				<a href="#" class="add2cart text-uppercase" @click.prevent="addToCart">add to cart</a>
	        			</item-product>
	        		</div>
	        	</div>

	        </div>
    	</section>

    	<section class="box-detail content-detail">
    		{!! $product->content !!}
    	</section>
    </div>

@stop


@section('styles')
	{!! HTML::style('js/libs/flexslider/flexslider.css') !!}
@stop

@section('scripts')
	{!! HTML::script('js/libs/flexslider/jquery.flexslider.js') !!}

	<script>

		$(window).load(function() {
		  // The slider being synced must be initialized first
		  $('#carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    itemWidth: 210,
		    itemMargin: 5,
		    asNavFor: '#slider'
		  });

		  $('#slider').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    sync: "#carousel"
		  });
		});

	</script>
@stop
