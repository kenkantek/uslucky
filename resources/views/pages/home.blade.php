@extends('layouts.master')

@section('content')
    <div class="demo-2">
        @include('_partials._slider-home')
    </div>

	@if($nyc)
    <section class="nav-nyc tab-category">
		<div class="container">
			{{--<div class="tab-header clearfix">--}}
				{{--@foreach($nyc->childrens as $key => $sub)--}}
				{{--<a href="{{ route('front::ecommerce.category.show', $sub->id) }}" class="@if(!$key) active @endif" data-target="{{ $sub->id }}">--}}
					{{--{{ $sub->name }}--}}
				{{--</a>--}}
				{{--@endforeach--}}
				{{--<a href="{{ route('front::game.powerball') }}">--}}
					{{--{{ trans('nav.powerball') }}--}}
				{{--</a>--}}
				{{--<a href="{{ route('front::game.megamillions') }}">--}}
					{{--{{ trans('nav.megamilions') }}--}}
				{{--</a>--}}
				{{--<a href="{{ route('front::ecommerce.category.show', 1) }}">--}}
					{{--{{ trans('nav.nyc') }}--}}
					{{--<i class="fa fa-angle-double-right"></i>--}}
				{{--</a>--}}
			{{--</div>--}}

			<div class="tab-contents">
				<div class="active" data-source="1">
					@foreach($nyc->products as $product)
					<article class="item-product">
						<a class="product-link" href="{{ route('front::ecommerce.product.show', $product->id) }}">
							<img src="{{ $product->thumb }}" height="315" alt="{{ $product->name }}">
							<p class="text-nowrap pull-left" style="max-width: 250px">
								{{$product->name}}
							</p>
							<div class="product-price pull-right">
								<span>$ {{ number_format($product->price,2) }}</span>
							</div>
							<div class="product-description">
								<div style="
								vertical-align: middle;
								width: 100%;
								height: 260px;
								display: table-cell;
							">
									{{ $product->description }}
								</div>
							</div>
						</a>

					</article>
					@endforeach
				</div>
			</div>

		</div>
    </section>
    @endif

    	@if($vagas)
        <section class="nav-vagas tab-category">
    		<div class="container">
    			{{--<div class="tab-header clearfix">--}}
    				{{--@foreach($vagas->childrens as $key => $sub)--}}
    				{{--<a href="{{ route('front::ecommerce.category.show', $sub->id) }}" class="@if(!$key) active @endif" data-target="{{ $sub->id }}">--}}
    					{{--{{ $sub->name }}--}}
    				{{--</a>--}}
    				{{--@endforeach--}}
    				{{--<a href="{{ route('front::ecommerce.category.show', 2) }}">--}}
    					{{--{{ trans('nav.vagas') }}--}}
    					{{--<i class="fa fa-angle-double-right"></i>--}}
    				{{--</a>--}}
    			{{--</div>--}}

    			<div class="tab-contents">
    				<div class="active" data-source="2">
    					@foreach($vagas->products as $product)
    					<article class="item-product">
    						<a class="product-link" href="{{ route('front::ecommerce.product.show', $product->id) }}">
    							<img src="{{ $product->thumb }}" height="315" alt="{{ $product->name }}">
    							<p class="text-nowrap pull-left" style="max-width: 250px">
    								{{ $product->name }}
    							</p>
								<div class="product-price pull-right">
									<span>$ {{ number_format($product->price,2) }}</span>
								</div>
								<div class="product-description">
									<div style="width: 100%;height: 260px; display: table-cell; vertical-align: middle">
										{{ $product->description }}
									</div>
								</div>
    						</a>

    					</article>
    					@endforeach
    				</div>
    			</div>

    		</div>
        </section>
        @endif
@stop

@section('scripts')
	<script type="text/javascript" src="/js/libs/FullscreenSlitSlider/js/modernizr.custom.79639.js"></script>
	<script type="text/javascript" src="/js/libs/FullscreenSlitSlider/js/jquery.ba-cond.min.js"></script>
	<script type="text/javascript" src="/js/libs/FullscreenSlitSlider/js/jquery.slitslider.js"></script>


	<script type="text/javascript">
		jQuery(function($) {
			var SliderHome = (function() {

				var $nav = $( '#nav-dots > span' ),
					slitslider = $( '#slider' ).slitslider( {
						onBeforeChange : function( slide, pos ) {

							$nav.removeClass( 'nav-dot-current' );
							$nav.eq( pos ).addClass( 'nav-dot-current' );

						}
					} ),

					init = function() {

						initEvents();

					},
					initEvents = function() {

						$nav.each( function( i ) {

							$( this ).on( 'click', function( event ) {

								var $dot = $( this );

								if( !slitslider.isActive() ) {

									$nav.removeClass( 'nav-dot-current' );
									$dot.addClass( 'nav-dot-current' );

								}

								slitslider.jump( i + 1 );
								return false;

							} );

						} );

					};

					return { init : init };

			})();
			SliderHome.init();

			//TAB
			$('.tab-category .tab-header a').on('click', function() {
				$(this)
					.addClass('active')
					.siblings()
					.removeClass('active');

				var target = $(this).data('target');
				if(target) {
					$(this)
					.closest('.tab-header')
					.next('.tab-contents')
					.children('div[data-source='+ target +']')
					.addClass('active')
					.siblings()
					.removeClass('active');

					return false;
				}

			});
		});
	</script>
@stop
