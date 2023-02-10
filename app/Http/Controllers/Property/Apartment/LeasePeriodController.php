<?php

namespace App\Http\Controllers\Property\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\Apartment\LeasePeriodStoreRequest;
use App\Http\Requests\Property\Apartment\LeasePeriodUpdateRequest;
use App\Models\Property\Apartment\LeasePeriod;
use App\Property\Apartment\Period;
use Illuminate\Http\Request;

class LeasePeriodController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leasePeriods = LeasePeriod::all();

        return view('leasePeriod.index', compact('leasePeriods'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('leasePeriod.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Property\Apartment\leasePeriod $leasePeriod
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LeasePeriod $leasePeriod)
    {
        return view('leasePeriod.show', compact('leasePeriod'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Property\Apartment\leasePeriod $leasePeriod
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, LeasePeriod $leasePeriod)
    {
        return view('leasePeriod.edit', compact('leasePeriod'));
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\LeasePeriodUpdateRequest $request
     * @param \App\Property\Apartment\leasePeriod $leasePeriod
     * @return \Illuminate\Http\Response
     */
    public function update(LeasePeriodUpdateRequest $request, LeasePeriod $leasePeriod)
    {
        $leasePeriod->update($request->validated());

        $request->session()->flash('leasePeriod.id', $leasePeriod->id);

        return redirect()->route('leasePeriod.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Property\Apartment\leasePeriod $leasePeriod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LeasePeriod $leasePeriod)
    {
        $leasePeriod->delete();

        return redirect()->route('leasePeriod.index');
    }

    /**
     * @param \App\Http\Requests\Property\Apartment\LeasePeriodStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeasePeriodStoreRequest $request)
    {
        $period = Period::create($request->validated());

        $request->session()->flash('period-added-successively', $period - added - successively);

        return redirect()->route('ApartmentReview.index');
    }
}