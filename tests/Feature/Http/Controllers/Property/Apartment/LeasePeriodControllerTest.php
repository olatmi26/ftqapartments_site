<?php

namespace Tests\Feature\Http\Controllers\Property\Apartment;

use App\Models\LeasePeriod;
use App\Models\Period;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Property\Apartment\LeasePeriodController
 */
class LeasePeriodControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $leasePeriods = LeasePeriod::factory()->count(3)->create();

        $response = $this->get(route('lease-period.index'));

        $response->assertOk();
        $response->assertViewIs('leasePeriod.index');
        $response->assertViewHas('leasePeriods');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('lease-period.create'));

        $response->assertOk();
        $response->assertViewIs('leasePeriod.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $leasePeriod = LeasePeriod::factory()->create();

        $response = $this->get(route('lease-period.show', $leasePeriod));

        $response->assertOk();
        $response->assertViewIs('leasePeriod.show');
        $response->assertViewHas('leasePeriod');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $leasePeriod = LeasePeriod::factory()->create();

        $response = $this->get(route('lease-period.edit', $leasePeriod));

        $response->assertOk();
        $response->assertViewIs('leasePeriod.edit');
        $response->assertViewHas('leasePeriod');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\LeasePeriodController::class,
            'update',
            \App\Http\Requests\Property\Apartment\LeasePeriodUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $leasePeriod = LeasePeriod::factory()->create();

        $response = $this->put(route('lease-period.update', $leasePeriod));

        $leasePeriod->refresh();

        $response->assertRedirect(route('leasePeriod.index'));
        $response->assertSessionHas('leasePeriod.id', $leasePeriod->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $leasePeriod = LeasePeriod::factory()->create();

        $response = $this->delete(route('lease-period.destroy', $leasePeriod));

        $response->assertRedirect(route('leasePeriod.index'));

        $this->assertModelMissing($leasePeriod);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\LeasePeriodController::class,
            'store',
            \App\Http\Requests\Property\Apartment\LeasePeriodStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('lease-period.store'));

        $response->assertRedirect(route('ApartmentReview.index'));
        $response->assertSessionHas('period-added-successively', $period-added-successively);

        $this->assertDatabaseHas(periods, [ /* ... */ ]);
    }
}
