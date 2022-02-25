<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('employees')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('employees')->insert([
            ['id' => 1,  'designation_id' =>1,'first_name' => 'Abdullah', 'last_name' => 'Waheed','rate_type' => 2,'hrate' => 80000.00],
            ['id' => 2,  'designation_id' =>2,'first_name' => 'Muhammad', 'last_name' => 'Akhtar','rate_type' => 2,'hrate' => 20000.00],
            ['id' => 3,  'designation_id' =>3,'first_name' => 'Muhammad', 'last_name' => 'Arif','rate_type' => 2,'hrate' => 60000.00],
            ['id' => 4,  'designation_id' =>4,'first_name' => 'Muhammad', 'last_name' => 'Husnain','rate_type' => 2,'hrate' => 40000.00],
            ['id' => 5,  'designation_id' =>5,'first_name' => 'Nouman', 'last_name' => 'Ashraf','rate_type' => 2,'hrate' => 33200.00],
            ['id' => 6,  'designation_id' =>6,'first_name' => 'Naeem', 'last_name' => 'Mano','rate_type' => 2,'hrate' => 20000.00],
            ['id' => 7,  'designation_id' =>7,'first_name' => 'Muhammad', 'last_name' => 'Nadeem','rate_type' => 2,'hrate' => 12000.00],
            ['id' => 8,  'designation_id' =>7,'first_name' => 'Ghulam', 'last_name' => 'Safdar','rate_type' => 2,'hrate' => 18000.00],
            ['id' => 9,  'designation_id' =>8,'first_name' => 'Arif', 'last_name' => 'Ali','rate_type' => 2,'hrate' => 17000.00],
            ['id' => 10 ,'designation_id' => 9,'first_name' => 'Ghulam', 'last_name' => 'Yaseen','rate_type' => 2,'hrate' => 15000.00],
            ['id' => 11 ,'designation_id' => 10,'first_name' => 'Danish', 'last_name' => 'Guard','rate_type' => 2,'hrate' => 15000.00],
            ['id' => 12 ,'designation_id' => 11,'first_name' => 'Akhtar', 'last_name' => 'Wapda','rate_type' => 2,'hrate' => 10000.00],
            ['id' => 13 ,'designation_id' => 10,'first_name' => 'Imtiaz', 'last_name' => 'Guard','rate_type' => 2,'hrate' => 14000.00],
            ['id' => 14 ,'designation_id' => 12,'first_name' => 'Aamir', 'last_name' => 'Electrition','rate_type' => 2,'hrate' => 15000.00],
            ['id' => 15 ,'designation_id' => 10,'first_name' => 'Company', 'last_name' => 'Security Guard','rate_type' => 2,'hrate' => 14000.00],
            ['id' => 16 ,'designation_id' => 13,'first_name' => 'Muhammad', 'last_name' => 'Ashraf','rate_type' => 2,'hrate' => 100000.00],
            ['id' => 17 ,'designation_id' => 14,'first_name' => 'Muhammad', 'last_name' => 'Waqas','rate_type' => 2,'hrate' => 40000.00],
            ['id' => 18 ,'designation_id' => 15,'first_name' => 'Nadeem', 'last_name' => 'Fryman','rate_type' => 2,'hrate' => 22000.00],
            ['id' => 19 ,'designation_id' => 16,'first_name' => 'Amanullah', 'last_name' => 'Cold Kitchen','rate_type' => 2,'hrate' => 20000.00],
            ['id' => 20 ,'designation_id' => 17,'first_name' => 'Ali', 'last_name' => 'Zain','rate_type' => 2,'hrate' => 15000.00],
            ['id' => 21 ,'designation_id' => 17,'first_name' => 'Sufyan', 'last_name' => 'Naveed','rate_type' => 2,'hrate' => 15000.00],
            ['id' => 22 ,'designation_id' => 17,'first_name' => 'Haroon', 'last_name' => 'Helper','rate_type' => 2,'hrate' => 21000.00],
            ['id' => 23 ,'designation_id' => 17,'first_name' => 'Akhlaq', 'last_name' => 'helper','rate_type' => 2,'hrate' => 22000.00],
            ['id' => 24 ,'designation_id' => 18,'first_name' => 'Noman', 'last_name' => 'Shah','rate_type' => 2,'hrate' => 18000.00],
            ['id' => 25 ,'designation_id' => 19,'first_name' => 'Naik', 'last_name' => 'Muhammad','rate_type' => 2,'hrate' => 20000.00],
            ['id' => 26 ,'designation_id' => 17,'first_name' => 'Bilal', 'last_name' => 'Tandoori','rate_type' => 2,'hrate' => 18000.00],
            ['id' => 27 ,'designation_id' => 20,'first_name' => 'Kareem', 'last_name' => 'Baksh','rate_type' => 2,'hrate' => 15000.00],
            ['id' => 28 ,'designation_id' => 21,'first_name' => 'Muhammad', 'last_name' => 'Nadeem','rate_type' => 2,'hrate' => 20000.00],
            ['id' => 29 ,'designation_id' => 21,'first_name' => 'Abdur', 'last_name' => 'Rehman','rate_type' => 2,'hrate' => 15000.00],
            ['id' => 30 ,'designation_id' => 22,'first_name' => 'Hamza', 'last_name' => 'Office','rate_type' => 2,'hrate' => 14000.00],
            ['id' => 31 ,'designation_id' => 18,'first_name' => 'Asif', 'last_name' => 'supervisor','rate_type' => 2,'hrate' => 18000.00],
        ]);
    }
}
