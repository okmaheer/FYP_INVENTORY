<div class="topbar">
    <nav class="navbar-custom">

       <ul class="list-unstyled topbar-nav float-right mb-0">

           <li class="dropdown">
               <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                   <img src="{{ url('dashboard/images/users/user-1.jpg') }}" alt="profile-user" class="rounded-circle" />
                   <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
               </a>
               <div class="dropdown-menu dropdown-menu-right">
             
                  
                   <form method="post" action="{{ route('logout') }}">
                       {{ csrf_field() }}
                       <button type="submit" class="dropdown-item">
                           <i class="dripicons-exit text-muted mr-2"></i>Logout</button>
                   </form>
               </div>
           </li>
           <li class="menu-item">
               <!-- Mobile menu toggle-->
               <a class="navbar-toggle nav-link" id="mobileToggle">
                   <div class="lines">
                       <span></span>
                       <span></span>
                       <span></span>
                   </div>
               </a>
               <!-- End mobile menu toggle-->
           </li>
       </ul>

       <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button onclick="ToggleNavBar()" class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="mdi mdi-menu nav-icon"></i>
                </button>
            </li>
        </ul>

        <div class="topbar-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{ url('images/project.png') }}" alt="" class="thumb mx-auto d-block" height="70px">
            </a>
        </div>

   </nav>
   <!-- end navbar-->
</div>
