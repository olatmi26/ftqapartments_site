<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Apartment;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\CartController
 */
class CartControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $carts = Cart::factory()->count(3)->create();

        $response = $this->get(route('cart.index'));

        $response->assertOk();
        $response->assertViewIs('cart.index');
        $response->assertViewHas('carts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('cart.create'));

        $response->assertOk();
        $response->assertViewIs('cart.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $cart = Cart::factory()->create();

        $response = $this->get(route('cart.show', $cart));

        $response->assertOk();
        $response->assertViewIs('cart.show');
        $response->assertViewHas('cart');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $cart = Cart::factory()->create();

        $response = $this->get(route('cart.edit', $cart));

        $response->assertOk();
        $response->assertViewIs('cart.edit');
        $response->assertViewHas('cart');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\CartController::class,
            'update',
            \App\Http\Requests\Apartment\CartUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $cart = Cart::factory()->create();

        $response = $this->put(route('cart.update', $cart));

        $cart->refresh();

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('cart.id', $cart->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $cart = Cart::factory()->create();

        $response = $this->delete(route('cart.destroy', $cart));

        $response->assertRedirect(route('cart.index'));

        $this->assertModelMissing($cart);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\CartController::class,
            'store',
            \App\Http\Requests\Apartment\CartStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $apartment = Apartment::factory()->create();
        $user = User::factory()->create();
        $dateNeeded = $this->faker->date();

        $response = $this->post(route('cart.store'), [
            'apartment_id' => $apartment->id,
            'user_id' => $user->id,
            'dateNeeded' => $dateNeeded,
        ]);

        $carts = Cart::query()
            ->where('apartment_id', $apartment->id)
            ->where('user_id', $user->id)
            ->where('dateNeeded', $dateNeeded)
            ->get();
        $this->assertCount(1, $carts);
        $cart = $carts->first();

        $response->assertRedirect(route('Apartment.index'));
        $response->assertSessionHas('apartment-added-to-cart-successively', $apartment-added-to-cart-successively);
    }
}
