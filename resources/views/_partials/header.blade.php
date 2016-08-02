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
                                   <a href="{{ route('front::orders.index') }}">
                                       <i class="fa fa-shopping-cart"></i>
                                       {{ trans('menu.order') }}
                                   </a>
                               </li>
                               <li>
                                   <a href="{{ route('front::settings.notifications') }}">
                                       <i class="fa fa-envelope"></i> {{ trans('menu.notification') }}
                                       <strong class="number-notify">
                                           {{ $auth->notification_not_read }}
                                       </strong>
                                   </a>
                               </li>
                               <li>
                                   <a href="{{ route('front::settings.account') }}">
                                       <i class="fa fa-cog"></i>
                                       {{ trans('menu.account_setting') }}
                                   </a>
                               </li>
                               <li>
                                    <a href="{{ url('logout') }}">
                                        <i class="fa fa-sign-out"></i>
                                        {{ trans('menu.logout') }}
                                    </a>
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
          {!! HTML::image('images/new_logo1.png', env('TITLE'), ['width' => 280]) !!}
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
                    {{ trans('nav.museum') }}
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 5) }}">
                    {{ trans('nav.concert') }}
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 5) }}">
                    超值电影票
                </a>
            </li>
            <li>
                <a href="{{ route('front::ecommerce.category.show', 5) }}">
                    球赛
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
            <li>
                <a href="{{ route('front::special.offers') }}">
                    优惠
                </a>
            </li>
        </ul>
    </div>
  </section>
</header>
