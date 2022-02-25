<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('designations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('designations')->insert([
            ['id' => 1, 'name' => 'Owner'],
            ['id' => 2, 'name' => 'Cheif Accountant'],
            ['id' => 3, 'name' => 'General Manager'],
            ['id' => 4, 'name' => 'Assistant Manager'],
            ['id' => 5, 'name' => 'Accountant'],
            ['id' => 6, 'name' => 'Purchaser'],
            ['id' => 7, 'name' => 'Store Keeper'],
            ['id' => 8, 'name' => 'Painter'],
            ['id' => 9, 'name' => 'Mali'],
            ['id' => 10, 'name' => 'Security Guard'],
            ['id' => 11, 'name' => 'Wapda Concern'],
            ['id' => 12, 'name' => 'Electrition'],
            ['id' => 13, 'name' => 'Head Chef'],
            ['id' => 14, 'name' => 'Assistant Chef'],
            ['id' => 15, 'name' => 'Fry Man'],
            ['id' => 16, 'name' => 'Cold Kithchen'],
            ['id' => 17, 'name' => 'Helper'],
            ['id' => 18, 'name' => 'Supervisor'],
            ['id' => 19, 'name' => 'Head Tandori'],
            ['id' => 20, 'name' => 'Dish Washer'],
            ['id' => 21, 'name' => 'Dhobi'],
            ['id' => 22, 'name' => 'Office Boy'],
        ]);
    }
}
