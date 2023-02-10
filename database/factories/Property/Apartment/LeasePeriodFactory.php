<?php

namespace Database\Factories\Property\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Property\Apartment\LeasePeriod;

class LeasePeriodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeasePeriod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'period' => $this->faker->word,
            'amount' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
