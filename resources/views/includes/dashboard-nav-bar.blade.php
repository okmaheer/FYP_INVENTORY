<div id="nav" class="left-sidenav">
    <div id="navigationt">
        <ul class="metismenu left-sidenav-menu" id="side-nav">


        @php $userRole = auth()->user()->roles[0]->name; @endphp
            <!-- All Bookings -->
            @if($userRole == 'booking_manager' || $userRole == 'admin')
                @include('includes.navbar.booking')
            @endif
            <!-- Products -->
            @if($userRole == 'booking_manager' || $userRole == 'admin')
                @include('includes.navbar.products')
                @include('includes.navbar.food')
            @endif

            <!-- Accounts -->
            @if($userRole == 'accountant' || $userRole == 'admin')
                @include('includes.navbar.accounts')
            @endif
            <!-- Settings -->
            @if($userRole == 'booking_manager' || $userRole == 'admin')
                @include('includes.navbar.settings')
            @endif
              <!-- HR -->
            @if($userRole == 'accountant' ||$userRole == 'admin')
                @include('includes.navbar.hrm')
            @endif
            @if($userRole == 'admin')
                @include('includes.navbar.access')
            @endif
        </ul>
        <!-- End navigation menu -->
    </div>
    <!-- end navigation -->
    </div>
    <!-- end container-fluid -->
