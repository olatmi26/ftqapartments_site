<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserInfo;

class UserInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $num = ['080', '081', '070', '090', '091'];
        $rel = ['Elder Brother', 'Younger sister', 'Uncle', 'Mother', 'Father', 'niche', 'nephew', 'friend', 'twin sister', 'Uncle', 'Co-worker'];

        return [
            'user_id' => User::where('role', 'customer')->get()->random()->id,
            'nextOfKin_fullName' => fake()->name($gender =  'male' | 'female'),
            'relationshipWithYou' => $rel[array_rand($rel, 1)],
            'nextOfKin_phoneN0' => $num[array_rand($num, 1)] . $this->faker->numerify('########'),
            'nextOfKin_email' => fake()->unique()->safeEmail(),
            'nextOfKin_address' => $this->faker->address,
        ];
    }
}