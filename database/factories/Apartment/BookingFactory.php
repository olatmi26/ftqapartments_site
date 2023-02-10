<?php

namespace Database\Factories\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Apartment\Booking;
use App\Models\Apartment\Cart;
use App\Models\Property\Apartment;
use App\Models\User;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

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
            'cart_id' => Cart::factory(),
            'dateNeeded' => $this->faker->date(),
            'dateToArrive' => $this->faker->date(),
            'dateToParkin' => $this->faker->date(),
            'AcceptingTerms' => $this->faker->boolean,
            'amountPaid' => $this->faker->randomFloat(2, 0, 999999.99),
            'status' => $this->faker->boolean,
        ];
    }
}
