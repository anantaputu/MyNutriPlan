<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Import Hash facade for password hashing

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'fullname' => 'I Putu Ananta Sugiartha',
                'email' => 'sugiartha1000@gmail.com',
                'role' => 'admin',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'), // Use Hash::make() for passwords
                'age' => 22,
                'gender' => 'male',
                'activity_level' => 'Very active',
                'remember_token' => NULL,
                'created_at' => '2025-06-11 16:43:18',
                'updated_at' => '2025-06-11 23:45:00',
                'height' => 169.80,
                'weight' => 68.70,
                'medical_history' => 'Hypertension',
            ],
            [
                'id' => 2,
                'fullname' => 'M. Khalid Al Rejeki',
                'email' => 'kaklepang@gmail.com',
                'role' => 'member',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'), // Use Hash::make() for passwords
                'age' => 20,
                'gender' => 'male',
                'activity_level' => 'Extra active',
                'remember_token' => 'bMT8mEJsiBBSP7MnOnstAgGUVlJeNI0AfgQUioCQt14dCmyFTjL3WqiXeTz4',
                'created_at' => '2025-06-11 16:50:44',
                'updated_at' => '2025-06-12 19:08:36',
                'height' => 170.00,
                'weight' => 100.00,
                'medical_history' => 'Penyakit Wadis 69',
            ],
        ]);
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 5;');
    }
}