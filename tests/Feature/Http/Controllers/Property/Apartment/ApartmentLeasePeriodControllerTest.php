<?php

namespace Tests\Feature\Http\Controllers\Property\Apartment;

use App\Models\Apartment;
use App\Models\ApartmentLeasePeriod;
use App\Models\LeasePeriod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Property\Apartment\ApartmentLeasePeriodController
 */
class ApartmentLeasePeriodControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $apartmentLeasePeriods = ApartmentLeasePeriod::factory()->count(3)->create();

        $response = $this->get(route('apartment-lease-period.index'));

        $response->assertOk();
        $response->assertViewIs('apartmentLeasePeriod.index');
        $response->assertViewHas('apartmentLeasePeriods');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('apartment-lease-period.create'));

        $response->assertOk();
        $response->assertViewIs('apartmentLeasePeriod.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $apartmentLeasePeriod = ApartmentLeasePeriod::factory()->create();

        $response = $this->get(route('apartment-lease-period.show', $apartmentLeasePeriod));

        $response->assertOk();
        $response->assertViewIs('apartmentLeasePeriod.show');
        $response->assertViewHas('apartmentLeasePeriod');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $apartmentLeasePeriod = ApartmentLeasePeriod::factory()->create();

        $response = $this->get(route('apartment-lease-period.edit', $apartmentLeasePeriod));

        $response->assertOk();
        $response->assertViewIs('apartmentLeasePeriod.edit');
        $response->assertViewHas('apartmentLeasePeriod');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\ApartmentLeasePeriodController::class,
            'update',
            \App\Http\Requests\Property\Apartment\ApartmentLeasePeriodUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $apartmentLeasePeriod = ApartmentLeasePeriod::factory()->create();

        $response = $this->put(route('apartment-lease-period.update', $apartmentLeasePeriod));

        $apartmentLeasePeriod->refresh();

        $response->assertRedirect(route('apartmentLeasePeriod.index'));
        $response->assertSessionHas('apartmentLeasePeriod.id', $apartmentLeasePeriod->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $apartmentLeasePeriod = ApartmentLeasePeriod::factory()->create();

        $response = $this->delete(route('apartment-lease-period.destroy', $apartmentLeasePeriod));

        $response->assertRedirect(route('apartmentLeasePeriod.index'));

        $this->assertModelMissing($apartmentLeasePeriod);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\ApartmentLeasePeriodController::class,
            'store',
            \App\Http\Requests\Property\Apartment\ApartmentLeasePeriodStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $lease_period = LeasePeriod::factory()->create();

        $response = $this->post(route('apartment-lease-period.store'), [
            'apartment_id' => $apartment->id,
            'lease_period_id' => $lease_period->id,
        ]);

        $apartmentLeasePeriods = LeasePeriod::query()
            ->where('apartment_id', $apartment->id)
            ->where('lease_period_id', $lease_period->id)
            ->get();
        $this->assertCount(1, $apartmentLeasePeriods);
        $apartmentLeasePeriod = $apartmentLeasePeriods->first();

        $response->assertRedirect(route('ApartmentReview.index'));
        $response->assertSessionHas('leasePeriod-added-successively', $leasePeriod-added-successively);
    }
}
