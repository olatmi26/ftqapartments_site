<?php

namespace App\Http\Controllers\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\ApartmentRatingStoreRequest;
use App\Http\Requests\Apartment\ApartmentRatingUpdateRequest;
use App\Models\Apartment\ApartmentRating;
use Illuminate\Http\Request;

class ApartmentRatingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartmentRatings = ApartmentRating::all();

        return view('apartmentRating.index', compact('apartmentRatings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('apartmentRating.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentRating $apartmentRating
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApartmentRating $apartmentRating)
    {
        return view('apartmentRating.show', compact('apartmentRating'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentRating $apartmentRating
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ApartmentRating $apartmentRating)
    {
        return view('apartmentRating.edit', compact('apartmentRating'));
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentRatingUpdateRequest $request
     * @param \App\Models\Apartment\ApartmentRating $apartmentRating
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentRatingUpdateRequest $request, ApartmentRating $apartmentRating)
    {
        $apartmentRating->update($request->validated());

        $request->session()->flash('apartmentRating.id', $apartmentRating->id);

        return redirect()->route('apartmentRating.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentRating $apartmentRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ApartmentRating $apartmentRating)
    {
        $apartmentRating->delete();

        return redirect()->route('apartmentRating.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentRatingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentRatingStoreRequest $request)
    {
        $apartmentRating = ApartmentRating::create($request->validated());

        $request->session()->flash('rating-added-successively', $rating-added-successively);

        return redirect()->route('Apartment.index');
    }
}
