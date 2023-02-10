<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\ApartmentTerm;
use App\Models\ApartmentTerms;
use App\Models\Terms;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\ApartmentTermsController
 */
class ApartmentTermsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $apartmentTerms = ApartmentTerms::factory()->count(3)->create();

        $response = $this->get(route('apartment-term.index'));

        $response->assertOk();
        $response->assertViewIs('apartmentTerm.index');
        $response->assertViewHas('apartmentTerms');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('apartment-term.create'));

        $response->assertOk();
        $response->assertViewIs('apartmentTerm.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $apartmentTerm = ApartmentTerms::factory()->create();

        $response = $this->get(route('apartment-term.show', $apartmentTerm));

        $response->assertOk();
        $response->assertViewIs('apartmentTerm.show');
        $response->assertViewHas('apartmentTerm');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $apartmentTerm = ApartmentTerms::factory()->create();

        $response = $this->get(route('apartment-term.edit', $apartmentTerm));

        $response->assertOk();
        $response->assertViewIs('apartmentTerm.edit');
        $response->assertViewHas('apartmentTerm');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentTermsController::class,
            'update',
            \App\Http\Requests\Apartment\ApartmentTermsUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $apartmentTerm = ApartmentTerms::factory()->create();

        $response = $this->put(route('apartment-term.update', $apartmentTerm));

        $apartmentTerm->refresh();

        $response->assertRedirect(route('apartmentTerm.index'));
        $response->assertSessionHas('apartmentTerm.id', $apartmentTerm->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $apartmentTerm = ApartmentTerms::factory()->create();
        $apartmentTerm = ApartmentTerm::factory()->create();

        $response = $this->delete(route('apartment-term.destroy', $apartmentTerm));

        $response->assertRedirect(route('apartmentTerm.index'));

        $this->assertModelMissing($apartmentTerm);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\ApartmentTermsController::class,
            'store',
            \App\Http\Requests\Apartment\ApartmentTermsStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $terms = Terms::factory()->create();

        $response = $this->post(route('apartment-term.store'), [
            'apartment_id' => $apartment->id,
            'terms_id' => $terms->id,
        ]);

        $apartmentTerms = ApartmentTerms::query()
            ->where('apartment_id', $apartment->id)
            ->where('terms_id', $terms->id)
            ->get();
        $this->assertCount(1, $apartmentTerms);
        $apartmentTerm = $apartmentTerms->first();

        $response->assertRedirect(route('ApartmentTerms.index'));
        $response->assertSessionHas('apartmentTerms-added-successively', $apartmentTerms-added-successively);
    }
}
