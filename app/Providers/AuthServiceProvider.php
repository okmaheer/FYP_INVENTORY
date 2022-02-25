<?php

namespace App\Providers;

use App\Models\Accounts;
use App\Models\Attendance;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeLoan;
use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\Income;
use App\Models\IncomeHead;
use App\Models\Invoice;
use App\Models\Permission;
use App\Models\PettyCash;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Role;
use App\Models\Salary;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\Tax;
use App\Models\Unit;
use App\Models\User;
use App\Policies\AccountsPolicy;
use App\Policies\AttendancePolicy;
use App\Policies\BankPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\DesignationPolicy;
use App\Policies\EmployeeLoanPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\ExpenseHeadPolicy;
use App\Policies\ExpensePolicy;
use App\Policies\IncomeHeadPolicy;
use App\Policies\IncomePolicy;
use App\Policies\InvoicePolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PettyCashPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PurchasePolicy;
use App\Policies\RolePolicy;
use App\Policies\SalaryPolicy;
use App\Policies\SettingPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\TaxPolicy;
use App\Policies\UnitPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Customer::class => CustomerPolicy::class,
        Supplier::class => SupplierPolicy::class,
        Category::class => CategoryPolicy::class,
        Unit::class => UnitPolicy::class,
        Purchase::class => PurchasePolicy::class,
        Invoice::class => InvoicePolicy::class,
        IncomeHead::class => IncomeHeadPolicy::class,
        Income::class => IncomePolicy::class,
        PettyCash::class => PettyCashPolicy::class,
        ExpenseHead::class => ExpenseHeadPolicy::class,
        Expense::class => ExpensePolicy::class,
        Bank::class => BankPolicy::class,
        Tax::class => TaxPolicy::class,
        Designation::class => DesignationPolicy::class,
        Employee::class => EmployeePolicy::class,
        Attendance::class => AttendancePolicy::class,
        Salary::class => SalaryPolicy::class,
        EmployeeLoan::class => EmployeeLoanPolicy::class,
        Setting::class => SettingPolicy::class,
        Accounts::class => AccountsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
