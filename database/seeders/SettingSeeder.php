<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
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
            DB::table('settings')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('settings')->insert([
            [
                'footer_text' => 'Copyright© 2022 . All rights reserved.',
                'logo' => 'uploads/settings/logo.png',
                'date_format' => 'd-m-Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => $location,
            ]


        ]);
    }
}
