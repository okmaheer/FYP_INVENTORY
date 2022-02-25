<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventAreaSeeder extends Seeder
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
            DB::table('event_areas')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('event_areas')->insert([
            [
                'name' => 'Hall 1',
                'bgColor' => '#fbd0f6',
                'location_id' => $location,
            ],
            [
                'name' => 'Hall 2',
                'bgColor' => '#c4e8fd',
                'location_id' => $location,
            ],
            [
                'name' => 'Hall 3',
                'bgColor' => '#caf7d3',
                'location_id' => $location,
            ],
        ]);
    }
}
