<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start @if($routeName === 'admin.dashboard') active open @endif">
                <a href="{{ route('admin.dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.results') || starts_with($routeName, 'get.results')) active open  @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Game result</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start @if(starts_with($routeName, 'admin.results')) active open @endif">
                        <a href="{{ route('admin.results.index') }}" class="nav-link ">
                            <span class="title">Daily result input</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start @if(starts_with($routeName, 'get.results')) active open @endif">
                        <a href="{{ route('get.results.awards') }}" class="nav-link">
                            <span class="title">Award matching module</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.orders.index')) active open  @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-list"></i>
                    <span class="title">Orders / Tickets</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>

                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link nav-toggle">
                            <span class="title">Manage Ticket Orders</span>
                            <span class="selected"></span>
                            <span class="arrow"></span>
                        </a>

                        <ul class="sub-menu">
                            <li class="hidden nav-item start">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link ">
                                    <span class="title">Orders Today</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link ">
                                    <span class="title">All Orders</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden nav-item start">
                        <a href="{{ route('admin.tickets.index') }}" class="nav-link nav-toggle">
                            <span class="title">Manage Tickets</span>
                            <span class="selected"></span>
                            <span class="arrow"></span>
                        </a>

                        <ul class="sub-menu">
                            <li class="nav-item start">
                                <a href="{{ route('admin.tickets.index') }}" class="nav-link ">
                                    <span class="title">Tickets Today</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start">
                                <a href="{{ route('admin.tickets.index') }}" class="nav-link ">
                                    <span class="title">All Tickets</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.users')) active open @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Manage Users</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>

                <ul class="sub-menu">
                    <li class="nav-item start @if($routeName == 'admin.users.index') active open @endif">
                        <a href="{{route('admin.users.index')}}" class="nav-link ">
                            <span class="title">All Users</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start @if($routeName == 'admin.users.winners.index') active open @endif">
                        <a href="{{ route('admin.users.winners.index') }}" class="nav-link">
                            <span class="title">Winner User</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.claim-winning.index')) active open @endif">
                <a href="{{route('admin.claim-winning.index')}}" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Claim Winning</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item @if(starts_with($routeName, 'admin.games.show')) active open @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-game-controller"></i>
                    <span class="title">Manage Games</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @foreach($games as $game)
                    <li class="nav-item start">
                        <a href="javascript:;" class="nav-link ">
                            <span class="title">{{ $game->name }}</span>
                            <span class="selected"></span>
                        </a>

                        <ul class="sub-menu">
                            <li class="nav-item start @if($routeName == 'admin.games.show') active open @endif">
                                <a href="{{ route('admin.games.show', $game->id) }}" class="nav-link ">
                                    <span class="title">General</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start @if($routeName == 'game.assign.discount') active open @endif">
                                <a href="{{ route('game.assign.discount', $game->id) }}" class="nav-link">
                                    <span class="title">Discounts</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>

                    </li>
                    @endforeach

                </ul>
            </li>

            <li class="nav-item start @if(strpos($routeName, 'discount') !== false) active  @endif">
                <a href="{{ route('admin.discount.index') }}" class="nav-link nav-toggle">
                    <i class="icon-puzzle"></i>
                    <span class="title">Manage Discounts</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

            <li class="nav-item start @if(strpos($routeName, 'ecommerce') !== false) active  @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-basket"></i>
                    <span class="title">e-commerce</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>

                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{ route('ecommerce.admin.ecommerce.category.index') }}" class="nav-link ">
                            <span class="title">Manage Categories</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{ route('ecommerce.admin.ecommerce.product.index') }}" class="nav-link ">
                            <span class="title">Manage Products</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{ route('ecommerce.order.index') }}" class="nav-link">
                            <span class="title">Manage Orders</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if(($routeName == 'admin.contact.index') || ($routeName == 'admin.contact.show')) active open @endif">
                <a href="{{ route('admin.contact.index') }}" class="nav-link nav-toggle">
                    <i class="icon-envelope"></i>
                    <span class="title">Contacts/Partner</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>

                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{ route('admin.contact.index') }}" class="nav-link ">
                            <span class="title">Contacts</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{ route('admin.get.partners') }}" class="nav-link ">
                            <span class="title">Partnership</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if(($routeName == 'admin.promotion.index') || ($routeName == 'admin.promotion.show')) active open @endif">
                <a href="{{ route('admin.promotion.index') }}" class="nav-link nav-toggle">
                    <i class="icon-puzzle"></i>
                    <span class="title">Promotion Manage</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.affiliate')) active open @endif">
                <a href="{{ route('admin.affiliate.index') }}" class="nav-link nav-toggle">
                    <i class="icon-link"></i>
                    <span class="title">Affiliate Program</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>

                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{ route('admin.affiliate.index') }}" class="nav-link ">
                            <span class="title">Member list</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{ route('admin.affiliate.approve') }}" class="nav-link ">
                            <span class="title">Not approved yet</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{ route('admin.affiliate.config') }}" class="nav-link">
                            <span class="title">Configure</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
