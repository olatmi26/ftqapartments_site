<?php

namespace Database\Factories\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Apartment\ApartmentPetPolicy;
use App\Models\Apartment\PetPolicy;
use App\Models\Property\Apartment;

class ApartmentPetPolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApartmentPetPolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'pet_policies_id' => PetPolicy::factory(),
        ];
    }
}
