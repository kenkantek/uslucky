{!! HTML::style('js/libs/FullscreenSlitSlider/css/style.css') !!}
{!! HTML::style('js/libs/FullscreenSlitSlider/css/custom.css') !!}

<div id="slider" class="sl-slider-wrapper">

	<div class="sl-slider">

		<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
			<div class="sl-slide-inner">
				<div class="bg-img bg-img-1"></div>
				<h2 class="visibility-hidden">A bene placito.</h2>
				<blockquote>
					<p class="visibility-hidden">来到赌城，光明正大地当一次“赌神”吧</p>
					<cite>来到赌城，光明正大地当一次“赌神”吧</cite>
				</blockquote>
			</div>
		</div>

		<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
			<div class="sl-slide-inner">
				<div class="bg-img bg-img-2"></div>
				<h2 class="visibility-hidden">Regula aurea.</h2>
				<blockquote>
					<p>放飞心情，感受独一无二的百老汇经典歌舞剧</p>
					<cite>人生就该看场独一无二的经典</cite>
				</blockquote>
			</div>
		</div>

		<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
			<div class="sl-slide-inner">
				<div class="bg-img bg-img-3"></div>
				<h2 class="visibility-hidden">Dum spiro, spero.</h2>
				<blockquote>
					<p>探索未知，美国博物馆的奇妙之旅</p>
					<cite>畅游历史文化的汇集地，不虚美国之行</cite>
				</blockquote>
			</div>
		</div>

		<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
			<div class="sl-slide-inner">
				<div class="bg-img bg-img-4"></div>
				<h2>感受激烈现场，全网最低价门票火热预定中</h2>
				<blockquote>
					<p>低调的价格，疯狂感受劲爆现场</p>
					<cite>全网最低价，去现场当一回疯狂球迷吧</cite>
				</blockquote>
			</div>
		</div>

		<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
			<div class="sl-slide-inner">
				<div class="bg-img bg-img-5"></div>
				<h2 class="visibility-hidden">Acta Non Verba.</h2>
				<blockquote class="visibility-hidden">
					<p>I think if you want to eat more meat you should kill it yourself and eat it raw so that you are not blinded by the hypocrisy of having it processed for you.</p>
					<cite>Margi Clarke</cite>
				</blockquote>
			</div>
		</div>
	</div><!-- /sl-slider -->

	<nav id="nav-dots" class="nav-dots">
		<span class="nav-dot-current"></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</nav>

</div><!-- /slider-wrapper -->

<style>
	main {
		padding: 0px!important;
	}

	.demo-2 .sl-slider-wrapper {
		height: 600px!important;
	}
	.demo-2 .sl-slide-inner > *:not(div) {
		display: none!important;
	}

	body.home .tab-category {
		background: #E9E9E9;
	}
</style>
