<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\ApartmentStoreRequest;
use App\Http\Requests\Property\ApartmentUpdateRequest;
use App\Models\Property\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartments = Apartment::all();

        return view('apartment.index', compact('apartments'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('apartment.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Apartment $apartment)
    {
        return view('apartment.show', compact('apartment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Apartment $apartment)
    {
        return view('apartment.edit', compact('apartment'));
    }

    /**
     * @param \App\Http\Requests\Property\ApartmentUpdateRequest $request
     * @param \App\Models\Property\Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentUpdateRequest $request, Apartment $apartment)
    {
        $apartment->update($request->validated());

        $request->session()->flash('apartment.id', $apartment->id);

        return redirect()->route('apartment.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('apartment.index');
    }

    /**
     * @param \App\Http\Requests\Property\ApartmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentStoreRequest $request)
    {
        $apartment = Apartment::create($request->validated());

        $request->session()->flash('apartment-added-successively', $apartment-added-successively);

        return redirect()->route('Apartment.index');
    }
}
