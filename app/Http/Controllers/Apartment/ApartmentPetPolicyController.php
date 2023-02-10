<?php

namespace App\Http\Controllers\Apartment;

use App\Apartment\PetPolicy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\ApartmentPetPolicyStoreRequest;
use App\Http\Requests\Apartment\ApartmentPetPolicyUpdateRequest;
use App\Models\Apartment\ApartmentPetPolicy;
use Illuminate\Http\Request;

class ApartmentPetPolicyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartmentPetPolicies = ApartmentPetPolicy::all();

        return view('apartmentPetPolicy.index', compact('apartmentPetPolicies'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('apartmentPetPolicy.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentPetPolicy $apartmentPetPolicy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApartmentPetPolicy $apartmentPetPolicy)
    {
        return view('apartmentPetPolicy.show', compact('apartmentPetPolicy'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentPetPolicy $apartmentPetPolicy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ApartmentPetPolicy $apartmentPetPolicy)
    {
        return view('apartmentPetPolicy.edit', compact('apartmentPetPolicy'));
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentPetPolicyUpdateRequest $request
     * @param \App\Models\Apartment\ApartmentPetPolicy $apartmentPetPolicy
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentPetPolicyUpdateRequest $request, ApartmentPetPolicy $apartmentPetPolicy)
    {
        $apartmentPetPolicy->update($request->validated());

        $request->session()->flash('apartmentPetPolicy.id', $apartmentPetPolicy->id);

        return redirect()->route('apartmentPetPolicy.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\ApartmentPetPolicy $apartmentPetPolicy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ApartmentPetPolicy $apartmentPetPolicy)
    {
        $apartmentPetPolicy->delete();

        return redirect()->route('apartmentPetPolicy.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\ApartmentPetPolicyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentPetPolicyStoreRequest $request)
    {
        $petPolicy = PetPolicy::create($request->validated());

        $request->session()->flash('petPolicy-added-successively', $petPolicy-added-successively);

        return redirect()->route('Apartment.index');
    }
}
