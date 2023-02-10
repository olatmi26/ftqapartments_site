<?php

namespace App\Http\Controllers\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\CartStoreRequest;
use App\Http\Requests\Apartment\CartUpdateRequest;
use App\Models\Apartment\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carts = Cart::all();

        return view('cart.index', compact('carts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('cart.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cart $cart)
    {
        return view('cart.show', compact('cart'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Cart $cart)
    {
        return view('cart.edit', compact('cart'));
    }

    /**
     * @param \App\Http\Requests\Apartment\CartUpdateRequest $request
     * @param \App\Models\Apartment\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function update(CartUpdateRequest $request, Cart $cart)
    {
        $cart->update($request->validated());

        $request->session()->flash('cart.id', $cart->id);

        return redirect()->route('cart.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\CartStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartStoreRequest $request)
    {
        $cart = Cart::create($request->validated());

        $request->session()->flash('apartment-added-to-cart-successively', $apartment-added-to-cart-successively);

        return redirect()->route('Apartment.index');
    }
}
