<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') | {!! env('TITLE') !!}</title>
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bevan">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    {!! HTML::style('css/font-awesome-4.5.0/css/font-awesome.min.css') !!}
    {!! HTML::style('js/libs/sweetalert/sweetalert.css') !!}
    {!! HTML::style('js/libs/toastr/toastr.min.css') !!}
    @yield('styles')
    {!! HTML::style(elixir('css/app.css')) !!}


  </head>
  <body class="@yield('body-class', 'home')">
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1700699863552929";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
    @include('_partials.header')

    <div class="content">
      @yield('content')
    </div>

    </div>

    @include('_partials.footer')
    @include('_partials.php2js')

    {!! HTML::script('js/libs/jquery-2.1.4.min.js') !!}
    {!! HTML::script('js/libs/bootstrap.min.js') !!}
    {!! HTML::script('js/libs/sweetalert/sweetalert.min.js') !!}
    {!! HTML::script('js/libs/toastr/toastr.min.js') !!}

    @yield('scripts')

    {!! HTML::script(elixir('js/app.js')) !!}
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56f8b211183fa62c" async="async"></script>
  </body>
</html>
