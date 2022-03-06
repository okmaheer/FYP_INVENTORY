<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
          
            [
            'location_name' => 'Tegucigalpa',
            'logo' => 'website/imgs/building1.svg',
            'color' => 'bgdarkyellow'
            ]
          
           
        ]);
    }
}
