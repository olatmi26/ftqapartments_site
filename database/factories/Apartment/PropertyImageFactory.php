<?php

namespace Database\Factories\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Apartment\PropertyImage;
use App\Models\Property\Apartment;

class PropertyImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropertyImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'image_url' => $this->faker->word,
            'imageName' => $this->faker->word,
            'isFeatured' => $this->faker->boolean,
        ];
    }
}
