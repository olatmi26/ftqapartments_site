<?php

namespace Database\Factories\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Apartment\Booking;
use App\Models\Apartment\Payment;
use App\Models\Property\Apartment;
use App\Models\User;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'booking_id' => Booking::factory(),
            'user_id' => User::factory(),
            'amount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'paymentMethod' => $this->faker->word,
            'ref' => $this->faker->word,
            'status' => $this->faker->boolean,
        ];
    }
}
