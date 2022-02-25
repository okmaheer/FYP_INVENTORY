<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('suppliers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        /*DB::table('suppliers')->insert([
            [
                'id' => '1',
                'supplier_name' => 'Yasir Karyana Store',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '2',
                'supplier_name' => 'Siraj Milk Shop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '3',
                'supplier_name' => 'New Faisal Beverages',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '4',
                'supplier_name' => 'Mumtaz Chicken',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '5',
                'supplier_name' => 'Jaffar Sabzi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '6',
                'supplier_name' => 'Tahir Decore+Dj+Sound+Stage',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '7'   ,
                'supplier_name' => 'Tahir B.B.Q',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '8',
                'supplier_name' => 'Abdul Sattar Meat',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '9',
                'supplier_name' => 'Amjad Shehbaz Tent house',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '10',
                'supplier_name' => 'Quality Sweet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '11',
                'supplier_name' => 'Majid Toor Meat Contractor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '12',
                'supplier_name' => 'Bilal Pepsi Trades',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '13',
                'supplier_name' => 'Sajjad Beef Contractor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '14',
                'supplier_name' => 'Amir House Keeps',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '15',
                'supplier_name' => 'Amir Electrition Contractor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'id' => '16',
                'supplier_name' => 'Bilal Rice',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '17',
                'supplier_name' => 'Madina Karyana Store',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '18',
                'supplier_name' => 'GN Meat Shop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '19',
                'supplier_name' => 'New Vendor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '20',
                'supplier_name' => 'Hanzla Traders',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '21',
                'supplier_name' => 'Adnan National',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '22',
                'supplier_name' => 'Sohail Purex Tissue',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '23',
                'supplier_name' => 'Sajid Tissues CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '24',
                'supplier_name' => 'Kareem Bux CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '25',
                'supplier_name' => 'Naik Tandoori',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '26',
                'supplier_name' => 'Ali Gohar Waiter CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '27',
                'supplier_name' => 'Ladies Waiter',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '28',
                'supplier_name' => 'Shahid CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '29',
                'supplier_name' => 'Shahid Gol Gappy CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '30',
                'supplier_name' => 'Amir Water CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '31',
                'supplier_name' => 'Jhangir Ice Shop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '32',
                'supplier_name' => 'Aziz Gas Center',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '33',
                'supplier_name' => 'Arshad City Gas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '34',
                'supplier_name' => 'Arif Ali CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '35',
                'supplier_name' => 'Danish Ali CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '36',
                'supplier_name' => 'Adeel CONT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '37',
                'supplier_name' => 'Naeem Mano CONTN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '38',
                'supplier_name' => 'Khalifa Cleaners',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '39',
                'supplier_name' => 'Mudassir Decoration',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '40',
                'supplier_name' => 'WEDD N STYLE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '41',
                'supplier_name' => 'Rehmani Sound System',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '42',
                'supplier_name' => 'Arif SB GM',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);*/
    }
}
