<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\ApartmentPetPolicy;
use App\Models\PetPolicies;
use App\Models\PetPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\ApartmentPetPolicyController
 */
class ApartmentPetPolicyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $apartmentPetPolicies = ApartmentPetPolicy::factory()->count(3)->create();

        $response = $this->get(route('apartment-pet-policy.index'));

        $response->assertOk();
        $response->assertViewIs('apartmentPetPolicy.index');
        $response->assertViewHas('apartmentPetPolicies');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('apartment-pet-policy.create'));

        $response->assertOk();
        $response->assertViewIs('apartmentPetPolicy.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $apartmentPetPolicy = ApartmentPetPolicy::factory()->create();

        $response = $this->get(route('apartment-pet-policy.show', $apartmentPetPolicy));

        $response->assertOk();
        $response->assertViewIs('apartmentPetPolicy.show');
        $response->assertViewHas('apartmentPetPolicy');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $apartmentPetPolicy = ApartmentPetPolicy::factory()->create();

        $response = $this->get(route('apartment-pet-policy.edit', $apartmentPetPolicy));

        $response->assertOk();
        $response->assertViewIs('apartmentPetPolicy.edit');
        $response->assertViewHas('apartmentPetPolicy');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentPetPolicyController::class,
            'update',
            \App\Http\Requests\Apartment\ApartmentPetPolicyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $apartmentPetPolicy = ApartmentPetPolicy::factory()->create();

        $response = $this->put(route('apartment-pet-policy.update', $apartmentPetPolicy));

        $apartmentPetPolicy->refresh();

        $response->assertRedirect(route('apartmentPetPolicy.index'));
        $response->assertSessionHas('apartmentPetPolicy.id', $apartmentPetPolicy->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $apartmentPetPolicy = ApartmentPetPolicy::factory()->create();

        $response = $this->delete(route('apartment-pet-policy.destroy', $apartmentPetPolicy));

        $response->assertRedirect(route('apartmentPetPolicy.index'));

        $this->assertModelMissing($apartmentPetPolicy);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentPetPolicyController::class,
            'store',
            \App\Http\Requests\Apartment\ApartmentPetPolicyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $pet_policies = PetPolicies::factory()->create();

        $response = $this->post(route('apartment-pet-policy.store'), [
            'apartment_id' => $apartment->id,
            'pet_policies_id' => $pet_policies->id,
        ]);

        $apartmentPetPolicies = PetPolicy::query()
            ->where('apartment_id', $apartment->id)
            ->where('pet_policies_id', $pet_policies->id)
            ->get();
        $this->assertCount(1, $apartmentPetPolicies);
        $apartmentPetPolicy = $apartmentPetPolicies->first();

        $response->assertRedirect(route('Apartment.index'));
        $response->assertSessionHas('petPolicy-added-successively', $petPolicy-added-successively);
    }
}
