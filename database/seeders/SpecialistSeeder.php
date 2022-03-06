<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialists')->insert([
          
            [
            'specialist_name' => 'Dentistas',
            'logo' => 'website/imgs/teeth.svg',
            'color' => 'bgdarkyellow'
            ],
            [
            'specialist_name' => 'Dermatólogos',
            'logo' => 'website/imgs/factory.svg',
            'color' => 'bgdarkpurple'
            ],
            [
            'specialist_name' => 'Nutricionistas',
            'logo' => 'website/imgs/pill.svg',
            'color' => 'bgdarkgreen'
            ],
            [
                'specialist_name' => 'Ortopedistas',
               'logo' => 'website/imgs/scissors.svg',
               'color' => 'bgdarkred'
            ],
            [
             'specialist_name' => 'Cardiólogos',
             'logo' => 'website/imgs/cardiograph.svg',
             'color' => 'bgdarkblue'
             ]
            
        ]);
    }
}
