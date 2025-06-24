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
        // Panggil seeder-seeder lain di bawah ini
        $this->call([
            ArticleSeeder::class,
            FoodMaterialSeeder::class,
            MenuSeeder::class,
            // Jika ada seeder lain, tambahkan di sini
        ]);
    }
}
