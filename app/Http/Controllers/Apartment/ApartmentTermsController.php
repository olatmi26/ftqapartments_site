<?php

namespace App\Http\Controllers\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\ApartmentTermsStoreRequest;
use App\Http\Requests\Apartment\ApartmentTermsUpdateRequest;
use App\Models\Apartment\ApartmentTerms;
use Illuminate\Http\Request;

class ApartmentTermsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartmentTerms = ApartmentTerm::all();

        return view('apartmentTerm.index', compact('apartmentTerms'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('apartmentTerm.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentTerms $apartmentTerm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApartmentTerm $apartmentTerm)
    {
        return view('apartmentTerm.show', compact('apartmentTerm'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentTerms $apartmentTerm
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ApartmentTerm $apartmentTerm)
    {
        return view('apartmentTerm.edit', compact('apartmentTerm'));
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentTermsUpdateRequest $request
     * @param \App\Models\Apartment\ApartmentTerms $apartmentTerm
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentTermsUpdateRequest $request, ApartmentTerm $apartmentTerm)
    {
        $apartmentTerm->update($request->validated());

        $request->session()->flash('apartmentTerm.id', $apartmentTerm->id);

        return redirect()->route('apartmentTerm.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentTerms $apartmentTerm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ApartmentTerm $apartmentTerm)
    {
        $apartmentTerm->delete();

        return redirect()->route('apartmentTerm.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentTermsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentTermsStoreRequest $request)
    {
        $apartmentTerms = ApartmentTerms::create($request->validated());

        $request->session()->flash('apartmentTerms-added-successively', $apartmentTerms-added-successively);

        return redirect()->route('ApartmentTerms.index');
    }
}
