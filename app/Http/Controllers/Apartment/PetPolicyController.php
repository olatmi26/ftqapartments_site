<?php

namespace App\Http\Controllers\Apartment;

use App\Models\Apartment\PetPolicy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\PetPolicyStoreRequest;
use App\Http\Requests\Apartment\PetPolicyUpdateRequest;
use Illuminate\Http\Request;

class PetPolicyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $petPolicies = PetPolicy::all();

        return view('petPolicy.index', compact('petPolicies'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('petPolicy.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Apartment\petPolicy $petPolicy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PetPolicy $petPolicy)
    {
        return view('petPolicy.show', compact('petPolicy'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Apartment\petPolicy $petPolicy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PetPolicy $petPolicy)
    {
        return view('petPolicy.edit', compact('petPolicy'));
    }

    /**
     * @param \App\Http\Requests\Apartment\PetPolicyUpdateRequest $request
     * @param \App\Apartment\petPolicy $petPolicy
     * @return \Illuminate\Http\Response
     */
    public function update(PetPolicyUpdateRequest $request, PetPolicy $petPolicy)
    {
        $petPolicy->update($request->validated());

        $request->session()->flash('petPolicy.id', $petPolicy->id);

        return redirect()->route('petPolicy.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Apartment\petPolicy $petPolicy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PetPolicy $petPolicy)
    {
        $petPolicy->delete();

        return redirect()->route('petPolicy.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\PetPolicyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetPolicyStoreRequest $request)
    {
        $petPolicy = PetPolicy::create($request->validated());

        $request->session()->flash('PetPolicy-added-successively', $PetPolicy - added - successively);

        return redirect()->route('PetPolicy.index');
    }
}