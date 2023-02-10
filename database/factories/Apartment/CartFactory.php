<?php

namespace Database\Factories\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Apartment\Cart;
use App\Models\Property\Apartment;
use App\Models\User;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'user_id' => User::factory(),
            'dateNeeded' => $this->faker->date(),
        ];
    }
}
