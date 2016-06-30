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
                Connect with the most active startups this week.
            </p>
        </a>
        <a href="#" class="link">
            <header>{{ trans('footer.box_2') }}</header>
            <p>
                Join the 855 startups that have raised online.
            </p>
        </a>
        <a href="#" class="link">
            <header>{{ trans('footer.box_3') }}</header>
            <p>
                High-quality talent. Fun. Free.
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
        <a href="http://kan-tek.com" target="_blank">
            {{ trans('footer.powered_by') }}
        </a>
    </div>
</footer>
