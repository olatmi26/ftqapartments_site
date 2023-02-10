<?php

namespace Database\Factories\Property;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Property\Apartment;
use App\Models\State;
use App\Models\User;

class ApartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Apartment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'propertyID' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'category_id' => Category::factory(),
            'state_id' => State::factory(),
            'title' => $this->faker->sentence(4),
            'location' => $this->faker->word,
            'city' => $this->faker->city,
            'nearByCities' => $this->faker->word,
            'number_of_room' => $this->faker->numberBetween(10, 100),
            'pricePerMonth' => $this->faker->randomFloat(6, 0, 9.999999),
            'pricePerYear' => $this->faker->randomFloat(6, 0, 9.999999),
            'description' => $this->faker->text,
            'mapStreetLatitude' => $this->faker->randomFloat(6, 0, 9.999999),
            'mapStreetLongitude' => $this->faker->randomFloat(6, 0, 9.999999),
            'majorBusStop' => $this->faker->word,
            'nearbyBusStop' => $this->faker->word,
            'nearByShoppingMall' => $this->faker->word,
            'availability' => $this->faker->boolean,
            'enteredBy' => User::factory(),
        ];
    }
}