<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeDetailsSeederold extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('recipe_details')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('recipe_details')->insert([
            [
                'recipe_id' => 1,
                'product_id' => 9,
                'final_quantity' => 12,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 16,
                'final_quantity' => 0.382,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 18,
                'final_quantity' => 0.075,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 19,
                'final_quantity' => 0.135,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 46,
                'final_quantity' => 0.29,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 109,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'recipe_id' => 1,
                'product_id' => 12,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 152,
                'final_quantity' => 2.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 144,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 9,
                'final_quantity' => 12,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 1,
                'product_id' => 72,
                'final_quantity' => 30,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /*chicken fried rice end*/

            [
                'recipe_id' => 2,
                'product_id' => 16,
                'final_quantity' => 0.2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 18,
                'final_quantity' => 0.04,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 14,
                'final_quantity' => 0.08,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 12,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 46,
                'final_quantity' => 0.2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 19,
                'final_quantity' => 0.04,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 142,
                'final_quantity' => 0.2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'recipe_id' => 2,
                'product_id' => 109,
                'final_quantity' => 10,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 30,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 85,
                'final_quantity' => 5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 2,
                'product_id' => 29,
                'final_quantity' => 0.75,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /*Deeg chicken manchurian end*/
            [
                'recipe_id' => 3,
                'product_id' => 15,
                'final_quantity' => 0.07,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 16,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 14,
                'final_quantity' => 0.07,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 178,
                'final_quantity' => 0.025,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 24,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 12,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 100,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 70,
                'final_quantity' => 0.035,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 67,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 179,
                'final_quantity' => 0.05,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 138,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 139,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 140,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 142,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 145,
                'final_quantity' => 0.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 97,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 3,
                'product_id' => 1,
                'final_quantity' => 12,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'recipe_id' => 3,
                'product_id' => 69,
                'final_quantity' => 0.02,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            /*chicken Qorma end*/

            [
                'recipe_id' => 4,
                'product_id' => 1,
                'final_quantity' => 60,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 12,
                'final_quantity' => 8,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 17,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 16,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 46,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 14,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 18,
                'final_quantity' => 0.076,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 178,
                'final_quantity' => 0.15,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 97,
                'final_quantity' => 9,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 180,
                'final_quantity' => 0.02,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 67,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 45,
                'final_quantity' => 0.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 155,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 4,
                'product_id' => 43,
                'final_quantity' => 0.02,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*Steam roast  end*/

            [
                'recipe_id' => 5,
                'product_id' => 16,
                'final_quantity' => 0.21,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 12,
                'final_quantity' => 7,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 14,
                'final_quantity' => 0.150,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 18,
                'final_quantity' => 0.060,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 46,
                'final_quantity' => 0.150,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 30,
                'final_quantity' => 1.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 31,
                'final_quantity' => 1.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 41,
                'final_quantity' => 0.250,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 72,
                'final_quantity' => 12,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 73,
                'final_quantity' => 0.01,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 155,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 5,
                'product_id' => 109,
                'final_quantity' => 25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],


             /*Dhaaka chicken 25 kg end*/

             [
                'recipe_id' => 6,
                'product_id' => 24,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 6,
                'product_id' => 29,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 6,
                'product_id' => 51,
                'final_quantity' => 8,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 6,
                'product_id' => 23,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 6,
                'product_id' => 153,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 6,
                'product_id' => 160,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 6,
                'product_id' => 98,
                'final_quantity' => 45,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 6,
                'product_id' => 92,
                'final_quantity' => 5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*Fruit trifle 40 kg end*/

            [
                'recipe_id' => 7,
                'product_id' => 99,
                'final_quantity' => 7,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 29,
                'final_quantity' => 5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 144,
                'final_quantity' => 30,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 101,
                'final_quantity' => 1.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 13,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 72,
                'final_quantity' => 36,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 98,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 22,
                'final_quantity' => 0.35,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 20,
                'final_quantity' => 0.4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 92,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 32,
                'final_quantity' => 0.01,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 21,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 7,
                'product_id' => 181,
                'final_quantity' => 0.05,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*Gajar halwa 25 kg end*/

            [
                'recipe_id' => 8,
                'product_id' => 98,
                'final_quantity' => 21,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 68,
                'final_quantity' => 0.340,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 52,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 24,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'recipe_id' => 8,
                'product_id' => 20,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 21,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 74,
                'final_quantity' => 0.010,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 182,
                'final_quantity' => 0.050,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 32,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 35,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 40,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 29,
                'final_quantity' => 3.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 36,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 8,
                'product_id' => 65,
                'final_quantity' => 0.01,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*kashmiri tea 60 kg end*/

            [
                'recipe_id' => 9,
                'product_id' => 99,
                'final_quantity' => 2.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 9,
                'product_id' => 29,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 9,
                'product_id' => 20,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 9,
                'product_id' => 80,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 9,
                'product_id' => 32,
                'final_quantity' => 0.02,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 9,
                'product_id' => 98,
                'final_quantity' => 40,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 9,
                'product_id' => 92,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*kheer 30 kg end*/

            [
                'recipe_id' => 10,
                'product_id' => 98,
                'final_quantity' => 40,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 29,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 183,
                'final_quantity' => 5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 99,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 21,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 20,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 24,
                'final_quantity' => 15,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 184,
                'final_quantity' => 10,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 96,
                'final_quantity' => 60,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 23,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 92,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 185,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 10,
                'product_id' => 186,
                'final_quantity' => 5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*lab e shirine 50 kg end*/

            [
                'recipe_id' => 11,
                'product_id' => 15,
                'final_quantity' => 0.07,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 16,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 14,
                'final_quantity' => 0.07,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 178,
                'final_quantity' => 0.025,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 24,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 13,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 100,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 70,
                'final_quantity' => 0.2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 67,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 179,
                'final_quantity' => 0.05,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 138,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 139,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 140,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 141,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 142,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 145,
                'final_quantity' => 0.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 97,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 172,
                'final_quantity' => 15,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 92,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 69,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 11,
                'product_id' => 71,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*Mutton qorma bakra end*/

            [
                'recipe_id' => 12,
                'product_id' => 15,
                'final_quantity' => 0.07,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 16,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 14,
                'final_quantity' => 0.07,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 178,
                'final_quantity' => 0.025,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 24,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 13,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 100,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 70,
                'final_quantity' => 0.2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 67,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 179,
                'final_quantity' => 0.05,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 138,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 139,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 140,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 141,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 142,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 145,
                'final_quantity' => 0.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 97,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 172,
                'final_quantity' => 15,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 92,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 69,
                'final_quantity' => 0.03,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 12,
                'product_id' => 71,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             /*Mutton qorma path end*/

             [
                'recipe_id' => 13,
                'product_id' => 71,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 13,
                'product_id' => 13,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 13,
                'product_id' => 16,
                'final_quantity' => 0.22,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 13,
                'product_id' => 34,
                'final_quantity' => 0.07,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 13,
                'product_id' => 82,
                'final_quantity' => 30,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 13,
                'product_id' => 187,
                'final_quantity' => 15,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 13,
                'product_id' => 92,
                'final_quantity' => 7,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*roti 310 end*/

            [
                'recipe_id' => 14,
                'product_id' => 31,
                'final_quantity' => 16,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 16,
                'final_quantity' => 0.125,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 29,
                'final_quantity' => 0.215,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 71,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 34,
                'final_quantity' => 0.02,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 32,
                'final_quantity' => 0.015,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 68,
                'final_quantity' => 0.3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 65,
                'final_quantity' => 0.045,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 66,
                'final_quantity' => 0.04,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 13,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 41,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 12,
                'final_quantity' => 0.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 187,
                'final_quantity' => 7,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 14,
                'product_id' => 92,
                'final_quantity' => 7,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
               /*naan end*/

               [
                'recipe_id' => 15,
                'product_id' => 62,
                'final_quantity' => 9,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 25,
                'final_quantity' => 1.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 24,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 23,
                'final_quantity' => 1.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 18,
                'final_quantity' => 0.05,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 155,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 60,
                'final_quantity' => 0.1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 154,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 16,
                'final_quantity' => 0.05,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 100,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 15,
                'product_id' => 92,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*Russian salads one set end*/

            [
                'recipe_id' => 16,
                'product_id' => 99,
                'final_quantity' => 4.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 29,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 101,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 13,
                'final_quantity' => 1.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 32,
                'final_quantity' => 0.01,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 21,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 22,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 20,
                'final_quantity' => 0.4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 92,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 137,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 16,
                'product_id' => 153,
                'final_quantity' => 4.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*shahi halwa 25kg end*/

            [
                'recipe_id' => 17,
                'product_id' => 99,
                'final_quantity' => 3.5,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 29,
                'final_quantity' => 4,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 20,
                'final_quantity' => 0.25,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 80,
                'final_quantity' => 2,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 42,
                'final_quantity' => 0.02,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 32,
                'final_quantity' => 0.02,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 98,
                'final_quantity' => 40,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 92,
                'final_quantity' => 3,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 17,
                'product_id' => 188,
                'final_quantity' => 165,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            /*Thothi kheer 30kg end*/

            [
                'recipe_id' => 18,
                'product_id' => 189,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 19,
                'product_id' => 190,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 20,
                'product_id' => 191,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 21,
                'product_id' => 192,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 22,
                'product_id' => 193,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 23,
                'product_id' => 194,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 24,
                'product_id' => 195,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'recipe_id' => 25,
                'product_id' => 196,
                'final_quantity' => 1,
                'unit' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
