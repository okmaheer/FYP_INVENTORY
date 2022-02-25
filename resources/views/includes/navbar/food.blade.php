<!-- Food Management -->
<li>
    <a href="javascript:void(0);"> <i class="fas fa-utensils"></i><span>Food Management</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level collapse" aria-expanded="false">
        <!-- Recipes -->
        <li>
            <a href="javascript:void(0);" class="parent-a"> <i class="fas fa-utensil-spoon"></i><span>Recipe</span><span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level collapse" aria-expanded="false">
                <li>
                    <a href="{{route('dashboard.marquee.recipe.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Recipe</span></a>
                </li>
                <li>
                    <a href="{{route('dashboard.marquee.recipe.index')}}" class="child-a"><i class="fas fa-edit"></i><span>Manage Recipe</span></a>
                </li>
            </ul>
        </li>
        <!-- Menus -->
        <li>
            <a href="javascript:void(0);" class="parent-a"> <i class="fas fa-utensil-spoon"></i><span>Menus</span><span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level collapse" aria-expanded="false">
                <li>
                    <a href="{{route('dashboard.marquee.menu.index')}}" class="child-a"><i class="fas fa-bars"></i><span>All Menus</span></a>
                </li>
                <li>
                    <a href="{{route('dashboard.marquee.menu.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>New Menu</span></a>
                </li>
            </ul>
        </li>
        <!-- Extra Food Items -->
        <li>
            <a href="javascript:void(0);" class="parent-a"> <i class="fas fa-utensil-spoon"></i><span>Extra Food Items</span><span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level collapse" aria-expanded="false">
                <li>
                    <a href="{{route('dashboard.marquee.extra_food_items.index')}}" class="child-a"><i class="fas fa-bars"></i><span>Extra Food Items List</span></a>
                </li>
                <li>
                    <a href="{{route('dashboard.marquee.extra_food_items.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Extra Food item</span></a>
                </li>
            </ul>
        </li>
        <!-- Demand Form -->
        {{--<li>
            <a href="javascript: void(0);" class="parent-a"> <i class="fas fa-shopping-cart"></i><span>Demand Form</span><span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level collapse" aria-expanded="false">
                <li>
                    <a href="javascript:void(0);" class="parent-a"><i class="fas fa-chart-line"></i><span>Food Menu Demand</span>
                        <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span>
                    </a>
                    <ul class="nav-second-level collapse" aria-expanded="false">
                        <li>
                            <a href="{{route('food_demand.create.food_demand.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Demand</span></a>
                        </li>
                        <li>
                            <a href="{{route('food_demand.create.food_demand.index')}}" class="child-a"><i class="far fa-edit"></i><span>Manage Demand</span></a>
                        </li>
                        <li>
                            <a href="{{route('food.report')}}" class="child-a"><i class="fas fa-chart-bar"></i><span>Food Demand Report</span></a>

                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="parent-c"><i class="fas fa-chart-line"></i><span>HR &amp; Additional Resources Demand</span><span
                            class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul>
                        <li>
                            <a href="{{route('dashboard.marquee.hr_demand.create')}}" class="child-a"><i class="fas fa-plus-circle"></i><span>Create Booking</span></a>
                        </li>
                        <li>
                            <a href="{{route('dashboard.marquee.hr_demand.index')}}" class="child-a"><i class="far fa-edit"></i><span>Manage Bookings</span></a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="child-a"><i class="fas fa-chart-bar"></i><span>Stage Details</span></a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>--}}

        {{--<li> <!-- Demand -->
            <a href="javascript: void(0);" class="parent-a"> <i class="fas fa-shopping-cart"></i><span>Demand</span><span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level collapse" aria-expanded="false">
                <li>    <a href="{{route('dashboard.marquee.demand.create')}}" class="parent-a">Demand</a></li>
                <li>    <a href="{{route('dashboard.marquee.demand.index')}}" class="parent-a">Manage Demand</a></li>
            </ul>
        </li>--}}
    </ul>
</li>
