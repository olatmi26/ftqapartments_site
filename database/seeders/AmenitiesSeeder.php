<?php

namespace Database\Seeders;

use App\Models\Property\Apartment\Amenity;
use Illuminate\Database\Seeder;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Amenity::factory()->count(5)->create();
    }
}