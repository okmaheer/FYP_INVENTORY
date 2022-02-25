<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeoldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('recipes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('recipes')->insert([
            [
                'id'    => 1,
                'recipe_name' => 'Chicken Fried Rice',
                'recipe_product_id' => 162,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 2,
                'recipe_name' => 'Deeg Chicken manchurian',
                'recipe_product_id' => 163,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 3,
                'recipe_name' => 'Chicken Qorma' ,
                'recipe_product_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 4,
                'recipe_name' => 'Steam Roast',
                'recipe_product_id' => 164,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 5,
                'recipe_name' => 'Dhaka chicken (25kg)',
                'recipe_product_id' => 165,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 6,
                'recipe_name' => 'Fruit trifle 40kg',
                'recipe_product_id' => 166,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 7,
                'recipe_name' => 'Gajar halwa 25kg',
                'recipe_product_id' => 167,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 8,
                'recipe_name' => 'Kashmiri Tea (50person)',
                'recipe_product_id' => 168,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 9,
                'recipe_name' => 'Kheer (30kg)',
                'recipe_product_id' => 169,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 10,
                'recipe_name' => 'Lab e sherein (50kg)',
                'recipe_product_id' => 170,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 11,
                'recipe_name' => 'Mutton qorma bakra',
                'recipe_product_id' => 171,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 12,
                'recipe_name' => 'Mutton qorma path',
                'recipe_product_id' => 172,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 13,
                'recipe_name' => 'Milky roti 310',
                'recipe_product_id' => 173,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 14,
                'recipe_name' => 'Naan 160',
                'recipe_product_id' => 174,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 15,
                'recipe_name' => 'Russian salads(one set)',
                'recipe_product_id' => 175,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 16,
                'recipe_name' => 'Shahi Halwa (25kg)',
                'recipe_product_id' => 176,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 17,
                'recipe_name' => 'Thothi kheer (30kg)',
                'recipe_product_id' => 177,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 18,
                'recipe_name' => 'Cold Drink 1 litter',
                'recipe_product_id' => 189,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 19,
                'recipe_name' => 'Cold Drink 500ml',
                'recipe_product_id' => 190,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 20,
                'recipe_name' => 'Small water',
                'recipe_product_id' => 191,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 21,
                'recipe_name' => 'Large water',
                'recipe_product_id' => 192,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 22,
                'recipe_name' => 'can water',
                'recipe_product_id' => 193,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 23,
                'recipe_name' => 'Tin pack',
                'recipe_product_id' => 194,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 24,
                'recipe_name' => 'juice',
                'recipe_product_id' => 195,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'    => 25,
                'recipe_name' => 'Nestle juice',
                'recipe_product_id' => 196,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],



        ]);

    }
}
