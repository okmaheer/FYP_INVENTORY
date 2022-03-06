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
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('settings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('settings')->insert([
            [
                'id' => 1,
                'footer_text' => 'Copyright© 2021 . All rights reserved.',
                'logo' => 'uploads/settings/logo.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]


        ]);
    }
}
