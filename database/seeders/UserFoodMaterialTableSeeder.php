<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserFoodMaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_food_material')->insert([
            [
                'id' => 2,
                'user_id' => 2,
                'food_material_id' => 101,
                'quantity' => 12.00,
                'unit' => 'gram',
                'created_at' => '2025-06-12 21:26:48',
                'updated_at' => '2025-06-12 21:26:48',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'food_material_id' => 23,
                'quantity' => 100.00,
                'unit' => 'gram',
                'created_at' => '2025-06-12 21:27:11',
                'updated_at' => '2025-06-12 21:27:11',
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'food_material_id' => 110,
                'quantity' => 120.00,
                'unit' => 'gram',
                'created_at' => '2025-06-12 21:27:29',
                'updated_at' => '2025-06-12 21:27:29',
            ],
        ]);
        DB::statement('ALTER TABLE user_food_material AUTO_INCREMENT = 5;');
    }
}