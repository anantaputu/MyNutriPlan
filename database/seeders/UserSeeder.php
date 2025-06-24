<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname' => 'Admin Nutriplan',
            'email' => 'admin@nutriplan.test',
            'password' => Hash::make('admin123'), // Ganti sesuai keamanan yang diinginkan
            'role' => 'admin',
            'age' => 30,
            'gender' => 'male',
            'activity_level' => 'moderate',
            'height' => 175.00,
            'weight' => 70.00,
            'medical_history' => 'No known conditions',
            'email_verified_at' => now(),
        ]);
    }
}
