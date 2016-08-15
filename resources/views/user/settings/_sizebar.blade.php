<ul id="sizebar" class="dropdown-menu">
    <li class="@if($routeName === 'front::payment.history') current @endif">
        <a href="{{ route('front::payment.history') }}">{!! trans('setting.menu_trans') !!} <i class="fa fa-history fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>
    <li class="@if(($routeName === 'front::ecommerce.order') || ($routeName === 'front::ecommerce.order.show')) current @endif">
        <a href="{{ route('front::ecommerce.order') }}">
            {!! trans('setting.menu_order_product') !!} <i class="fa fa-lg fa-cart-plus pull-right"></i>
        </a>
    </li>
    <li class="divider"></li>
    <li class="@if(($routeName === 'front::orders.index')||($routeName === 'front::orders.show')) current @endif">
        <a href="{{ route('front::orders.index') }}">
            {!! trans('setting.menu_order') !!} <i class="fa fa-lg fa-shopping-cart pull-right"></i>
        </a>
    </li>
    <li class="divider"></li>
    <li class="@if($routeName === 'front::settings.winning') current @endif">
        <a href="{{ route('front::settings.winning') }}">{!! trans('setting.menu_winning') !!} <i class="fa fa-trophy fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>
    <li class="@if($routeName === 'front::settings.notifications') current @endif">
        <a href="{{ route('front::settings.notifications') }}">{!! trans('setting.menu_notic') !!} <span class="badge pull-right"> {{ $auth->notification_not_read }} </span></a>
    </li>
    <li class="divider"></li>

    <li class="hidden @if($routeName === 'front::settings.payment') current @endif">
        <a href="{{ route('front::settings.payment') }}">Payments <span class="hidden-md">/Credit Card</span> <i class="fa fa-cc-visa fa-lg pull-right"></i></a>
    </li>
    <li class="hidden divider"></li>
    <li class="@if($routeName === 'front::settings.notifications') current @endif">
        <a href="{{ route('front::settings.notifications') }}">Affiliate <i class="fa fa-link fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>
    <li class="@if($routeName === 'front::settings.account') current @endif">
        <a href="{{ route('front::settings.account') }}">{!! trans('setting.menu_account_setting') !!} <i class="fa fa-cog fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>
    <li><a href="/logout">{!! trans('setting.menu_sign_out') !!} <i class="fa fa-sign-out fa-lg pull-right"></i></a></li>
</ul>
