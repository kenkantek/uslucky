<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav nav-custome">
                <li @if($routeName === 'front::home') class="active" @endif>
                    <a href="{{ route('front::home') }}"> {{ trans('menu.home') }} </a>
                </li>
                <li>
                    <a href="">Broadway</a>
                </li>
                <li>
                    <a href="">Vega</a>
                </li>
                <li>
                    <a href="">Museum</a>
                </li>
                <li class="dropdown @if(starts_with($routeName, 'front::game')) active @endif"><a
                            href="{{route('front::game.get.index')}}">{{trans('home.menu_game')}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('front::game.powerball') }}">
                                {{ trans('menu.powerball') }}
                            </a></li>
                        <li><a href="{{ route('front::game.megamillions') }}">
                                {{ trans('menu.megamilions') }}
                            </a></li>
                    </ul>
                </li>
                <li @if($routeName === 'front::special.offers') class="active" @endif>
                    <a href="{{ route('front::special.offers') }}">{{ trans('menu.special_offers') }}</a>
                </li>
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
                            <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> {{ trans('menu.logout') }}
                                </a></li>
                        </ul>
                    </li>
                @else
                    <li @if($routeName === 'front::') class="active" @endif>
                        <a href="{{ url('login') }}">
                            {{trans('menu.login')}} / {{trans('menu.register')}}
                        </a>
                    </li>
                @endif
                <li class="lang en">
                    <a href="{{ route('front::switch.lang', 'en') }}"
                       class="@if(app()->getLocale() === 'en') active @endif">EN</a>
                </li>

                <li class="lang cn">
                    <a href="{{ route('front::switch.lang', 'cn') }}"
                       class="@if(app()->getLocale() === 'cn') active @endif">CN</a>
                </li>
                <li class="btn-cart">
                    <a href="{{ route('front::ecommerce.cart') }}">
                        <i class="fa fa-shopping-cart fa-lg"></i>
                    </a>
                    <cart></cart>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-md-12 header_bg">
        <div class="hidden row">
            {!! HTML::image('css/images/logo.png', env('TITLE'), ['class' => 'img-responsive']) !!}
            <div class="slogan">
                {!! trans('home.title') !!}
            </div>
            @yield('extends_content')
        </div>
    </div>
</div>
