<div class="page-sidebar-wrapper">

                <div class="page-sidebar navbar-collapse collapse">

                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start @if($routeName === 'backend::admin.dashboard') active open @endif">
                            <a href="{{route('backend::admin.dashboard')}}" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        <li class="nav-item  @if(starts_with($routeName, 'backend::admin.contact')) active open @endif">
                            <a href="{{route('backend::admin.contacts')}}" class="nav-link nav-toggle">
                                <i class="icon-envelope"></i>
                                <span class="title">Contacts</span>
                                <span class="selected"></span>
                                <span class="arrow @if($routeName === 'backend::admin.contacts') open @endif"></span>
                            </a>
                        </li>
                        <li class="nav-item  @if(starts_with($routeName, 'backend::admin.users')) active open @endif">
                            <a href="{{route('backend::admin.users')}}" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Users</span>
                                <span class="selected"></span>
                                <span class="arrow @if($routeName === 'backend::admin.users') open @endif"></span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
