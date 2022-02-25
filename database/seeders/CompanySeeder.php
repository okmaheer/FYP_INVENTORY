<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'id' => 1,
            'company_name' => 'Deskbook ERP',
            'email' => 'info@optimumtech.org',
            'address' => "25-A, Batala Colony,<br>Faisalabad",
            'mobile' => '0300-7654321',
            'website' => 'www.optimumtech.org',
            'status' => 1,
            'gstn' => '123456789',
            'phone' => '041-7654321',
            'logo' => 'uploads/companies/deskbook.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
