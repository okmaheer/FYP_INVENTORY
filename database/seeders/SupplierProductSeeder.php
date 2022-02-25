<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('supplier_products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        /*DB::table('supplier_products')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'supplier_id' => 1,
                'supplier_price' => 120,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'product_id' => 1,
                'supplier_id' => 2,
                'supplier_price' => 150,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'product_id' => 2,
                'supplier_id' => 1,
                'supplier_price' => 120,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'product_id' => 3,
                'supplier_id' => 2,
                'supplier_price' => 150,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


        ]);*/
    }
}
