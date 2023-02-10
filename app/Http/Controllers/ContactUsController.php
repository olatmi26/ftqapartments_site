<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsStoreRequest;
use App\Http\Requests\ContactUsUpdateRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contactUs = ContactU::all();

        return view('contactU.index', compact('contactUs'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('contactU.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ContactUs $contactU
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ContactU $contactU)
    {
        return view('contactU.show', compact('contactU'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ContactUs $contactU
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ContactU $contactU)
    {
        return view('contactU.edit', compact('contactU'));
    }

    /**
     * @param \App\Http\Requests\ContactUsUpdateRequest $request
     * @param \App\Models\ContactUs $contactU
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUsUpdateRequest $request, ContactU $contactU)
    {
        $contactU->update($request->validated());

        $request->session()->flash('contactU.id', $contactU->id);

        return redirect()->route('contactU.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ContactUs $contactU
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ContactU $contactU)
    {
        $contactU->delete();

        return redirect()->route('contactU.index');
    }

    /**
     * @param \App\Http\Requests\ContactUsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsStoreRequest $request)
    {
        $contactUs = ContactUs::create($request->validated());

        $request->session()->flash('contactUs-saved-successively', $contactUs-saved-successively);

        return redirect()->route('ContactUs.index');
    }
}
