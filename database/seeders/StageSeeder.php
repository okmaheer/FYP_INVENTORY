<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run($location = 1)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if ($location < 2) {
            DB::table('stage_decorations')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('stage_decorations')->insert([
            [
                'name' => 'Artificial Flowers',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Natural Flowers ',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],

            [
                'name' => 'Dancing Lights',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Dancing Floor',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Selfi Booth ',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Walk Way wood floor',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Electric Anar',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ]
            ,
            [
                'name' => 'Sound  System',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Entery Chargings',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Still Photography',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Drone Camera',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Picture Albums',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Truss Hanging',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'walkway mirror floor',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'stage decoration',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Mehndi stage',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Couple Entry',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Baggi motor',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
            [
                'name' => 'Truss Walkway',
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ],
        ]);
    }
}
