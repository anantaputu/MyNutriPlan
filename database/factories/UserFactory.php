<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $genders = ['male', 'female', 'other'];
        $activityLevels = ['sedentary', 'light', 'moderate', 'active', 'very active'];

        return [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 'member', // default 'member'
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'age' => $this->faker->numberBetween(18, 65),
            'gender' => $this->faker->randomElement($genders),
            'activity_level' => $this->faker->randomElement($activityLevels),
            'remember_token' => Str::random(10),
            'height' => $this->faker->randomFloat(2, 140, 200), // cm
            'weight' => $this->faker->randomFloat(2, 45, 120),  // kg
            'medical_history' => $this->faker->optional()->paragraphs(2, true), // beberapa kalimat random atau null
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
