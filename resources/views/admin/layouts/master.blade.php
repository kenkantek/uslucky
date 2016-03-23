<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title', 'Dashboard') | {{env('TITLE')}}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        @include('admin._partials.css')
        @yield('css')
        {!! HTML::style('js/libs/sweetalert/sweetalert.css') !!}
        {!! HTML::style('js/libs/toastr/toastr.min.css') !!}
        {!! HTML::style('css/admin.css') !!}
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">

        @include('admin._partials.header')
        <div class="clearfix"> </div>
        <div class="page-container">

            @include('admin._partials.sidebar')

            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>

        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> {{ date('Y') }} &copy; {{ env('TITLE') }}.</div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>

        @include('_partials.php2js')
        @include('admin._partials.script')
        {!! HTML::script('js/libs/sweetalert/sweetalert.min.js') !!}
        {!! HTML::script('js/libs/toastr/toastr.min.js') !!}
        {!! HTML::script('js/admin.js') !!}
        @yield('script')
    </body>
</html>
