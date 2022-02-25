<!-- Tentative Booking -->
<li>
    <a href="javascript: void(0);"> <i class="ti-layout-grid2"></i><span>Tentative Booking</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li>
            <a href="{{route('dashboard.marquee.tentative-booking.create')}}" class="parent-a"><i class="fas fa-plus-circle"></i><span>Create Booking</span></a>
        </li>
        <li>
            <a href="{{route('dashboard.marquee.tentative-booking.index')}}" class="parent-a"><i class="fas fa-th-large"></i><span>Manage Bookings</span></a>
        </li>
    </ul>
</li>
<!-- Quotations -->
<li>
    <a href="javascript: void(0);"> <i class="ti-layout-grid2"></i><span>Quotations</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level collapse" aria-expanded="false">
        <li>
            <a href="javascript:void(0);" class="parent-a"><i class="ti-book"></i><span>Booking Quotations</span>
                <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span>
            </a>
            <ul class="nav-second-level collapse" aria-expanded="false">
                <li>
                    <a href="{{route('dashboard.marquee.quotation.booking.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Quotation</span></a>
                </li>
                <li>
                    <a href="{{route('dashboard.marquee.quotation.booking.index')}}" class="child-a"><i class="far fa-edit"></i><span>Manage Quotations</span></a>
                </li>
                <li>
                    <a href="{{route('bookingquotation.report')}}" class="child-a"><i class="fas fa-chart-bar"></i><span>Booking Quotations Reports</span></a>

                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="parent-a"><i class="ti-book"></i><span>Stage Quotations </span><span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul>
                <li>
                    <a href="{{route('dashboard.marquee.quotation.stage.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Quotation</span></a>
                </li>
                <li>
                    <a href="{{route('dashboard.marquee.quotation.stage.index')}}" class="child-a"><i class="far fa-edit"></i><span>Manage Quotations</span></a>
                </li>

                <li>
                    <a href="{{route('stagequotation.report')}}" class="child-a"><i class="fas fa-chart-bar"></i><span>Stage Quotations Reports</span></a>
                </li>
            </ul>
        </li>

    </ul>
</li>
<!-- All Bookings -->
<li>
    <a href="javascript: void(0);"> <i class="ti-book"></i><span>All Booking</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level collapse" aria-expanded="false">
        <li>
            <a href="javascript:void(0);" class="parent-a"><i class="fas fa-calendar-alt"></i><span>Event Bookings</span>
                <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span>
            </a>
            <ul class="nav-second-level collapse" aria-expanded="false">
                <li>
                    <a href="{{route('dashboard.marquee.booking.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Booking</span></a>
                </li>
                <li>
                    <a href="{{route('dashboard.marquee.booking.index')}}" class="child-a"><i class="far fa-edit"></i><span>Manage Bookings</span></a>
                </li>
                <li>
                    <a href="{{route('booking.report')}}" class="child-a"><i class="fas fa-chart-bar"></i><span>Booking Details</span></a>

                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="parent-a"> <i class="ti-book"></i><span>Stage &amp; Decor</span><span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul>
                <li>
                    <a href="{{route('dashboard.marquee.stage.booking.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Booking</span></a>
                </li>
                <li>
                    <a href="{{route('dashboard.marquee.stage.booking.index')}}" class="child-a"><i class="far fa-edit"></i><span>Manage Bookings</span></a>
                </li>

                <li>
                    <a href="{{route('stage.report')}}" class="child-a"><i class="fas fa-chart-bar"></i><span>Stage Details</span></a>
                </li>
            </ul>
        </li>

    </ul>
</li>
<!-- Addon Invoices -->
<li>
    <a href="javascript: void(0);"><i class="fas fa-file-invoice"></i><span>Addon Invoices</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li> <a href="{{route('dashboard.marquee.add-on-invoice.index')}}" class="parent-a"><i class="ti-book"></i><span>All Bookings</span></a></li>
    </ul>
</li>
