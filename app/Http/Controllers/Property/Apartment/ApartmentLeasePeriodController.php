<?php

namespace App\Http\Controllers\Property\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\Apartment\ApartmentLeasePeriodStoreRequest;
use App\Http\Requests\Property\Apartment\ApartmentLeasePeriodUpdateRequest;
use App\Models\Property\Apartment\ApartmentLeasePeriod;
use App\Property\Apartment\LeasePeriod;
use Illuminate\Http\Request;

class ApartmentLeasePeriodController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartmentLeasePeriods = ApartmentLeasePeriod::all();

        return view('apartmentLeasePeriod.index', compact('apartmentLeasePeriods'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('apartmentLeasePeriod.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\ApartmentLeasePeriod $apartmentLeasePeriod
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ApartmentLeasePeriod $apartmentLeasePeriod)
    {
        return view('apartmentLeasePeriod.show', compact('apartmentLeasePeriod'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\ApartmentLeasePeriod $apartmentLeasePeriod
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ApartmentLeasePeriod $apartmentLeasePeriod)
    {
        return view('apartmentLeasePeriod.edit', compact('apartmentLeasePeriod'));
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\ApartmentLeasePeriodUpdateRequest $request
     * @param \App\Models\Property\Apartment\ApartmentLeasePeriod $apartmentLeasePeriod
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentLeasePeriodUpdateRequest $request, ApartmentLeasePeriod $apartmentLeasePeriod)
    {
        $apartmentLeasePeriod->update($request->validated());

        $request->session()->flash('apartmentLeasePeriod.id', $apartmentLeasePeriod->id);

        return redirect()->route('apartmentLeasePeriod.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property\Apartment\ApartmentLeasePeriod $apartmentLeasePeriod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ApartmentLeasePeriod $apartmentLeasePeriod)
    {
        $apartmentLeasePeriod->delete();

        return redirect()->route('apartmentLeasePeriod.index');
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\ApartmentLeasePeriodStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentLeasePeriodStoreRequest $request)
    {
        $leasePeriod = LeasePeriod::create($request->validated());

        $request->session()->flash('leasePeriod-added-successively', $leasePeriod - added - successively);

        return redirect()->route('ApartmentReview.index');
    }
}