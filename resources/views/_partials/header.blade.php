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
                <li @if($routeName === 'front::home') class="active" @endif ><a href="{{url('')}}">{{trans('home.menu_home')}}</a></li>
                <li @if($routeName === 'front::about') class="active" @endif><a href="{{route('front::about')}}">{{trans('home.menu_about')}}</a></li>
                <li class="dropdown @if(starts_with($routeName, 'front::game')) active @endif"><a href="{{route('front::game.get.index')}}">{{trans('home.menu_game')}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                	<li><a href="{{route('front::game.powerball')}}" title="">Powerball</a></li>
                </ul>
                </li>
                <li @if($routeName === 'front::get.winning.numbers') class="active" @endif><a href="{{route('front::get.winning.numbers')}}">{{trans('home.menu_winning')}}</a></li>
                <li @if($routeName === 'front::contact') class="active" @endif><a href="{{route('front::contact')}}">{{trans('home.menu_contact')}}</a></li>
                @if($auth)
                <li class="cursor my-acccount">
                    <div class="dropdown-toggle clearfix" data-toggle="dropdown">
                        <span>
                            {{$auth->fullname}}
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
                                <i class="fa fa-envelope"></i> Notifications
                                <strong class="number-notify">
                                    {{ $auth->notification_not_read }}
                                </strong>
                            </a>
                        </li>
                        <li><a href="{{route('front::settings.account')}}"><i class="fa fa-cog"></i> Account Settings</a></li>
                    	<li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i>  SignOut</a></li>
                    </ul>
                </li>
                @else
                <li @if($routeName === 'front::') class="active" @endif><a href="{{url('login')}}">{{trans('home.menu_reg')}}</a></li>
                @endif
                <li class="lang en">
                    <a href="{{ route('front::switch.lang', 'en') }}" class="@if(app()->getLocale() === 'en') active @endif">EN</a>
                </li>
                <li class="lang cn">
                    <a href="{{ route('front::switch.lang', 'cn') }}" class="@if(app()->getLocale() === 'cn') active @endif">CN</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-md-12 header_bg">
        <div class="row">
            {!! HTML::image('css/images/logo.png', env('TITLE'), ['class' => 'img-responsive']) !!}
            <div class="slogan">
                {!! trans('home.title') !!}
            </div>
            @yield('extends_content')
        </div>
    </div>
</div>
