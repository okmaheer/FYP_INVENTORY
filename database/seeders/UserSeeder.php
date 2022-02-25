<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'super@theoptimumtech.com',
                'password' => Hash::make('Super@78601'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Optimum Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Devsbeta Admin',
                'email' => 'admin_beta@gmail.com',
                'password' => Hash::make('123456'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 2,
            ],
            [
                'name' => 'Booking Manager',
                'email' => 'booking@gmail.com',
                'password' => Hash::make('123456'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Accountant',
                'email' => 'accounts@gmail.com',
                'password' => Hash::make('123456'),
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
        ]);
    }
}
