<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $num = ['080', '081', '070', '090', '091'];
        $num2 = ['M', 'F'];
        $role = ['customer', 'admin', 'super-admin', 'agent', 'property owner', 'manager', 'accountant', 'marketer'];
        return [
            'username' => fake()->userName,
            'firstName' => fake()->firstName($gender =  'male' | 'female'),
            'middleName' => fake()->lastName($gender =  'male' | 'female'),
            'surName' => fake()->firstName($gender =  'male'),
            'contactPhone' => $num[array_rand($num, 1)] . $this->faker->numerify('########'),
            'gender' => $num2[array_rand($num2, 1)],
            'role' => $role[array_rand($role, 1)],
            'email' => fake()->unique()->safeEmail(),
            'currentAddress' => fake()->address,
            'password' => Hash::make('password@2023'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}