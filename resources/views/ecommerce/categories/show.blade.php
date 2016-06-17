@extends('layouts.master')

@section('body-class', 'category')

@section('title') {{ $category->name }} @stop

@section('content')

	<div class="container">

		{!! Breadcrumbs::render('front.category', $category) !!}

		<section class="wrap-categories">
			@foreach($category->products as $product)
			<article class="item-product">
				<a href="{{ route('front::ecommerce.product.show', $product) }}" target="_blank">
					<div description="{{ $product->description }}" class="thumb" style="background-image: url({{ $product->thumb }})">
					</div>
					<div class="row product-detail">
						<div class="col-xs-8">
							<p class="product-name">{{ $product->name }}</p>
						</div>
						<div class="col-xs-4">
							<p class="product-price pull-right">$ {{ number_format($product->price) }}</p>
						</div>
					</div>
				</a>
			</article>
			@endforeach
		</section>

    </div>

@stop
