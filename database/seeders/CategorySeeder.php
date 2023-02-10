<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            'Senior Apartments',
            'Short-Term Housing',
            'Luxury Apartments',
            'Cheap Apartments',
            'Duplex Apartments',
            'Room Self Contain',
            'Co Working Space',
            'Commercial Property',
            'Flats Apartments',
            'Mini Flats Apartments',
            '1 Bedroom Apartments',
            '2 Bedroom Apartments',
            '3 Bedroom Apartments',
            '4 Bedroom Apartments',
            '5 Bedroom Apartments',
            '6 Bedroom Apartments'
        ];
        foreach ($cats as $key => $value) {
            Category::create(['category' => $value]);
        }
        // Category::factory()->count(5)->create();
    }
}