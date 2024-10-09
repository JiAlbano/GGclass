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
    /**
     * The current password being used by the factory.
     */
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Default password for testing
            'user_type' => $this->faker->randomElement(['student', 'teacher']), // Randomly assign user type
            'id_number' => $this->faker->unique()->numerify('######'), // 6-digit unique ID number

            'course_id' => \App\Models\Course::inRandomOrder()->first()->id, // Random course ID
     
            'google_id' => $this->faker->unique()->numerify('##########'), // Simulate Google ID
            'google_access_token' => Str::random(40), // Generate a random Google access token
            'google_profile_image' => $this->faker->imageUrl(), // Simulate a Google profile image URL
            'remember_token' => Str::random(10), // Laravel's built-in remember token
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
