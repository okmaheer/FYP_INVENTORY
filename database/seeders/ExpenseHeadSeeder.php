<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('expense_heads')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('expense_heads')->insert([

            [
                'id'  => 1,
                'expense_head_name' => 'Software',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 2,
                'expense_head_name' => 'Bike Repair Maintenance',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 3,
                'expense_head_name' => 'Car Repair Maintenance',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 4,
                'expense_head_name' => 'Dish Washer Area Expense',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 5,
                'expense_head_name' => 'Dera',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 6,
                'expense_head_name' => 'Sanitary Work',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 7,
                'expense_head_name' => 'Food Testing',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  =>8,
                'expense_head_name' => 'House Keeping',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 9,
                'expense_head_name' => 'Electrical Work',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 10,
                'expense_head_name' => 'Hardware Work',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 11,
                'expense_head_name' => 'PMC Board',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 12,
                'expense_head_name' => 'Advertisement Cost',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 13,
                'expense_head_name' => 'Entertainment Expense',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 14,
                'expense_head_name' => 'Medical Expenses',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 15,
                'expense_head_name' => 'Misc',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 16,
                'expense_head_name' => 'Traveling',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 17,
                'expense_head_name' => 'Paint Works',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id'  => 18,
                'expense_head_name' => 'Roshan Pakistan',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 19,
                'expense_head_name' => 'Mini Kitchen',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 20,
                'expense_head_name' => 'Function Service Tax',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 21,
                'expense_head_name' => 'AC Service',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 22,
                'expense_head_name' => 'Fuel Generator',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 23,
                'expense_head_name' => 'Telephone Mobile Bills',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 24,
                'expense_head_name' => 'Generator Expenses',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 25,
                'expense_head_name' => 'Electricity Three Phase Meter',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 26,
                'expense_head_name' => 'Electricity Single Phase Meter',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 27,
                'expense_head_name' => 'Garden Expenses',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 28,
                'expense_head_name' => 'Water Tank',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 29,
                'expense_head_name' => 'Repair Maintaince',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 30,
                'expense_head_name' => 'Kitchen Repair Maintaince',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 31,
                'expense_head_name' => 'Internet Bills',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id'  => 32,
                'expense_head_name' => 'Tandoori Expeses',
                'parent_id' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
