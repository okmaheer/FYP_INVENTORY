<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HardwareSettingSeeder extends Seeder
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
            DB::table('hardware_setting')->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('hardware_setting')->insert([
            'attendance_ip' => 'x.x.x.x',
            'attendance_port' => 'xxxx',
            'printer_ip' => "x.x.x.x",
            'printer_port' => 'xxxx',
            'printer_type' => 'windows',
            'printer_path' => '',
            'printer_char_per_line' => 42,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'location_id' => $location,
        ]);
    }
}
