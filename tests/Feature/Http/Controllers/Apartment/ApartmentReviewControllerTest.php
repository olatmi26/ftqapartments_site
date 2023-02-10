<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\ApartmentReview;
use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\ApartmentReviewController
 */
class ApartmentReviewControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $apartmentReviews = ApartmentReview::factory()->count(3)->create();

        $response = $this->get(route('apartment-review.index'));

        $response->assertOk();
        $response->assertViewIs('apartmentReview.index');
        $response->assertViewHas('apartmentReviews');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('apartment-review.create'));

        $response->assertOk();
        $response->assertViewIs('apartmentReview.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $apartmentReview = ApartmentReview::factory()->create();

        $response = $this->get(route('apartment-review.show', $apartmentReview));

        $response->assertOk();
        $response->assertViewIs('apartmentReview.show');
        $response->assertViewHas('apartmentReview');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $apartmentReview = ApartmentReview::factory()->create();

        $response = $this->get(route('apartment-review.edit', $apartmentReview));

        $response->assertOk();
        $response->assertViewIs('apartmentReview.edit');
        $response->assertViewHas('apartmentReview');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentReviewController::class,
            'update',
            \App\Http\Requests\Apartment\ApartmentReviewUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $apartmentReview = ApartmentReview::factory()->create();

        $response = $this->put(route('apartment-review.update', $apartmentReview));

        $apartmentReview->refresh();

        $response->assertRedirect(route('apartmentReview.index'));
        $response->assertSessionHas('apartmentReview.id', $apartmentReview->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $apartmentReview = ApartmentReview::factory()->create();

        $response = $this->delete(route('apartment-review.destroy', $apartmentReview));

        $response->assertRedirect(route('apartmentReview.index'));

        $this->assertModelMissing($apartmentReview);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentReviewController::class,
            'store',
            \App\Http\Requests\Apartment\ApartmentReviewStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $reviewer = Reviewer::factory()->create();
        $review = $this->faker->text;

        $response = $this->post(route('apartment-review.store'), [
            'apartment_id' => $apartment->id,
            'reviewer' => $reviewer->id,
            'review' => $review,
        ]);

        $apartmentReviews = Review::query()
            ->where('apartment_id', $apartment->id)
            ->where('reviewer', $reviewer->id)
            ->where('review', $review)
            ->get();
        $this->assertCount(1, $apartmentReviews);
        $apartmentReview = $apartmentReviews->first();

        $response->assertRedirect(route('ApartmentReview.index'));
        $response->assertSessionHas('review-added-successively', $review-added-successively);
    }
}
