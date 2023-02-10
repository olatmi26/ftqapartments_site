<?php

namespace Tests\Feature\Http\Controllers\Property;

use App\Models\Apartment;
use App\Models\Category;
use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Property\ApartmentController
 */
class ApartmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $apartments = Apartment::factory()->count(3)->create();

        $response = $this->get(route('apartment.index'));

        $response->assertOk();
        $response->assertViewIs('apartment.index');
        $response->assertViewHas('apartments');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('apartment.create'));

        $response->assertOk();
        $response->assertViewIs('apartment.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $apartment = Apartment::factory()->create();

        $response = $this->get(route('apartment.show', $apartment));

        $response->assertOk();
        $response->assertViewIs('apartment.show');
        $response->assertViewHas('apartment');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $apartment = Apartment::factory()->create();

        $response = $this->get(route('apartment.edit', $apartment));

        $response->assertOk();
        $response->assertViewIs('apartment.edit');
        $response->assertViewHas('apartment');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\ApartmentController::class,
            'update',
            \App\Http\Requests\Property\ApartmentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $apartment = Apartment::factory()->create();

        $response = $this->put(route('apartment.update', $apartment));

        $apartment->refresh();

        $response->assertRedirect(route('apartment.index'));
        $response->assertSessionHas('apartment.id', $apartment->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $apartment = Apartment::factory()->create();

        $response = $this->delete(route('apartment.destroy', $apartment));

        $response->assertRedirect(route('apartment.index'));

        $this->assertModelMissing($apartment);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\ApartmentController::class,
            'store',
            \App\Http\Requests\Property\ApartmentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $category = Category::factory()->create();
        $title = $this->faker->sentence(4);
        $location = $this->faker->word;
        $city = $this->faker->city;
        $description = $this->faker->text;
        $state = State::factory()->create();
        $availability = $this->faker->boolean;

        $response = $this->post(route('apartment.store'), [
            'category_id' => $category->id,
            'title' => $title,
            'location' => $location,
            'city' => $city,
            'description' => $description,
            'state_id' => $state->id,
            'availability' => $availability,
        ]);

        $apartments = Apartment::query()
            ->where('category_id', $category->id)
            ->where('title', $title)
            ->where('location', $location)
            ->where('city', $city)
            ->where('description', $description)
            ->where('state_id', $state->id)
            ->where('availability', $availability)
            ->get();
        $this->assertCount(1, $apartments);
        $apartment = $apartments->first();

        $response->assertRedirect(route('Apartment.index'));
        $response->assertSessionHas('apartment-added-successively', $apartment-added-successively);
    }
}
