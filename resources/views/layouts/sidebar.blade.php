<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href=" @if(Auth::check()) {{ route('dashboard')}} @else {{ route('issue.index') }} @endif" class="text-nowrap logo-img my-2">
{{--                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />--}}
                <h3> JJM Assam <br/> HelpDesk</h3>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">


                @if(Auth::check())
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @endif

                


                

                @if(!Auth::check())

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Issue</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('issue_create') }}" aria-expanded="false">
                        <span>
                        <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Create Issue</span>
                    </a>
                </li> 
                @endif
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('issue.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                        <span class="hide-menu">List Issue</span>
                    </a>
                </li>

                @can('user_crete')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.create') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                        <span class="hide-menu">Create User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('logout')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                        <span class="hide-menu">User List</span>
                    </a>
                </li>
                @endcan
                
                @if(Auth::check())
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('logout')}}" aria-expanded="false">
                    <span>
                    <i class="ti ti-user-plus"></i>
                    </span>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>