<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{env('TITLE')}} | Admin login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    @include('admin._partials.css')

    {!! HTML::style('tadmin/assets/pages/css/login.min.css') !!}
    {!! HTML::style('js/libs/sweetalert/sweetalert.css') !!}
    {!! HTML::style('js/libs/toastr/toastr.min.css') !!}

<body class="login">
    <div class="logo">
        <a href="index.html">
            {!! HTML::image('tadmin/assets/pages/img/logo-big.png', '') !!}
        </a>
    </div>

    <div class="content">
        <sign-in></sign-in>
    </div>
    <div class="copyright"> {{ date('Y') }} © {{ env('TITLE') }}. </div>

    @include('admin._partials.script')
    @include('_partials.php2js')

    {!! HTML::script('js/libs/sweetalert/sweetalert.min.js') !!}
    {!! HTML::script('js/libs/toastr/toastr.min.js') !!}
    {!! HTML::script('js/admin.js') !!}
</body>
</html>
