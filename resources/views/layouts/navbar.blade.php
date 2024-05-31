<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
{{--            <a class="nav-link nav-icon-hover" href="javascript:void(0)">--}}
{{--                    <i class="ti ti-bell-ringing"></i>--}}
{{--                    <div class="notification bg-primary rounded-circle"></div>--}}
{{--            </a>--}}

                {{-- @if(Auth::user()->role_user->role_id==2)
                     <h4>User Type: {{Auth::user()->userType->name}} user</h4>

                @endif --}}
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              
                    @if(auth()->check())
                        <div class="user-block">     
                            <h4> {{ Auth::user()->name}}  </h4>
                            <span>{{ Auth::user()->role_user->role->title }} </span>
                        </div>
                    @else
                        @if(Session::has('id'))
                            <div class="user-block">
                                <h4> {{ Session::get('user_id') }} </h4>
                                <span>{{ Session::get('user_type') }} </span>
                            </div>
                        @endif
                    @endif 
                
                <br/>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                       aria-expanded="false">
                            <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            {{-- <a href="{{route('get_myprofile',Crypt::encrypt(Auth::user()->id))}}" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a> --}}
                            @if( Auth::check() )
                                <a href="{{route('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>