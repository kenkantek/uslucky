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
                <li @if(Request::route()->getName() == 'front::home') class="active" @endif ><a href="{{url('')}}">HOME</a></li>
                <li @if(Request::route()->getName() == 'front::about') class="active" @endif><a href="{{route('front::about')}}">ABOUT</a></li>
                <li><a href="#">GAMES</a></li>
                <li><a href="#">WINNING NUMBER</a></li>
                <li><a href="#">CONTACT</a></li>
                <li @if(Request::route()->getName() == 'front::') class="active" @endif><a href="{{url('login')}}">REGISTER/LOGIN</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <div class="col-md-12 header_bg">
        <div class="row">
            <img src="{{asset('images/logo.png')}}" class="img-responsive" alt="">

            <div class="slogan">
                DON'T WASTE YOUR TIME!<br>
                WIN TODAY!
            </div>
            @yield('extends_content')
        </div>

    </div>
</div>

<!--End Header-->
