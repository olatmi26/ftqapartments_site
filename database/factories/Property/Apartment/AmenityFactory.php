<?php

namespace Database\Factories\Property\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Property\Apartment;
use App\Models\Property\Apartment\Amenity;

class AmenityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Amenity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'No_of_bedrooms' => $this->faker->numberBetween(1, 10),
            'bath_rooms' => $this->faker->numberBetween(1, 4),
            'square_Feet' => $this->faker->numberBetween(1000, 10000),
        ];
    }
}