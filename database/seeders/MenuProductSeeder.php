<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menu_products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('menu_products')->insert([
            ['product_id' => 2,'menu_id' => 1],
            ['product_id' => 3,'menu_id' => 1],
            ['product_id' => 169,'menu_id' => 1],
            ['product_id' => 286,'menu_id' => 1],
            ['product_id' => 207,'menu_id' => 1],
            ['product_id' => 291,'menu_id' => 1],
            ['product_id' => 128,'menu_id' => 1],
            ['product_id' => 192,'menu_id' => 1],
            ['product_id' => 5,'menu_id' => 2],
            ['product_id' => 3,'menu_id' => 2],
            ['product_id' => 169,'menu_id' => 2],
            ['product_id' => 286,'menu_id' => 2],
            ['product_id' => 207,'menu_id' => 2],
            ['product_id' => 173,'menu_id' => 2],
            ['product_id' => 128,'menu_id' => 2],
            ['product_id' => 192,'menu_id' => 2],
            ['product_id' => 211,'menu_id' => 3],
            ['product_id' => 3,'menu_id' => 3],
            ['product_id' => 169,'menu_id' => 3],
            ['product_id' => 286,'menu_id' => 3],
            ['product_id' => 207,'menu_id' => 3],
            ['product_id' => 173,'menu_id' => 3],
            ['product_id' => 128,'menu_id' => 3],
            ['product_id' => 192,'menu_id' => 3]
        ]);
    }
}
