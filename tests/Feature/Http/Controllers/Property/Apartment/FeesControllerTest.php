<?php

namespace Tests\Feature\Http\Controllers\Property\Apartment;

use App\Models\Apartment;
use App\Models\Fee;
use App\Models\Fees;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Property\Apartment\FeesController
 */
class FeesControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $fees = Fees::factory()->count(3)->create();

        $response = $this->get(route('fee.index'));

        $response->assertOk();
        $response->assertViewIs('fee.index');
        $response->assertViewHas('fees');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('fee.create'));

        $response->assertOk();
        $response->assertViewIs('fee.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $fee = Fees::factory()->create();

        $response = $this->get(route('fee.show', $fee));

        $response->assertOk();
        $response->assertViewIs('fee.show');
        $response->assertViewHas('fee');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $fee = Fees::factory()->create();

        $response = $this->get(route('fee.edit', $fee));

        $response->assertOk();
        $response->assertViewIs('fee.edit');
        $response->assertViewHas('fee');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\FeesController::class,
            'update',
            \App\Http\Requests\Property\Apartment\FeesUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $fee = Fees::factory()->create();

        $response = $this->put(route('fee.update', $fee));

        $fee->refresh();

        $response->assertRedirect(route('fee.index'));
        $response->assertSessionHas('fee.id', $fee->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $fee = Fees::factory()->create();
        $fee = Fee::factory()->create();

        $response = $this->delete(route('fee.destroy', $fee));

        $response->assertRedirect(route('fee.index'));

        $this->assertModelMissing($fee);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Property\Apartment\FeesController::class,
            'store',
            \App\Http\Requests\Property\Apartment\FeesStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $other_fees = $this->faker->randomFloat(/** decimal_attributes **/);
        $apartment = Apartment::factory()->create();

        $response = $this->post(route('fee.store'), [
            'other_fees' => $other_fees,
            'apartment_id' => $apartment->id,
        ]);

        $fees = Fees::query()
            ->where('other_fees', $other_fees)
            ->where('apartment_id', $apartment->id)
            ->get();
        $this->assertCount(1, $fees);
        $fee = $fees->first();

        $response->assertRedirect(route('Apartment.index'));
        $response->assertSessionHas('fees-added-successively', $fees-added-successively);
    }
}
