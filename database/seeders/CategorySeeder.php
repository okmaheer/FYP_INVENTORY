<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('categories')->insert([
            [
                'name' => 'General',
                'slug' => Str::slug('General', '-'),
                'status' => 1,
                'type' => 'general',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Chicken Menu',
                'slug' => Str::slug('Chicken Menu', '-'),
                'status' => 1,
                'type' => 'menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Mutton Menu',
                'slug' => Str::slug('Mutton Menu', '-'),
                'status' => 1,
                'type' => 'menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Rasm e Hina Menu-1',
                'slug' => Str::slug('Rasm e Hina Menu-1', '-'),
                'status' => 1,
                'type' => 'menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Rasm e Hina Menu-2',
                'slug' => Str::slug('Rasm e Hina Menu-2', '-'),
                'status' => 1,
                'type' => 'menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Package 1',
                'slug' => Str::slug('Package 1', '-'),
                'status' => 1,
                'type' => 'menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Package 2',
                'slug' => Str::slug('Package 2', '-'),
                'status' => 1,
                'type' => 'menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Package 3',
                'slug' => Str::slug('Package 3', '-'),
                'status' => 1,
                'type' => 'menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Kitchen Items',
                'slug' => Str::slug('Kitchen Items', '-'),
                'status' => 1,
                'type' => 'hardware',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Raw Materials',
                'slug' => Str::slug('Raw Materials', '-'),
                'status' => 1,
                'type' => 'raw_materials',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
            [
                'name' => 'Fix Assets',
                'slug' => Str::slug('Fix Assets', '-'),
                'status' => 1,
                'type' => 'fix_assets',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'location_id' => 1,
            ],
        ]);
    }
}
