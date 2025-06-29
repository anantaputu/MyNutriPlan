<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class, // Panggil UsersTableSeeder lebih dulu jika ada foreign key ke user_id
            ArticlesTableSeeder::class,
            FoodMaterialsTableSeeder::class,
            MenusTableSeeder::class,
            MenuFoodMaterialTableSeeder::class,
            UserFoodMaterialTableSeeder::class,
        ]);
    }
}