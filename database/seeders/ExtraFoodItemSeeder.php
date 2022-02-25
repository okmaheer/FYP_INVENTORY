<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtraFoodItemSeeder extends Seeder
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
            DB::table('extra_food_items')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('extra_food_items')->insert([
            [
                'name' => 'Mineral Water',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Roasted Lamb',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Prawns',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Mutton Sajji',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Chicken Sajji',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Cold Drink Regular',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Cold Drink 1.5L',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Coffee',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
        ]);
    }
}
