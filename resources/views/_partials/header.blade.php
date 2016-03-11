<!--Header-->

<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav nav-custome">
                <li @if($routeName === 'front::home') class="active" @endif ><a href="{{url('')}}">HOME</a></li>
                <li @if($routeName === 'front::about') class="active" @endif><a href="{{route('front::about')}}">ABOUT</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">GAMES <b class="caret"></b></a>
                <ul class="dropdown-menu">
                	<li><a href="{{route('front::game.powerball')}}" title="">Powerball</a></li>
                </ul>
                </li>
                <li><a href="#">WINNING NUMBER</a></li>
                <li><a href="#">CONTACT</a></li>
                @if($auth)
                <li class="cursor"><span class="dropdown-toggle" data-toggle="dropdown">Welcome</span> <img class="dropdown-toggle" data-toggle="dropdown" src="{{$auth->image}}" style="max-height: 30px; margin-top:9px; border-radius: 50px" alt=""><b class="caret"></b>
					<ul class="dropdown-menu">
                    	<li><a href="{{route('front::settings.account')}}"><i class="fa fa-cog"></i>  Account Settings</a></li>
                    	<li><a href="{{url('logout')}}"><i class="fa fa-envelope"></i>  Messgages</a></li>
                    	<li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i>  SignOut</a></li>
                    </ul>
                </li>
                @else
                <li @if($routeName === 'front::') class="active" @endif><a href="{{url('login')}}">REGISTER/LOGIN</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <div class="col-md-12 header_bg">
        <div class="row">
            <img src="{{asset('css/images/logo.png')}}" class="img-responsive" alt="">

            <div class="slogan">
                DON'T WASTE YOUR TIME!<br>
                WIN TODAY!
            </div>
            @yield('extends_content')
        </div>

    </div>
</div>

<!--End Header-->
