<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
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
            ['recipe_name' => 'Chicken Fried Rice', 'recipe_product_id' => 162 ],
            ['recipe_name' => 'Deeg Chicken manchurian', 'recipe_product_id' => 163 ],
            ['recipe_name' => 'Chicken Qorma', 'recipe_product_id' => 2 ],
            ['recipe_name' => 'Steam Roast', 'recipe_product_id' => 164 ],
            ['recipe_name' => 'Dhaka chicken [25kg)', 'recipe_product_id' => 165 ],
            ['recipe_name' => 'Fruit trifle 40kg', 'recipe_product_id' => 166 ],
            ['recipe_name' => 'Gajar halwa 25kg', 'recipe_product_id' => 167 ],
            ['recipe_name' => 'Kashmiri Tea [50person)', 'recipe_product_id' => 168 ],
            ['recipe_name' => 'Kheer [30kg)', 'recipe_product_id' => 169 ],
            ['recipe_name' => 'Lab e sherein [50kg)', 'recipe_product_id' => 170 ],
            ['recipe_name' => 'Mutton qorma bakra', 'recipe_product_id' => 171 ],
            ['recipe_name' => 'Mutton qorma path', 'recipe_product_id' => 172 ],
            ['recipe_name' => 'Milky roti 310', 'recipe_product_id' => 173 ],
            ['recipe_name' => 'Naan 160', 'recipe_product_id' => 174 ],
            ['recipe_name' => 'Russian salads[one set)', 'recipe_product_id' => 175 ],
            ['recipe_name' => 'Shahi Halwa [25kg)', 'recipe_product_id' => 176 ],
            ['recipe_name' => 'Thothi kheer [30kg)', 'recipe_product_id' => 177 ],
            ['recipe_name' => 'Cold Drink 500ml', 'recipe_product_id' => 190 ],
            ['recipe_name' => 'Small water', 'recipe_product_id' => 191 ],
            ['recipe_name' => 'Large water', 'recipe_product_id' => 192 ],
            ['recipe_name' => 'can water', 'recipe_product_id' => 193 ],
            ['recipe_name' => 'Tin pack', 'recipe_product_id' => 194 ],
            ['recipe_name' => 'juice', 'recipe_product_id' => 195 ],
            ['recipe_name' => 'Nestle juice', 'recipe_product_id' => 196 ],
            ['recipe_name' => 'Honey Chicken', 'recipe_product_id' => 197 ],
            ['recipe_name' => 'Chicken Boneless', 'recipe_product_id' => 216 ],
            ['recipe_name' => 'Plum sauce', 'recipe_product_id' => 198 ],
            ['recipe_name' => 'Salads set', 'recipe_product_id' => 199 ],
            ['recipe_name' => 'Haleem', 'recipe_product_id' => 200 ],
            ['recipe_name' => 'Chicken afgani pulao', 'recipe_product_id' => 201 ],
            ['recipe_name' => 'Mutton afgani pulao', 'recipe_product_id' => 202 ],
            ['recipe_name' => 'Beef afgani pulao', 'recipe_product_id' => 203 ],
            ['recipe_name' => 'Chicken behari botti', 'recipe_product_id' => 204 ],
            ['recipe_name' => 'Soup', 'recipe_product_id' => 205 ],
            ['recipe_name' => 'Dam pukht Mutton', 'recipe_product_id' => 206 ],
            ['recipe_name' => 'Raita', 'recipe_product_id' => 207 ],
            ['recipe_name' => 'Zarda', 'recipe_product_id' => 208 ],
            ['recipe_name' => 'Channa Biryani', 'recipe_product_id' => 209 ],
            ['recipe_name' => 'Labnese Chicken Qorma', 'recipe_product_id' => 210 ],
            ['recipe_name' => 'Beef Qorma', 'recipe_product_id' => 211 ],
            ['recipe_name' => 'Chicken almond', 'recipe_product_id' => 212 ],
            ['recipe_name' => 'Shahi Tukra', 'recipe_product_id' => 213 ],
            ['recipe_name' => 'White Chicken qorma', 'recipe_product_id' => 215 ],
            ['recipe_name' => 'Reshmi kabab', 'recipe_product_id' => 214 ],

        ]);
    }
}
