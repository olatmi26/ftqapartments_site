<?php

namespace Database\Factories\Property\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Property\Apartment;
use App\Models\Property\Apartment\Fees;

class FeesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fees::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'other_fees' => $this->faker->randomFloat(5, 0, 99.99999),
            'apartment_id' => Apartment::factory(),
        ];
    }
}
