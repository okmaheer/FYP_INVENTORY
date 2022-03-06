<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('units')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('units')->insert([
            [
                'id' => 1,
                'unit_name' => 'Each',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


        ]);
    }
}
