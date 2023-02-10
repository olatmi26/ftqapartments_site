<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\ApartmentRating;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\ApartmentRatingController
 */
class ApartmentRatingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $apartmentRatings = ApartmentRating::factory()->count(3)->create();

        $response = $this->get(route('apartment-rating.index'));

        $response->assertOk();
        $response->assertViewIs('apartmentRating.index');
        $response->assertViewHas('apartmentRatings');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('apartment-rating.create'));

        $response->assertOk();
        $response->assertViewIs('apartmentRating.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $apartmentRating = ApartmentRating::factory()->create();

        $response = $this->get(route('apartment-rating.show', $apartmentRating));

        $response->assertOk();
        $response->assertViewIs('apartmentRating.show');
        $response->assertViewHas('apartmentRating');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $apartmentRating = ApartmentRating::factory()->create();

        $response = $this->get(route('apartment-rating.edit', $apartmentRating));

        $response->assertOk();
        $response->assertViewIs('apartmentRating.edit');
        $response->assertViewHas('apartmentRating');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentRatingController::class,
            'update',
            \App\Http\Requests\Apartment\ApartmentRatingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $apartmentRating = ApartmentRating::factory()->create();

        $response = $this->put(route('apartment-rating.update', $apartmentRating));

        $apartmentRating->refresh();

        $response->assertRedirect(route('apartmentRating.index'));
        $response->assertSessionHas('apartmentRating.id', $apartmentRating->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $apartmentRating = ApartmentRating::factory()->create();

        $response = $this->delete(route('apartment-rating.destroy', $apartmentRating));

        $response->assertRedirect(route('apartmentRating.index'));

        $this->assertModelMissing($apartmentRating);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentRatingController::class,
            'store',
            \App\Http\Requests\Apartment\ApartmentRatingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $rating = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('apartment-rating.store'), [
            'apartment_id' => $apartment->id,
            'rating' => $rating,
        ]);

        $apartmentRatings = ApartmentRating::query()
            ->where('apartment_id', $apartment->id)
            ->where('rating', $rating)
            ->get();
        $this->assertCount(1, $apartmentRatings);
        $apartmentRating = $apartmentRatings->first();

        $response->assertRedirect(route('Apartment.index'));
        $response->assertSessionHas('rating-added-successively', $rating-added-successively);
    }
}
