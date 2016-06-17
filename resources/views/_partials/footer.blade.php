<footer id="footer">
    <div class="container">
        <div class="header hidden">

            <h2>Also on UsLucky</h2>
        </div>
    </div>

    <div class="links">
        <a href="#" class="link">
            <header>See Who's Trending</header>
            <p>
                Connect with the most active startups this week.
            </p>
        </a>
        <a href="#" class="link">
            <header>Raise Money Online</header>
            <p>
                Join the 855 startups that have raised online.
            </p>
        </a>
        <a href="#" class="link">
            <header>Recruit Your Team</header>
            <p>
                High-quality talent. Fun. Free.
            </p>
        </a>
    </div>
    <div class="footer">
        <a href="{{ route('front::home') }}">
            {{ trans('menu.home') }}
        </a>
        <a href="#">Payment</a>
        <a href="#">About</a>
        <a href="{{ route('front::contact') }}">
            {{ trans('footer.contact_us') }}
        </a>
        <a href="#">FAQs</a>
        <a href="#">Terms</a>
        <a href="http://kan-tek.com" target="_blank">Powered by KanTek</a>
    </div>
</footer>
