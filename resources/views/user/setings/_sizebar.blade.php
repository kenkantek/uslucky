<ul id="sizebar" class="dropdown-menu">
    <li class="@if(Request::route()->getName() === 'front::settings.account') current @endif">
        <a href="#">Account Settings <i class="fa fa-cog fa-lg pull-right"></i></a>
    </li>
    <li class="divider"></li>

    <li><a href="#">Winnings <i class="fa fa-trophy fa-lg pull-right"></i></a></li>
    <li class="divider"></li>

    <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
    <li class="divider"></li>

    <li><a href="#">Payments/Credit Card <i class="fa fa-cc-visa fa-lg pull-right"></i></a></li>
    <li class="divider"></li>

    <li><a href="#">Transaction History <i class="fa fa-history fa-lg pull-right"></i></a></li>
    <li class="divider"></li>

    <li><a href="/logout">Sign Out <i class="fa fa-sign-out fa-lg pull-right"></i></a></li>
</ul>
