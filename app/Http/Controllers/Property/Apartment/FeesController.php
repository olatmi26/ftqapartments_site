<?php

namespace App\Http\Controllers\Property\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\Apartment\FeesStoreRequest;
use App\Http\Requests\Property\Apartment\FeesUpdateRequest;
use App\Models\Property\Apartment\Fees;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fees = Fee::all();

        return view('fee.index', compact('fees'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('fee.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\Fees $fee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Fee $fee)
    {
        return view('fee.show', compact('fee'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\Fees $fee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Fee $fee)
    {
        return view('fee.edit', compact('fee'));
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\FeesUpdateRequest $request
     * @param \App\Models\Property\Apartment\Fees $fee
     * @return \Illuminate\Http\Response
     */
    public function update(FeesUpdateRequest $request, Fee $fee)
    {
        $fee->update($request->validated());

        $request->session()->flash('fee.id', $fee->id);

        return redirect()->route('fee.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\Fees $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Fee $fee)
    {
        $fee->delete();

        return redirect()->route('fee.index');
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\FeesStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeesStoreRequest $request)
    {
        $fees = Fees::create($request->validated());

        $request->session()->flash('fees-added-successively', $fees-added-successively);

        return redirect()->route('Apartment.index');
    }
}
