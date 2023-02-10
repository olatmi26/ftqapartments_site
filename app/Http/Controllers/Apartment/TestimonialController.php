<?php

namespace App\Http\Controllers\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\TestimonialStoreRequest;
use App\Http\Requests\Apartment\TestimonialUpdateRequest;
use App\Models\Apartment\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $testimonials = Testimonial::all();

        return view('testimonial.index', compact('testimonials'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('testimonial.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Testimonial $testimonial)
    {
        return view('testimonial.show', compact('testimonial'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Testimonial $testimonial)
    {
        return view('testimonial.edit', compact('testimonial'));
    }

    /**
     * @param \App\Http\Requests\Apartment\TestimonialUpdateRequest $request
     * @param \App\Models\Apartment\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {
        $testimonial->update($request->validated());

        $request->session()->flash('testimonial.id', $testimonial->id);

        return redirect()->route('testimonial.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonial.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\TestimonialStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialStoreRequest $request)
    {
        $testimonial = Testimonial::create($request->validated());

        $request->session()->flash('testimonial-added-successively', $testimonial-added-successively);

        return redirect()->route('Testimonial.index');
    }
}
