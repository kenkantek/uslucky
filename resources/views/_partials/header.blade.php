<header id="header">
    <section class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <p class="text-welcome text-nowrap">
                        uslucky e-commerce website system: Order Site uslucky.com
                    </p>
                </div>
                <div class="col-xs-12 col-md-5 col-md-offset-3">
                    <ul class="right-menu">
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
                        <li class="@if(app()->getLocale() === 'en') lang-current @endif">
                            <a href="{{ route('front::switch.lang', 'en') }}">EN</a>
                        </li>
                        <li class="@if(app()->getLocale() === 'cn') lang-current @endif">
                            <a href="{{ route('front::switch.lang', 'cn') }}">CN</a>
                        </li>
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

    <div class="clearfix"></div>

    <section class="logo">
        <div class="container">
            <a href="{{ route('front::home') }}">
                <img src="http://tour.dotdotbuy.com/uploads/main/allimg/20150910/20150910111710.png" alt="">
            </a>
        </div>
    </section>

    <section class="manin-navigation">
        <div class="container">
            <ul class="list-nav clearfix">
                <li>
                    <a href="{{ route('front::home') }}" class="@if($routeName === 'front::home') active @endif">
                        {{ trans('menu.home') }}
                    </a>
                </li>
                <li>
                    <a href="#">
                        {{ trans('menu.nyc') }}
                    </a>

                    <ul class="sub-nav">
                        <li>
                            <a href="#">Broadway</a>
                        </li>
                        <li>
                            <a href="#">Museum</a>
                        </li>
                        <li>
                            <a href="#">Concert</a>
                        </li>
                        <li>
                            <a href="{{ route('front::game.powerball') }}">
                                {{ trans('menu.powerball') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front::game.megamillions') }}">
                                {{ trans('menu.megamilions') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        {{ trans('menu.vagas') }}
                    </a>

                    <ul class="sub-nav">
                        <li>
                            <a href="#">Shows</a>
                        </li>
                        <li>
                            <a href="#">Museum</a>
                        </li>
                        <li>
                            <a href="#">Concert</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('front::special.offers') }}">
                        {{ trans('menu.special_offers') }}
                    </a>
                </li>
            </ul>
        </div>
    </section>
</header>
