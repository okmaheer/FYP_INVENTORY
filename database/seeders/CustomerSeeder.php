<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('customers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        /*DB::table('customers')->insert([

                [
                    'id' => 1,
                    'customer_name' => 'Walking Customer',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],

        ]);*/

    }
}
