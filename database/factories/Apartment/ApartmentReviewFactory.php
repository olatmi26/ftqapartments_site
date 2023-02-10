<?php

namespace Database\Factories\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Apartment\ApartmentReview;
use App\Models\Property\Apartment;
use App\Models\User;

class ApartmentReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApartmentReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'reviewer' => User::factory(),
            'review' => $this->faker->text,
            'satisfaction' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
