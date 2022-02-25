<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('roles')->insert([
            [
                'name' => 'super-admin',
                'label' => 'Super Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                 'name' => 'admin',
                 'label' => 'Admin',
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now()
            ],
            [
                'name' => 'booking_manager',
                'label' => 'Booking Manager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'accountant',
                'label' => 'Accountant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
         ]);

    }
}
