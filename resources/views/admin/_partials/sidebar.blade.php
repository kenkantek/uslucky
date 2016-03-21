<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start @if($routeName === 'admin.dashboard') active open @endif">
                <a href="{{route('admin.dashboard')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.users.index'))  @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Game result</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="" class="nav-link ">
                            <span class="title">Daily result input</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="javascript:;" class="nav-link ">
                            <span class="title">Award matching module</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.users.index'))  @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-list"></i>
                    <span class="title">Manage Tickets</span>
                    <span class="selected"></span>
                    <span class="arrow @if($routeName === 'admin.users.index') open @endif"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{route('admin.users.index')}}" class="nav-link ">
                            <span class="title">Tickets Today</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="javascript:;" class="nav-link ">
                            <span class="title">All Tickets</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>


            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.users.index')) active open @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Manage Users</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{route('admin.users.index')}}" class="nav-link ">
                            <span class="title">All Users</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="javascript:;" class="nav-link ">
                            <span class="title">Winner User</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.users.index'))  @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-game-controller"></i>
                    <span class="title">Manage Games</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{route('admin.users.index')}}" class="nav-link ">
                            <span class="title">Powerball</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="javascript:;" class="nav-link ">
                            <span class="title">Mega Million</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if(starts_with($routeName, 'admin.contact.index')) active open @endif">
                <a href="{{route('admin.contact.index')}}" class="nav-link nav-toggle">
                    <i class="icon-envelope"></i>
                    <span class="title">Contacts</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item start @if($routeName === 'admin.dashboard')  @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Settings</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>

            <li class="nav-item start">
                <a href="/logout" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
