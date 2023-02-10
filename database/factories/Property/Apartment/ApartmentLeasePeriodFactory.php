<?php

namespace Database\Factories\Property\Apartment;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Property\Apartment;
use App\Models\Property\Apartment\ApartmentLeasePeriod;
use App\Models\Property\Apartment\LeasePeriod;

class ApartmentLeasePeriodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApartmentLeasePeriod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apartment_id' => Apartment::factory(),
            'lease_period_id' => LeasePeriod::factory(),
        ];
    }
}
