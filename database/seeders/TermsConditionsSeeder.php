<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsConditionsSeeder extends Seeder
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
            DB::table('terms_conditions')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('terms_conditions')->insert([
            [
                'is_urdu' => 0,
                'event_terms' => 'Demo Terms for Event Booking',
                'stage_terms' => 'Demo Terms for Stage Booking',
                'location_id' => $location,
            ],
        ]);
    }
}
