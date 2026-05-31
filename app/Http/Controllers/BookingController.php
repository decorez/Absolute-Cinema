<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\BookingDetail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'schedule.movie'])->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schedules = Schedule::with('movie')->get();
        $seats = Seat::all();
        return view('bookings.create', compact('schedules','seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'schedule_id' => $request->schedule_id,
        ]);
        BookingDetail::create([
            'booking_id' => $booking->id,
            'seat_id' => $request->seat_id,
        ]);

        return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $schedules = Schedule::with('movie')->get();

        return view('bookings.edit', compact('booking', 'schedules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index');
    }

}
