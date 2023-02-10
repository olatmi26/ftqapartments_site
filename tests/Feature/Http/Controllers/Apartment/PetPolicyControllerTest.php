<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\PetPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\PetPolicyController
 */
class PetPolicyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $petPolicies = PetPolicy::factory()->count(3)->create();

        $response = $this->get(route('pet-policy.index'));

        $response->assertOk();
        $response->assertViewIs('petPolicy.index');
        $response->assertViewHas('petPolicies');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pet-policy.create'));

        $response->assertOk();
        $response->assertViewIs('petPolicy.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $petPolicy = PetPolicy::factory()->create();

        $response = $this->get(route('pet-policy.show', $petPolicy));

        $response->assertOk();
        $response->assertViewIs('petPolicy.show');
        $response->assertViewHas('petPolicy');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $petPolicy = PetPolicy::factory()->create();

        $response = $this->get(route('pet-policy.edit', $petPolicy));

        $response->assertOk();
        $response->assertViewIs('petPolicy.edit');
        $response->assertViewHas('petPolicy');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\PetPolicyController::class,
            'update',
            \App\Http\Requests\Apartment\PetPolicyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $petPolicy = PetPolicy::factory()->create();

        $response = $this->put(route('pet-policy.update', $petPolicy));

        $petPolicy->refresh();

        $response->assertRedirect(route('petPolicy.index'));
        $response->assertSessionHas('petPolicy.id', $petPolicy->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $petPolicy = PetPolicy::factory()->create();

        $response = $this->delete(route('pet-policy.destroy', $petPolicy));

        $response->assertRedirect(route('petPolicy.index'));

        $this->assertModelMissing($petPolicy);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\PetPolicyController::class,
            'store',
            \App\Http\Requests\Apartment\PetPolicyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('pet-policy.store'));

        $response->assertRedirect(route('PetPolicy.index'));
        $response->assertSessionHas('PetPolicy-added-successively', $PetPolicy-added-successively);

        $this->assertDatabaseHas(petPolicies, [ /* ... */ ]);
    }
}
