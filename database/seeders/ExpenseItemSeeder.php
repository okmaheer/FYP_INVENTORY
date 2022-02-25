<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('expense_items')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('expense_items')->insert([

            [
                'id'  => 1,
                'expense_item_name' => 'Software',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 2,
                'expense_item_name' => 'Bike Repair Maintenance',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 3,
                'expense_item_name' => 'Car Repair Maintenance',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 4,
                'expense_item_name' => 'Dish Washer Area Expense',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 5,
                'expense_item_name' => 'Dera',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 6,
                'expense_item_name' => 'Sanitary Work',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 7,
                'expense_item_name' => 'Food Testing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  =>8,
                'expense_item_name' => 'House Keeping',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 9,
                'expense_item_name' => 'Electrical Work',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 10,
                'expense_item_name' => 'Hardware Work',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 11,
                'expense_item_name' => 'PMC Board',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 12,
                'expense_item_name' => 'Advertisement Cost',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 13,
                'expense_item_name' => 'Entertainment Expense',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 14,
                'expense_item_name' => 'Medical Expenses',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 15,
                'expense_item_name' => 'Misc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 16,
                'expense_item_name' => 'Traveling',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 17,
                'expense_item_name' => 'Paint Works',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 18,
                'expense_item_name' => 'Roshan Pakistan',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 19,
                'expense_item_name' => 'Mini Kitchen',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 20,
                'expense_item_name' => 'Function Service Tax',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 21,
                'expense_item_name' => 'Ac Service',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 22,
                'expense_item_name' => 'Fuel Generator',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 23,
                'expense_item_name' => 'Telephone Mobile Bills',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 24,
                'expense_item_name' => 'Generator Expenses',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 25,
                'expense_item_name' => 'Electricity Three Phase Meter',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 26,
                'expense_item_name' => 'Electricity Single Phase Meter',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 27,
                'expense_item_name' => 'Garden Expenses',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 28,
                'expense_item_name' => 'Water Tank',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 29,
                'expense_item_name' => 'Repair Maintaince',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 30,
                'expense_item_name' => 'Kitchen Repair Maintaince',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 31,
                'expense_item_name' => 'Internet Bills',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 32,
                'expense_item_name' => 'Tandoori Expeses',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
