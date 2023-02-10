<?php

namespace Database\Seeders;

use App\Models\Property\Apartment\LeasePeriod;
use Illuminate\Database\Seeder;

class LeasePeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeasePeriod::factory()->count(5)->create();
    }
}
