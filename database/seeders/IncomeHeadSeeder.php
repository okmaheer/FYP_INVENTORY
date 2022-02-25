<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('income_heads')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('income_heads')->insert([

            [
                'id'  => 1,
                'income_head_name' => 'Software',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 2,
                'income_head_name' => 'Bike Repair Maintenance',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 3,
                'income_head_name' => 'Car Repair Maintenance',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 4,
                'income_head_name' => 'Dish Washer Area Income',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

   

 
          
        ]);
    }
}
