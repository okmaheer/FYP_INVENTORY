<div id="nav" class="left-sidenav">
    <div id="navigation-menu">
        <ul class="metismenu left-sidenav-menu" id="side-nav">
            @if(session()->has(\App\Enum\SessionEnum::SESSION_LOCATION_ID))
                <li><a href="{{route('expense.statement')}}" class="child-a" ><i class="fas fa-book"></i><span>Expense Statement</span></a></li>
            @else
                <li><a href="{{ route('super-admin.dashboard') }}"><i class="mdi mdi-monitor"></i> Dashboard</a></li>
            @endif
        </ul>
    </div>
</div>
