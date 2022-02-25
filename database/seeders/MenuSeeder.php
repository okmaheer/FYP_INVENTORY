<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($location = 1)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if ($location < 2) {
            DB::table('menu')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('menu')->insert([
            ['menu_type' => '1','menu_no' => '001','menu_name' => 'Chicken Menu', 'location_id' => $location],
            ['menu_type' => '1','menu_no' => '002','menu_name' => 'Mutton Menu', 'location_id' => $location],
            ['menu_type' => '1','menu_no' => '003','menu_name' => 'Beef Menu', 'location_id' => $location]
        ]);
    }
}
