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

            </p>
        </a>
        <a href="#" class="link">
            <header>{{ trans('footer.box_2') }}</header>
            <p>

            </p>
        </a>
        <a href="#" class="link">
            <header>{{ trans('footer.box_3') }}</header>
            <p>

            </p>
        </a>
    </div>
    <div class="footer">
        <a href="{{ route('front::home') }}">
            {{ trans('menu.home') }}
        </a>
        <a href="#">
            {{ trans('footer.payment') }}
        </a>
        <a href="#">
            {{ trans('footer.about') }}
        </a>
        <a href="{{ route('front::contact') }}">
            {{ trans('footer.contact_us') }}
        </a>
        <a href="#">
            {{ trans('footer.faq') }}
        </a>
        <a href="#">
            {{ trans('footer.term') }}
        </a>
        <a href="{{ trans('footer.powered_by_link') }}" target="_blank">
            {{ trans('footer.powered_by') }}
        </a>
    </div>
</footer>
