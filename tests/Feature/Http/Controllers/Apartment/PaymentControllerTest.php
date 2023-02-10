<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\PaymentController
 */
class PaymentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $payments = Payment::factory()->count(3)->create();

        $response = $this->get(route('payment.index'));

        $response->assertOk();
        $response->assertViewIs('payment.index');
        $response->assertViewHas('payments');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('payment.create'));

        $response->assertOk();
        $response->assertViewIs('payment.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('payment.show', $payment));

        $response->assertOk();
        $response->assertViewIs('payment.show');
        $response->assertViewHas('payment');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('payment.edit', $payment));

        $response->assertOk();
        $response->assertViewIs('payment.edit');
        $response->assertViewHas('payment');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\PaymentController::class,
            'update',
            \App\Http\Requests\Apartment\PaymentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $payment = Payment::factory()->create();

        $response = $this->put(route('payment.update', $payment));

        $payment->refresh();

        $response->assertRedirect(route('payment.index'));
        $response->assertSessionHas('payment.id', $payment->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $payment = Payment::factory()->create();

        $response = $this->delete(route('payment.destroy', $payment));

        $response->assertRedirect(route('payment.index'));

        $this->assertModelMissing($payment);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\PaymentController::class,
            'store',
            \App\Http\Requests\Apartment\PaymentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $booking = Booking::factory()->create();
        $user = User::factory()->create();
        $amount = $this->faker->randomFloat(/** double_attributes **/);
        $ref = $this->faker->word;
        $status = $this->faker->boolean;

        $response = $this->post(route('payment.store'), [
            'apartment_id' => $apartment->id,
            'booking_id' => $booking->id,
            'user_id' => $user->id,
            'amount' => $amount,
            'ref' => $ref,
            'status' => $status,
        ]);

        $payments = Payment::query()
            ->where('apartment_id', $apartment->id)
            ->where('booking_id', $booking->id)
            ->where('user_id', $user->id)
            ->where('amount', $amount)
            ->where('ref', $ref)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $payments);
        $payment = $payments->first();

        $response->assertRedirect(route('Booking.index'));
        $response->assertSessionHas('payment-transaction-successively', $payment-transaction-successively);
    }
}
