<?php

namespace App\Http\Controllers\Apartment;

use Illuminate\Http\Request;
use App\Models\Apartment\Term;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\TermStoreRequest;
use App\Http\Requests\Apartment\TermUpdateRequest;


class TermsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $terms = Term::all();
        return view('term.index', compact('terms'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('term.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Apartment\term $term
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Term $term)
    {
        return view('term.show', compact('term'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Apartment\term $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Term $term)
    {
        return view('term.edit', compact('term'));
    }

    /**
     * @param \App\Http\Requests\Apartment\TermUpdateRequest $request
     * @param \App\Apartment\term $term
     * @return \Illuminate\Http\Response
     */
    public function update(TermUpdateRequest $request, Term $term)
    {
        $term->update($request->validated());

        $request->session()->flash('term.id', $term->id);

        return redirect()->route('term.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Apartment\term $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Term $term)
    {
        $term->delete();

        return redirect()->route('term.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\TermStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TermStoreRequest $request)
    {
        $terms = Term::create($request->validated());

        $request->session()->flash('terms-added-successively');

        return redirect()->route('Terms.index');
    }
}