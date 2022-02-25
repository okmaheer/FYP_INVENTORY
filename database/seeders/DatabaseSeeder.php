<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CompanySeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(BusinessLocationSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(AccountHeadsSeeder::class);
//        $this->call(CustomerSeeder::class);
//        $this->call(SupplierSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
//        $this->call(SupplierProductSeeder::class);
        $this->call(AddOnFeatureSeeder::class, false, ['location' => 1]);
        $this->call(AddOnFeatureSeeder::class, false, ['location' => 2]);
        $this->call(StageSeeder::class, false, ['location' => 1]);
        $this->call(StageSeeder::class, false, ['location' => 2]);
        $this->call(SeatingPlanSeeder::class);
        $this->call(SettingSeeder::class, false, ['location' => 1]);
        $this->call(SettingSeeder::class, false, ['location' => 2]);
        $this->call(RecipeSeeder::class);
        $this->call(RecipeDetailsSeeder::class);
        // $this->call(ExpenseHeadSeeder::class);
        $this->call(DesignationSeeder::class);
//        $this->call(EmployeeSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuProductSeeder::class);
//    $this->call(IncomeHeadSeeder::class);
//    $this->call(ExpenseHeadSeeder::class);
        $this->call(PrefixSettingSeeder::class, false, ['location' => 1]);
        $this->call(PrefixSettingSeeder::class,false, ['location' => 2]);
        $this->call(HardwareSettingSeeder::class,false, ['location' => 1]);
        $this->call(HardwareSettingSeeder::class,false, ['location' => 2]);
        $this->call(EventAreaSeeder::class, false, ['location' => 1]);
        $this->call(EventAreaSeeder::class, false, ['location' => 2]);
        $this->call(TermsConditionsSeeder::class, false, ['location' => 1]);
        $this->call(TermsConditionsSeeder::class, false, ['location' => 2]);
        $this->call(ExtraFoodItemSeeder::class, false, ['location' => 1]);
        $this->call(ExtraFoodItemSeeder::class, false, ['location' => 2]);
    }
}
