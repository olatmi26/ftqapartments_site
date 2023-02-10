<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\BookingController
 */
class BookingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bookings = Booking::factory()->count(3)->create();

        $response = $this->get(route('booking.index'));

        $response->assertOk();
        $response->assertViewIs('booking.index');
        $response->assertViewHas('bookings');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('booking.create'));

        $response->assertOk();
        $response->assertViewIs('booking.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('booking.show', $booking));

        $response->assertOk();
        $response->assertViewIs('booking.show');
        $response->assertViewHas('booking');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('booking.edit', $booking));

        $response->assertOk();
        $response->assertViewIs('booking.edit');
        $response->assertViewHas('booking');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\BookingController::class,
            'update',
            \App\Http\Requests\Apartment\BookingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $booking = Booking::factory()->create();

        $response = $this->put(route('booking.update', $booking));

        $booking->refresh();

        $response->assertRedirect(route('booking.index'));
        $response->assertSessionHas('booking.id', $booking->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $booking = Booking::factory()->create();

        $response = $this->delete(route('booking.destroy', $booking));

        $response->assertRedirect(route('booking.index'));

        $this->assertModelMissing($booking);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\BookingController::class,
            'store',
            \App\Http\Requests\Apartment\BookingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $user = User::factory()->create();
        $cart = Cart::factory()->create();
        $dateNeeded = $this->faker->date();
        $AcceptingTerms = $this->faker->boolean;
        $amountPaid = $this->faker->randomFloat(/** double_attributes **/);
        $status = $this->faker->boolean;

        $response = $this->post(route('booking.store'), [
            'apartment_id' => $apartment->id,
            'user_id' => $user->id,
            'cart_id' => $cart->id,
            'dateNeeded' => $dateNeeded,
            'AcceptingTerms' => $AcceptingTerms,
            'amountPaid' => $amountPaid,
            'status' => $status,
        ]);

        $bookings = Booking::query()
            ->where('apartment_id', $apartment->id)
            ->where('user_id', $user->id)
            ->where('cart_id', $cart->id)
            ->where('dateNeeded', $dateNeeded)
            ->where('AcceptingTerms', $AcceptingTerms)
            ->where('amountPaid', $amountPaid)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $bookings);
        $booking = $bookings->first();

        $response->assertRedirect(route('Booking.index'));
        $response->assertSessionHas('booking-added-successively', $booking-added-successively);
    }
}
