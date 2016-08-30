<header id="header">
  <section class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-4">
                <p class="text-welcome text-nowrap">
                  {{ trans('header.top') }}
                </p>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-6 col-md-offset-2">
                <ul class="right-menu clearfix">
                    @if($auth)
                       <li class="cursor my-acccount">
                           <div class="dropdown-toggle clearfix" data-toggle="dropdown">
                               <span>
                                   {{ $auth->fullname }}
                                   @if($auth->notification_not_read)
                                       [ {{ $auth->notification_not_read }} ]
                                   @endif
                               </span>
                               <div class="wrap-avatar">
                                   {!! HTML::image($auth->image, 'avatar', ['class' => 'img-responsive']) !!}
                               </div>
                               <b class="caret"></b>
                           </div>
                           <ul class="dropdown-menu">
                               <li>
                                   <a href="{{ route('front::ecommerce.order') }}">
                                       {!! trans('setting.menu_order_product') !!} <i class="fa fa-lg fa-cart-plus pull-right"></i>
                                   </a>
                               </li>
                               <li>
                                   <a href="{{ route('front::orders.index') }}">
                                       {!! trans('setting.menu_order') !!} <i class="fa fa-lg fa-shopping-cart pull-right"></i>
                                   </a>
                               </li>
                               <li>
                                   <a href="{{ route('front::settings.winning') }}">{!! trans('setting.menu_winning') !!} <i class="fa fa-trophy fa-lg pull-right"></i></a>
                               </li>
                               <li>
                                   <a href="{{ route('front::payment.history') }}">{!! trans('setting.menu_trans') !!} <i class="fa fa-history fa-lg pull-right"></i></a>
                               </li>
                               <li>
                                   <a href="{{ route('front::settings.notifications') }}">{!! trans('setting.menu_notic') !!} <span class="badge pull-right"> {{ $auth->notification_not_read }} </span></a>
                               </li>
                               <li>
                                   <a href="{{ route('front::settings.affiliate') }}">Affiliate <i class="fa fa-link fa-lg pull-right"></i></a>
                               </li>
                               <li>
                                   <a href="{{ route('front::settings.account') }}">{!! trans('setting.menu_account_setting') !!} <i class="fa fa-cog fa-lg pull-right"></i></a>
                               </li>
                               <li>
                                   <a href="/logout">{!! trans('setting.menu_sign_out') !!} <i class="fa fa-sign-out fa-lg pull-right"></i></a>
                               </li>
                           </ul>
                       </li>
                   @else
                       <li><a href="{{ url('register') }}">
                            {{ trans('menu.join') }}
                       </a></li>
                       <li><a href="{{ url('login') }}">
                            {{ trans('menu.log_in') }}
                       </a></li>
                   @endif

                    <li><a href="{{ route('front::contact') }}">
                        {{ trans('footer.contact_us') }}
                    </a></li>
                    <li><a href="#">
                        {{ trans('menu.help') }}
                    </a></li>
                    {{--<li class="@if(app()->getLocale() === 'en') lang-current @endif">--}}
                        {{--<a href="{{ route('front::switch.lang', 'en') }}">EN</a>--}}
                    {{--</li>--}}
                    {{--<li class="@if(app()->getLocale() === 'cn') lang-current @endif">--}}
                        {{--<a href="{{ route('front::switch.lang', 'cn') }}">CN</a>--}}
                    {{--</li>--}}
                    <li class="btn-cart">
                        <a href="{{ route('front::ecommerce.cart') }}">
                            <i class="fa fa-shopping-cart fa-lg"></i>
                        </a>
                        <cart></cart>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  </section>

  <section class="logo clearfix">
      <div class="container">
        <a href="{{ route('front::home') }}">
          {!! HTML::image('images/new_logo1.png', env('TITLE'), ['width' => 200]) !!}
        </a>
      </div>
  </section>

  <section class="main-navigation">
    <div class="container">
        <ul class="list-nav clearfix">
            <li>
                <a style="font-size: 2em;
    padding: 0px 15px;" href="{{ route('front::home') }}" class="@if($routeName === 'front::home') active @endif">
                    {!! trans('menu.home') !!}
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 3) }}">
                    {{ trans('nav.broadway') }}
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 4) }}">
                    超值电影票
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 12) }}">
                    美景超享受
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 13) }}">
                    美食超折扣
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 14) }}">
                    好玩超刺激
                </a>
            </li>
            {{--<li>--}}
                {{--<a href="{{ route('front::ecommerce.category.show', 2) }}">--}}
                    {{--{{ trans('nav.vagas') }}--}}
                {{--</a>--}}

                {{--<ul class="sub-nav">--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('front::ecommerce.category.show', 6) }}">--}}
                            {{--{{ trans('nav.shows') }}--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('front::ecommerce.category.show', 7) }}">--}}
                            {{--{{ trans('nav.trade_show') }}--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ route('front::ecommerce.category.show', 8) }}">--}}
                            {{--{{ trans('nav.concert') }}--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li>
                <a href="{{ route('front::game.get.index') }}">
                    美国彩票
                </a>
                <ul class="sub-nav">
                    <li>
                        <a href="{{ route('front::game.powerball') }}">
                            {{ trans('nav.powerball') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front::game.megamillions') }}">
                            {{ trans('nav.megamilions') }}
                        </a>
                    </li>
                </ul>
            </li>
            {{--<li>--}}
                {{--<a href="{{ route('front::special.offers') }}">--}}
                    {{--优惠--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div>
  </section>
</header>
