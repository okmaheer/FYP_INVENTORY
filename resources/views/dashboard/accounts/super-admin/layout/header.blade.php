<div class="topbar">
    <nav class="navbar-custom">
        <div class="topbar-left">
            <a href="javascript:void(0);" class="logo">
               <span>
                   <img src="{{ asset(\App\Models\Business::first()->logo ) }}" alt="Deskbook ERP" style="height:75px; width:175px;">
               </span>
            </a>
        </div>

        <ul class="list-unstyled topbar-nav float-right mb-0">
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    @if(file_exists(auth()->user()->avatar))
                        <img src="{{ asset(auth()->user()->avatar) }}" alt="profile-user" class="rounded-circle border" />
                    @else
                        <img src="{{ asset('images/user.png') }}" alt="profile-user" class="rounded-circle border" />
                    @endif
                    <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('logout') }}" id="logoutForm">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="LogoutConfirm();"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                </div>
            </li>
            <li class="menu-item">
                <a class="navbar-toggle nav-link" id="mobileToggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>
        </ul>
        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button onclick="ToggleNavBar()" class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="mdi mdi-menu nav-icon"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>
