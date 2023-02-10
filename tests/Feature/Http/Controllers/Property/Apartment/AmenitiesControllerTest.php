<?php

namespace Tests\Feature\Http\Controllers\Property\Apartment;

use App\Models\Amenity;
use App\Models\Apartment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Property\Apartment\AmenitiesController
 */
class AmenitiesControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $amenities = Amenities::factory()->count(3)->create();

        $response = $this->get(route('amenity.index'));

        $response->assertOk();
        $response->assertViewIs('amenity.index');
        $response->assertViewHas('amenities');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('amenity.create'));

        $response->assertOk();
        $response->assertViewIs('amenity.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $amenity = Amenities::factory()->create();

        $response = $this->get(route('amenity.show', $amenity));

        $response->assertOk();
        $response->assertViewIs('amenity.show');
        $response->assertViewHas('amenity');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $amenity = Amenities::factory()->create();

        $response = $this->get(route('amenity.edit', $amenity));

        $response->assertOk();
        $response->assertViewIs('amenity.edit');
        $response->assertViewHas('amenity');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\AmenitiesController::class,
            'update',
            \App\Http\Requests\Property\Apartment\AmenitiesUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $amenity = Amenities::factory()->create();

        $response = $this->put(route('amenity.update', $amenity));

        $amenity->refresh();

        $response->assertRedirect(route('amenity.index'));
        $response->assertSessionHas('amenity.id', $amenity->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $amenity = Amenities::factory()->create();
        $amenity = Amenity::factory()->create();

        $response = $this->delete(route('amenity.destroy', $amenity));

        $response->assertRedirect(route('amenity.index'));

        $this->assertModelMissing($amenity);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\AmenitiesController::class,
            'store',
            \App\Http\Requests\Property\Apartment\AmenitiesStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $No_of_bedrooms = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('amenity.store'), [
            'apartment_id' => $apartment->id,
            'No_of_bedrooms' => $No_of_bedrooms,
        ]);

        $amenities = Amenity::query()
            ->where('apartment_id', $apartment->id)
            ->where('No_of_bedrooms', $No_of_bedrooms)
            ->get();
        $this->assertCount(1, $amenities);
        $amenity = $amenities->first();

        $response->assertRedirect(route('Apartment.show', ['Apartment' => $Apartment]));
        $response->assertSessionHas('amenities-added-successively', $amenities-added-successively);
    }
}
