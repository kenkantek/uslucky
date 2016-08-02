<footer id="footer">
    <div class="container">
        <div class="header hidden">

            <h2>Also on UsLucky</h2>
        </div>
    </div>

    <div class="links">
        <a href="#" class="link">
            <header>{{ trans('footer.box_1') }}</header>
            <p>
                <img src="{{asset('images/security.jpg')}}" style="max-width: 100%" alt="">
            </p>
        </a>
        <a href="#" class="link">
            <header>{{ trans('footer.box_2') }}</header>
            <p>
                <img src="{{asset('images/payment.jpg')}}" style="max-width: 100%" alt="">
            </p>
        </a>
        <a href="#" class="link">
            <header>{{ trans('footer.box_3') }}</header>
            <p>
                <img src="{{asset('images/contact us.jpg')}}" style="max-width: 100%" alt="">
            </p>
        </a>
    </div>
    <div class="footer">
        <a href="{{ trans('footer.powered_by_link') }}" target="_blank">
            {{ trans('footer.powered_by') }}
        </a>
    </div>
</footer>
