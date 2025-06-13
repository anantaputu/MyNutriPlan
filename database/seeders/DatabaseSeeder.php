<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // You can call other seeders here if needed
        // $this->call(OtherSeeder::class);
        // Or you can use the command line to run specific seeders
        // php artisan db:seed --class=OtherSeeder
        // For example, to seed roles and permissions, you might call:
        // $this->call(RoleSeeder::class);
        // If you have a seeder for roles and permissions, you can uncomment the line below
        // $this->call(RolePermissionSeeder::class);
    }
}
