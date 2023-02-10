<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\PropertyImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\PropertyImageController
 */
class PropertyImageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $propertyImages = PropertyImage::factory()->count(3)->create();

        $response = $this->get(route('property-image.index'));

        $response->assertOk();
        $response->assertViewIs('propertyImage.index');
        $response->assertViewHas('propertyImages');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('property-image.create'));

        $response->assertOk();
        $response->assertViewIs('propertyImage.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $propertyImage = PropertyImage::factory()->create();

        $response = $this->get(route('property-image.show', $propertyImage));

        $response->assertOk();
        $response->assertViewIs('propertyImage.show');
        $response->assertViewHas('propertyImage');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $propertyImage = PropertyImage::factory()->create();

        $response = $this->get(route('property-image.edit', $propertyImage));

        $response->assertOk();
        $response->assertViewIs('propertyImage.edit');
        $response->assertViewHas('propertyImage');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\PropertyImageController::class,
            'update',
            \App\Http\Requests\Apartment\PropertyImageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $propertyImage = PropertyImage::factory()->create();

        $response = $this->put(route('property-image.update', $propertyImage));

        $propertyImage->refresh();

        $response->assertRedirect(route('propertyImage.index'));
        $response->assertSessionHas('propertyImage.id', $propertyImage->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $propertyImage = PropertyImage::factory()->create();

        $response = $this->delete(route('property-image.destroy', $propertyImage));

        $response->assertRedirect(route('propertyImage.index'));

        $this->assertModelMissing($propertyImage);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\PropertyImageController::class,
            'store',
            \App\Http\Requests\Apartment\PropertyImageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $image_url = $this->faker->word;
        $imageName = $this->faker->word;
        $isFeatured = $this->faker->boolean;

        $response = $this->post(route('property-image.store'), [
            'apartment_id' => $apartment->id,
            'image_url' => $image_url,
            'imageName' => $imageName,
            'isFeatured' => $isFeatured,
        ]);

        $propertyImages = PropertyImage::query()
            ->where('apartment_id', $apartment->id)
            ->where('image_url', $image_url)
            ->where('imageName', $imageName)
            ->where('isFeatured', $isFeatured)
            ->get();
        $this->assertCount(1, $propertyImages);
        $propertyImage = $propertyImages->first();

        $response->assertRedirect(route('ApartmentReview.index'));
        $response->assertSessionHas('propertyImage-added-successively', $propertyImage-added-successively);
    }
}
