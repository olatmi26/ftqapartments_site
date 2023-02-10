<?php

namespace Database\Factories\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Apartment\ApartmentRating;
use App\Models\Property\Apartment;
use App\Models\User;

class ApartmentRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApartmentRating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'rater' => User::factory(),
            'rating' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
