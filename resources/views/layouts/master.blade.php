<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home')</title>

    {!! HTML::style('css/font-awesome-4.5.0/css/font-awesome.min.css') !!}
    @yield('styles')
    {!! HTML::style(elixir('css/app.css')) !!}


  </head>
  <body class="@yield('body-class', 'home')">
    @include('_partials.header')

    <main>
      @yield('content')
    </main>

    @include('_partials.footer')
    @include('_partials.php2js')

    {!! HTML::script('js/libs/jquery-2.1.4.min.js') !!}
    {!! HTML::script('js/libs/bootstrap.min.js') !!}

    @yield('scripts')

    {!! HTML::script(elixir('js/app.js')) !!}
  </body>
</html>
