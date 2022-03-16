<style>

    .acc_report:hover .acc_report_sub {
        visibility: visible !important;
        opacity: 1 !important;
    }

    .human_acc:hover .human_sub_acc {
        visibility: visible !important;
        opacity: 1 !important;
    }
</style>

<div id="nav" class="left-sidenav">
    <div id="navigationttt">
        <ul class="metismenu left-sidenav-menu" id="side-nav">
            <li class="menu-title">Main</li>
            <li>
                <a href="javascript: void(0);"> <i class="fa fa-user-secret"></i><span>Access</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                   
                        <li>
                            <a href="{{route('dashboard.accounts.users.index')}}">Users</a>
                        </li>
             
                    {{-- @can('view',\App\Models\Role::class)
                        <li>
                            <a href="{{route('dashboard.accounts.roles.index')}}">Roles</a>
                        </li>
                    @endcan
                    @can('view',\App\Models\Permission::class)
                        <li>
                            <a href="{{route('dashboard.accounts.permissions.index')}}">Permissions</a>
                        </li>
                    @endcan
                    @can('sync',\App\Models\Permission::class)
                        <li>
                            <a href="{{route('dashboard.accounts.permissions.sync')}}">Sync Permissions</a>
                        </li>
                    @endcan --}}
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);"> <i class=" fa fa-cubes"></i><span>Unit</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    
                    <li>
                        <a href="{{route('dashboard.accounts.unit.create')}}" class="parent-a" ><i class="fas fa-plus-circle"></i><span>Add Unit</span></a>
                    </li>
                    <li>
                        <a href="{{route('dashboard.accounts.unit.index')}}"class="parent-a" ><i class="fas fa-list-ul"></i><span>Unit List</span></a>
                    </li>
    
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);"> <i class="fa fa-list-alt" aria-hidden="true"></i><span>Category</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('dashboard.accounts.category.create')}}" class="parent-a" ><i class="fas fa-plus-circle"></i><span>Add Category</span></a>
                    </li>
                    <li>
                        <a href="{{route('dashboard.accounts.category.index')}}" class="parent-a"><i class="fas fa-list-ul"></i><span>Category List</span></a>
                    </li>
                   
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);"><i class="fab fa-product-hunt"></i><span>Product</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                   
                        <li>
                            <a href="{{route('dashboard.accounts.products.create')}}" class="parent-a" ><i class="fas fa-plus-circle"></i><span>
                            {{ trans('accounts.products.add_product') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dashboard.accounts.products.index')}}" class="parent-a" ><i class="fas fa-edit"></i><span>
                                {{ trans('accounts.products.manage_product') }}</span>
                            </a>
                        </li>
                 

                    {{--                    <li>--}}
                    {{--                        <a href="/add_product_csv">{{ trans('accounts.products.add_product_csv') }}</a>--}}
                    {{--                    </li>--}}
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);"> <i class="fa fa-users"></i></i><span>Supplier</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
            
                    <li><a href="{{route('dashboard.accounts.supplier.create')}}" class="parent-a" ><i class="fas fa-plus-circle"></i><span>Add Supplier</span></a></li>
            
            
                    <li><a href="{{route('dashboard.accounts.supplier.index')}}" class="parent-a" ><i class="fas fa-list-ul"></i><span>Supplier List</span></a></li>
        
            
                </ul>
            </li>


            <li>
                <a href="javascript: void(0);"> <i class="fa fa-shopping-cart"></i><span>Purchase</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
            
                    <li><a href="{{route('dashboard.accounts.purchase.create')}}" class="parent-a" ><i class="fas fa-plus-circle"></i><span>Add Purchase</span></a></li>
            
            
                    <li><a href="{{route('dashboard.accounts.purchase.index')}}" class="parent-a" ><i class="fas fa-list-ul"></i><span>Purhcase List</span></a></li>
        
            
                </ul>
            </li>


            <li>
                <a href="javascript: void(0);"> <i class="fa fa-book-open"></i><span>Report</span><span
                        class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
            
                    <li><a href="{{route('purchase.report')}}" class="parent-a" >Purchase Report</a></li>
        
                    <li><a href="{{route('purchase_report.category_wise')}}" class="parent-a" >Purchase Report (Category wise)</a></li>
                </ul>
            </li>
            
            
          




        </ul>
        <!-- End navigation menu -->
    </div> <!-- end navigation -->
</div> <!-- end container-fluid -->
