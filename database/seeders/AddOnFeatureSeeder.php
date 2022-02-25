<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddOnFeatureSeeder extends Seeder
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
            DB::table('add_on_features')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('add_on_features')->insert([
            [
                'name' => 'Flower Spray Machine',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Smoke Machine',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Electrical Firework',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Cool Fire',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Heater',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'AC',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Fans',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Coolers',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Jugs',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Extra Lights',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],

        ]);
    }
}
