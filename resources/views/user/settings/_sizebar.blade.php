<ul id="sizebar" class="dropdown-menu">
    <li class="@if($routeName === 'front::settings.account') current @endif">
        <a href="{{ route('front::settings.account') }}">Account Settings <i class="fa fa-cog fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>

    <li class="@if($routeName === 'front::settings.winning') current @endif">
        <a href="{{ route('front::settings.winning') }}">Winnings <i class="fa fa-trophy fa-lg pull-right"></i></a></li>
    <li class="divider"></li>


    <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
    <li class="divider"></li>

    <li class="@if($routeName === 'front::settings.payment') current @endif">
        <a href="{{ route('front::settings.payment') }}">Payments <span class="hidden-md">/Credit Card</span> <i class="fa fa-cc-visa fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>

    <li class="@if($routeName === 'front::payment.history') current @endif">
        <a href="{{ route('front::payment.history') }}">Transaction <span class="hidden-md">History</span> <i class="fa fa-history fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>

    <li><a href="/logout">Sign Out <i class="fa fa-sign-out fa-lg pull-right"></i></a></li>
</ul>
