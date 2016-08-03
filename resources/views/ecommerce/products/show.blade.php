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
							@if(($product->sale_price != null) && ($product->sale_price > 0))
								<strike>${{number_format($product->sale_price)}}</strike>
							@endif
	        			</p>
	        		</div>

	        		<div class="button-add-cart">
	        			<item-product inline-template product="{{ collect($product)->merge(['content' => '']) }}">
							<div class="form-group col-md-12">
								<label>QTY: </label>


								<input type="number" step="1" min="1" @change="updateCountCart(qty, $event)" class="form-control qty" v-model="qty" required="required">
							</div>
							@if($product->offer)
							<div class="col-md-12">
								<div style="width: 300px; margin-bottom: 10px; text-align: justify">
									<h4>Special Offer:</h4>
									{{$product->offer}}
								</div>
							</div>
							@endif
	        				<div class="col-md-12">
								<a href="#" class="add2cart text-uppercase col-md-9" @click.prevent="addToCart"><i class="fa fa-shopping-cart fa-lg"></i> 立即抢购</a>
							</div>
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
