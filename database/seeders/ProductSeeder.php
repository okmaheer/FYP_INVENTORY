<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('products')->insert([

            [
                'id' => 1,
                'product_name' => 'Chicken',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'product_name' => 'Chicken Qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'product_name' => 'Chicken Biryani',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'product_name' => 'Chicken Jelfrazi',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'product_name' => 'Mutton Qorma',
                'category_id' => 3,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'product_name' => 'Mutton Karahi',
                'category_id' => 3,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'product_name' => 'Mutton Biryani',
                'category_id' => 3,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'product_name' => 'Daal',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 9,
                'product_name' => 'Rice',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 10,
                'product_name' => 'Gol Gappy',
                'category_id' => 4,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 11,
                'product_name' => 'Deeg',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 12,
                'product_name' => 'Oil',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 13,
                'product_name' => 'Ghee',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 14,
                'product_name' => 'Surkh Mirch',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 15,
                'product_name' => 'Haldi',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 16,
                'product_name' => 'Namak',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 17,
                'product_name' => 'Sirka',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 18,
                'product_name' => 'Safyed Mirch',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 19,
                'product_name' => 'Kali Mirch',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 20,
                'product_name' => 'Badam',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 21,
                'product_name' => 'Pista',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 22,
                'product_name' => 'Kaju',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 23,
                'product_name' => 'Mix Fruit',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 24,
                'product_name' => 'Cream',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 25,
                'product_name' => 'Mayoonez',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 26,
                'product_name' => 'Bread Crum',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 27,
                'product_name' => 'Chawal Paki',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 28,
                'product_name' => 'Chawal Kachi 1121',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 29,
                'product_name' => 'cheeni',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 30,
                'product_name' => 'Corn Flour',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 31,
                'product_name' => 'Meyda',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 32,
                'product_name' => 'Sabaz Ilyachi',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 33,
                'product_name' => 'Kala Zeera',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 34,
                'product_name' => 'Safed Zeera',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 35,
                'product_name' => 'Moti Ilyachi',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 36,
                'product_name' => 'Daar Cheeni',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 37,
                'product_name' => 'Long',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 38,
                'product_name' => 'Jayfal',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 39,
                'product_name' => 'Jalwatri',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 40,
                'product_name' => 'Bade e khatai',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 41,
                'product_name' => 'Till Safyed',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 42,
                'product_name' => 'Zafraan',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 43,
                'product_name' => 'Tez Pata',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 44,
                'product_name' => 'Aloo bukhara',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 45,
                'product_name' => 'imli',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 46,
                'product_name' => 'China Salt',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 47,
                'product_name' => 'Soya Sauce',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 48,
                'product_name' => 'Adrak Powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 49,
                'product_name' => 'Gulab jamun',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 50,
                'product_name' => 'Lahsan Powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 51,
                'product_name' => 'Custerd Powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 52,
                'product_name' => 'Kashmiri Chaye',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 53,
                'product_name' => 'Gol Mirch',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 54,
                'product_name' => 'Kishmish',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 55,
                'product_name' => 'Giri',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 56,
                'product_name' => 'Chawary',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 57,
                'product_name' => 'Mix Maraba',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 58,
                'product_name' => 'Lobiya',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 59,
                'product_name' => 'Chana Safyed',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 60,
                'product_name' => 'Cheery',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 61,
                'product_name' => 'Pine Apple',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 62,
                'product_name' => 'Apple',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  =>63,
                'product_name' => 'Macaroni',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  =>64,
                'product_name' => 'Shahed',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  =>65,
                'product_name' => 'Mitha Soda',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  =>66,
                'product_name' => 'yeast',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  =>67,
                'product_name' => 'Garam Masala Powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  =>68,
                'product_name' => 'Every Day',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 69,
                'product_name' => 'Sabat Dhaniya',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 70,
                'product_name' => 'Qorma Masalah',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 71,
                'product_name' => 'Milk Pack',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 72,
                'product_name' => 'Eggs',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 73,
                'product_name' => 'Zardha Rang',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 74,
                'product_name' => 'Gulabi Rang',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 75,
                'product_name' => 'Sabz Rang',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 76,
                'product_name' => 'Giri Powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],  [
                'id'  => 77,
                'pro  => 1,duct_name' => 'Karahi Maslah',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 78,
                'pro  => 1,duct_name' => 'Egg pudding',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 79,
                'pro  => 1,duct_name' => 'Karondha',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 80,
                'pro  => 1,duct_name' => 'Tota Chawal',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 81,
                'pro  => 1,duct_name' => 'Giri Akhroat',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 82,
                'product_name' => 'Aatta',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 83,
                'product_name' => 'Meydah',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 84,
                'product_name' => 'Chat Masalah',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 85,
                'product_name' => 'Katchup',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 86,
                'product_name' => 'Surf',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 87,
                'product_name' => 'Vim',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 88,
                'product_name' => 'Foam',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 89,
                'product_name' => 'Jali',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 90,
                'pro  => 1,duct_name' => 'Malmal kapra',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 91,
                'pro  => 1,duct_name' => 'Dastar kapra',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 92,
                'pro  => 1,duct_name' => 'Gas',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 93,
                'pro  => 1,duct_name' => 'Paper tape',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 94,
                'pro  => 1,duct_name' => 'Thumb Pin',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 95,
                'product_name' => 'Glint',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 96,
                'product_name' => 'Keyla',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 97,
                'product_name' => 'Dahi',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 98,
                'product_name' => 'Dhodh',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 99,
                'product_name' => 'Khoya',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 100,
                'product_name' => 'Makhan',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 101,
                'product_name' => 'Desi Ghee',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 102,
                'product_name' => 'Sprit',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 103,
                'product_name' => 'Cotton',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 104,
                'product_name' => 'Beef',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 105,
                'product_name' => 'Beef Qeema',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 106,
                'product_name' => 'Mutton',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 107,
                'product_name' => 'Mutton Qeema',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 108,
                'product_name' => 'Chicken',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 109,
                'product_name' => 'Chicken Boneless',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 110,
                'product_name' => 'Fish yankah Syeen',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 111,
                'product_name' => 'Fish Dumrah',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 112,
                'product_name' => 'Liquid Soop',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 113,
                'product_name' => 'Tissue Roll',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 114,
                'product_name' => 'High Jyeen Tissue',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 115,
                'product_name' => 'Sar',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 116,
                'pro  => 1,duct_name' => 'Fanyal',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 117,
                'pro  => 1,duct_name' => 'Dry Mob',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 118,
                'pro  => 1,duct_name' => 'Wet Mob',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 119,
                'pro  => 1,duct_name' => 'Phool Jharoo',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 120,
                'pro  => 1,duct_name' => 'Air Freshner',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 121,
                'product_name' => 'Fly Miker',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 122,
                'product_name' => 'Sweep',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 123,
                'product_name' => 'Baleech powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 124,
                'product_name' => 'Neeyl',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 125,
                'product_name' => 'Kastak Soda',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 126,
                'product_name' => 'Khara Soda',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 127,
                'product_name' => 'Baleech Liquid',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 128,
                'product_name' => 'Coldrink Regular',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 129,
                'product_name' => 'Tin Pack small',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 130,
                'product_name' => 'Diet Teen Pack',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 131,
                'product_name' => 'Minral Water Chota',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 132,
                'product_name' => 'Juice',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 133,
                'product_name' => 'Disposible Cup',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 134,
                'product_name' => 'Tissue Box',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 135,
                'product_name' => 'Tooth Pix',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 136,
                'product_name' => 'Stik',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 137,
                'product_name' => 'Aloo',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 138,
                'product_name' => 'Payaz',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 139,
                'product_name' => 'Tamatar',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 140,
                'product_name' => 'Sabaz Mirch',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 141,
                'product_name' => 'Adrak',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 142,
                'product_name' => 'Lahsan',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 143,
                'product_name' => 'Band Ghobi',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 144,
                'product_name' => 'Gajar',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 145,
                'product_name' => 'Sabaz Dhaniya',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 146,
                'product_name' => 'Mooli',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 147,
                'product_name' => 'Chaqander',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 148,
                'product_name' => 'Salad Pata',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 149,
                'product_name' => 'Shimla Mirch',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 150,
                'product_name' => 'Matar',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 151,
                'product_name' => 'Poodiyna',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 152,
                'product_name' => 'Sabaz Payaz',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 153,
                'product_name' => 'Ladhi cake',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 154,
                'product_name' => 'icing sugar',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 155,
                'product_name' => 'leemu',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 156,
                'product_name' => 'Mineral water bara',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 157,
                'product_name' => 'water can',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 158,
                'product_name' => 'Shappar',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 159,
                'product_name' => 'Khakhi bags',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 160,
                'product_name' => 'jelli',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 161,
                'product_name' => 'Kheera',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 162,
                'product_name' => 'Chicken fried Rice',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 163,
                'product_name' => 'Deeg Chicken Manchurian ',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 164,
                'product_name' => 'steam Roast 60',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 165,
                'product_name' => 'Dhaka chicken',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 166,
                'product_name' => 'Fruit Trifle',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 167,
                'product_name' => 'Gajar Halwa',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 168,
                'product_name' => 'Kashmiri Tea',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 169,
                'product_name' => 'Kheer ',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 170,
                'product_name' => 'Lab e sherine ',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 171,
                'product_name' => 'Mutton Qorma Bakra',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 172,
                'product_name' => 'Mutton Qorma Path',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 173,
                'product_name' => 'Milky roti',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 174,
                'product_name' => 'Naan',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 175,
                'product_name' => 'Russian Salad (one set)',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 176,
                'product_name' => 'shahi Halwa',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 177,
                'product_name' => 'Thothi kheer',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 178,
                'product_name' => 'Darar mirch',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 179,
                'product_name' => 'Garam Masala Sabat',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 180,
                'product_name' => 'food color',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 181,
                'product_name' => 'Rang Kat',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 182,
                'product_name' => 'Sonf',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 183,
                'product_name' => 'sawayan',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 184,
                'product_name' => 'Ice cream',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 185,
                'product_name' => 'Ice(block)',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 186,
                'product_name' => 'Kulfa powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 187,
                'product_name' => 'water can 1 ltr',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 188,
                'product_name' => 'Thohtni',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => 191,
                'product_name' => 'Mineral Water 500ml',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 192,
                'product_name' => 'Mineral Water 1.5L',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 193,
                'product_name' => 'Can Water',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 194,
                'product_name' => 'Tin pack',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 195,
                'product_name' => 'juice',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 196,
                'product_name' => 'Nestle juice',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 197,
                'product_name' => 'Honey Chicken',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 198,
                'product_name' => 'Plum sauce',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 199,
                'product_name' => 'Salads set',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 200,
                'product_name' => 'Haleem',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 201,
                'product_name' => 'Chicken afgani pulao',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 202,
                'product_name' => 'Mutton afgani pulao',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 203,
                'product_name' => 'Beef afgani pulao',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 204,
                'product_name' => 'Chicken behari botti',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 205,
                'product_name' => 'Soup',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 206,
                'product_name' => 'Dam pukht Mutton',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 207,
                'product_name' => 'Raita',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 208,
                'product_name' => 'Zarda Special',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 209,
                'product_name' => 'Channa Biryani',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 210,
                'product_name' => 'Labnese Chicken Qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 211,
                'product_name' => 'Beef Qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 212,
                'product_name' => 'Chicken almond',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 213,
                'product_name' => 'Shahi Tukra',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 214,
                'product_name' => 'Reshmi kabab',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 215,
                'product_name' => 'White Chicken qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 216,
                'product_name' => 'Chicken Boneless',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 217,
                'product_name' => 'Chicken powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 218,
                'product_name' => 'Dhaniya Powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 219,
                'product_name' => 'Qasoori methi',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 220,
                'product_name' => 'Tallow',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 221,
                'product_name' => 'Koyla',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 222,
                'product_name' => 'Ajwain',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 223,
                'product_name' => 'Cheese',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 224,
                'product_name' => 'Biryani Masalah',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 225,
                'product_name' => 'cham cham',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 226,
                'product_name' => 'lemon squash',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 227,
                'product_name' => 'Chilli sause',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 228,
                'product_name' => 'Chicken behari botti',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 229,
                'product_name' => 'Papita',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 230,
                'product_name' => 'Daliya',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 231,
                'product_name' => 'Daal Mung',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 232,
                'product_name' => 'daal Masar',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 233,
                'product_name' => 'Daal Channa',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 234,
                'product_name' => 'Baking Powder',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 235,
                'product_name' => 'Jam e sherin',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 236,
                'product_name' => 'Haleem masala',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 237,
                'product_name' => 'Magaz',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 238,
                'product_name' => 'Daal Mash',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 239,
                'product_name' => 'Tin Pack Large',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 240,
                'product_name' => 'Halwa Puri',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 241,
                'product_name' => 'Jalebi',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 242,
                'product_name' => 'Mask',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 243,
                'product_name' => 'Senitizers',
                'category_id' => 10,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
              [
                'id'  => 244,
                'product_name' => 'chicken channa',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 245,
                'product_name' => 'Allu Bhujia',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 246,
                'product_name' => 'kabab masala',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'id'  => 247,
                'product_name' => 'kabab masala',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'id'  => 248,
                'product_name' => 'Mutton qeema',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'id'  => 249,
                'product_name' => 'beef Qeema',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'id'  => 250,
                'product_name' => 'Mutton white qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 251,
                'product_name' => 'Mutton steam Roast',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 252,
                'product_name' => 'Mutton Kunna',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 253,
                'product_name' => 'Muglai qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 254,
                'product_name' => 'beef white Qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 255,
                'product_name' => 'Beef steam roast',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 256,
                'product_name' => 'Beef nali',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 257,
                'product_name' => 'Beef dum pukht',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 258,
                'product_name' => 'Beef kunna',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 259,
                'product_name' => 'beef shahi Qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 260,
                'product_name' => 'labenez qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 261,
                'product_name' => 'black paper qorma',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 262,
                'product_name' => 'qalmi tikka',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 263,
                'product_name' => 'beef chapli kabab',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 264,
                'product_name' => 'chicken malai botti',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 265,
                'product_name' => 'rajistani tikka',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 266,
                'product_name' => 'Chicken botti',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 267,
                'product_name' => 'Chicken Steam roast',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 268,
                'product_name' => 'chicken green chili lemon',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 269,
                'product_name' => 'Chicken chilli dry',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 270,
                'product_name' => 'sweet & sour chicken',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 271,
                'product_name' => 'shashlik',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 272,
                'product_name' => 'steam',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 273,
                'product_name' => 'chicken Pulao',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 274,
                'product_name' => 'white pulao',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 275,
                'product_name' => 'Damra fried fish',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 276,
                'product_name' => 'Fish crakers',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 277,
                'product_name' => 'Fried fish',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 278,
                'product_name' => 'finger fish',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 279,
                'product_name' => 'Dhaka fish boneless',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 280,
                'product_name' => 'ice cream',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 281,
                'product_name' => 'Kulfi',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 282,
                'product_name' => 'zafrani kheer',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 283,
                'product_name' => 'Petha halwa ',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 284,
                'product_name' => 'variety salad',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 285,
                'product_name' => 'kachumar Salad',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 286,
                'product_name' => 'fresh Green salad',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 287,
                'product_name' => 'imli chatni',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 288,
                'product_name' => 'Chicken corn soup',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 289,
                'product_name' => 'sweet & sour soup',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 290,
                'product_name' => 'plan nan',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 291,
                'product_name' => 'mix nan',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 292,
                'product_name' => 'paratha',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 293,
                'product_name' => 'tandoori roti',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 294,
                'product_name' => 'mint margarita',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 295,
                'product_name' => 'nestle Juice',
                'category_id' => 2,
                'unit' => 1,
                'price' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);
    }
}
