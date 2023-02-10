<?php

namespace App\Http\Controllers\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\PropertyImageStoreRequest;
use App\Http\Requests\Apartment\PropertyImageUpdateRequest;
use App\Models\Apartment\PropertyImage;
use Illuminate\Http\Request;

class PropertyImageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $propertyImages = PropertyImage::all();

        return view('propertyImage.index', compact('propertyImages'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('propertyImage.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\PropertyImage $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PropertyImage $propertyImage)
    {
        return view('propertyImage.show', compact('propertyImage'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\PropertyImage $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PropertyImage $propertyImage)
    {
        return view('propertyImage.edit', compact('propertyImage'));
    }

    /**
     * @param \App\Http\Requests\Apartment\PropertyImageUpdateRequest $request
     * @param \App\Models\Apartment\PropertyImage $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyImageUpdateRequest $request, PropertyImage $propertyImage)
    {
        $propertyImage->update($request->validated());

        $request->session()->flash('propertyImage.id', $propertyImage->id);

        return redirect()->route('propertyImage.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\PropertyImage $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PropertyImage $propertyImage)
    {
        $propertyImage->delete();

        return redirect()->route('propertyImage.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\PropertyImageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyImageStoreRequest $request)
    {
        $propertyImage = PropertyImage::create($request->validated());

        $request->session()->flash('propertyImage-added-successively', $propertyImage-added-successively);

        return redirect()->route('ApartmentReview.index');
    }
}
