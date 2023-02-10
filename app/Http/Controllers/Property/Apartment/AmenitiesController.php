<?php

namespace App\Http\Controllers\Property\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\Apartment\AmenitiesStoreRequest;
use App\Http\Requests\Property\Apartment\AmenitiesUpdateRequest;
use App\Models\Property\Apartment\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $amenities = Amenity::all();

        return view('amenity.index', compact('amenities'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('amenity.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\Amenities $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Amenity $amenity)
    {
        return view('amenity.show', compact('amenity'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\Amenities $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Amenity $amenity)
    {
        return view('amenity.edit', compact('amenity'));
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\AmenitiesUpdateRequest $request
     * @param \App\Models\Property\Apartment\Amenities $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(AmenitiesUpdateRequest $request, Amenity $amenity)
    {
        $amenity->update($request->validated());

        $request->session()->flash('amenity.id', $amenity->id);

        return redirect()->route('amenity.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\Amenities $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Amenity $amenity)
    {
        $amenity->delete();

        return redirect()->route('amenity.index');
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\AmenitiesStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmenitiesStoreRequest $request)
    {
        $amenity = Amenity::create($request->validated());

        $request->session()->flash('amenities-added-successively', $amenities-added-successively);

        return redirect()->route('Apartment.show', ['Apartment' => $Apartment]);
    }
}
