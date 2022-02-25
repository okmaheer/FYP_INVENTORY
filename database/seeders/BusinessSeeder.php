<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('businesses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('businesses')->insert([
            [
                'owner_name' => 'Ahsan Raza',
                'name' => 'OptimumTech',
                'phone_1' => '0415216467',
                'phone_2' => null,
                'mobile_1' => '03136650965',
                'mobile_2' => null,
                'address_1' => '25-A, Batala Colony',
                'address_2' => 'Near Hardees, Faisalabad',
                'logo' => 'uploads/business/logo.png',
                'email' => 'info@theoptimumtech.com',
                'website' => 'www.theoptimumtech.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
