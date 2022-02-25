<!-- Products -->
<li>
    <a href="javascript: void(0);"> <i class=" fa fa-cubes"></i><span>Product</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li>
            <a href="{{route('dashboard.accounts.category.create')}}" class="parent-a"><i class="fas fa-plus-circle"></i><span>Add Category</span></a>
        </li>
        <li>
            <a href="{{route('dashboard.accounts.category.index')}}" class="parent-a"><i class="fas fa-th-large"></i><span>Category List</span></a>
        </li>
        <li>
            <a href="{{route('dashboard.accounts.unit.create')}}" class="parent-a"><i class="fas fa-plus-circle"></i><span>Add Unit</span></a>
        </li>
        <li>
            <a href="{{route('dashboard.accounts.unit.index')}}" class="parent-a"><i class="fas fa-list-alt"></i><span>Unit List</span></a>
        </li>
        @can('view',\App\Models\Product::class)
            <li>
                <a href="{{route('dashboard.accounts.products.index')}}" class="parent-a">
                    <i class="fas fa-edit"></i><span>{{ trans('accounts.products.manage_product') }}</span>
                </a>
            </li>
        @endcan
        @can('create',\App\Models\Product::class)
            <li>
                <a href="{{route('dashboard.accounts.products.create')}}" class="parent-a">
                    <i class="fas fa-plus-circle"></i><span>{{ trans('accounts.products.add_product') }}</span>
                </a>
            </li>
        @endcan
        <li>
            <a href="/add_product_csv" class="parent-a"><i class="fas fa-file-excel"></i><span>{{ trans('accounts.products.add_product_csv') }}</span></a>
        </li>
    </ul>
</li>
