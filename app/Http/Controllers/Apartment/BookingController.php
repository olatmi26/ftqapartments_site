<?php

namespace App\Http\Controllers\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\BookingStoreRequest;
use App\Http\Requests\Apartment\BookingUpdateRequest;
use App\Models\Apartment\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = Booking::all();

        return view('booking.index', compact('bookings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('booking.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    /**
     * @param \App\Http\Requests\Apartment\BookingUpdateRequest $request
     * @param \App\Models\Apartment\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        $request->session()->flash('booking.id', $booking->id);

        return redirect()->route('booking.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Apartment\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Booking $booking)
    {
        $booking->delete();

        return redirect()->route('booking.index');
    }

    /**
     * @param \App\Http\Requests\Apartment\BookingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $booking = Booking::create($request->validated());

        $request->session()->flash('booking-added-successively', $booking-added-successively);

        return redirect()->route('Booking.index');
    }
}
