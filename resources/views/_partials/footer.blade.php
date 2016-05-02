<footer class="footer">
    <div class="bg4 link-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('front::trust') }}">
                        {{ trans('footer.trust') }}
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('front::payment') }}">
                        {{ trans('footer.payment') }}
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('front::contact') }}">
                        {{ trans('footer.contact_us') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <a class="logo" href="{{ route('front::home') }}">
            {!! HTML::image('css/images/logo.png', env('TITLE'), ['class' => 'img-responsive']) !!}
        </a>
    </div>
</footer>
