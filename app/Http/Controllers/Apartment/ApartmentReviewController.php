<?php

namespace App\Http\Controllers\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\ApartmentReviewStoreRequest;
use App\Http\Requests\Apartment\ApartmentReviewUpdateRequest;
use App\Models\Apartment\ApartmentReview;
use Illuminate\Http\Request;

class ApartmentReviewController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartmentReviews = ApartmentReview::all();

        return view('apartmentReview.index', compact('apartmentReviews'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('apartmentReview.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentReview $apartmentReview
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApartmentReview $apartmentReview)
    {
        return view('apartmentReview.show', compact('apartmentReview'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentReview $apartmentReview
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ApartmentReview $apartmentReview)
    {
        return view('apartmentReview.edit', compact('apartmentReview'));
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentReviewUpdateRequest $request
     * @param \App\Models\Apartment\ApartmentReview $apartmentReview
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentReviewUpdateRequest $request, ApartmentReview $apartmentReview)
    {
        $apartmentReview->update($request->validated());

        $request->session()->flash('apartmentReview.id', $apartmentReview->id);

        return redirect()->route('apartmentReview.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentReview $apartmentReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ApartmentReview $apartmentReview)
    {
        $apartmentReview->delete();

        return redirect()->route('apartmentReview.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentReviewStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentReviewStoreRequest $request)
    {
        $review = Review::create($request->validated());

        $request->session()->flash('review-added-successively', $review-added-successively);

        return redirect()->route('ApartmentReview.index');
    }
}
