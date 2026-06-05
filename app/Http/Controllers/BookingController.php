<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['schedule.movie', 'bookingDetails.seat'])->where('user_id', auth()->id())->orderByRaw("FIELD(status, 'pending', 'paid', 'cancelled')")->latest()->get();

        return view('bookings.index', compact('bookings'));
    }

    public function adminIndex()
    {
        $bookings = Booking::with(['user', 'schedule.movie', 'bookingDetails.seat'])->latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create(Schedule $schedule)
    {
        $schedule->load(['movie','studio.seats']);

        $bookedSeatIds = BookingDetail::whereHas('booking', function ($query) use ($schedule) {
            $query->where('schedule_id', $schedule->id)
                  ->whereIn('status', ['pending', 'paid']);
        })->pluck('seat_id');

        return view('bookings.create', [
            'schedule' => $schedule,
            'bookedSeatIds' => $bookedSeatIds,
        ]);
    }

    public function store(Request $request, Schedule $schedule)
    {
        $input = $request->validate([
            'seats' => 'required|array|min:1',
        ]);
    
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'schedule_id' => $schedule->id,
            'booking_code' => Str::uuid(),
            'total_price' => count($input['seats']) * $schedule->price,
            'status' => 'pending',
        ]);

        foreach($input['seats'] as $seatId) {
            BookingDetail::create([
                'booking_id' => $booking->id,
                'seat_id' => $seatId,
            ]);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        $schedules = Schedule::with('movie')->get();

        return view('bookings.edit', compact('booking', 'schedules'));
    }

    public function update(Request $request, Booking $booking)
    {
        //
    }

    public function destroy(Booking $booking)
    {
        $booking->update([
            'status' => 'cancelled'
        ]);

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.bookings')->with('success', 'Booking status changed to cancelled.');
        }

        return redirect()->route('bookings.index')->with('success', 'Booking cancelled');
    }
    
    public function forceDelete(Booking $booking)
    {
        $booking->bookingDetails()->delete();
        
        $booking->delete();

        return redirect()->route('admin.bookings')->with('success', 'Booking permanently deleted from database.');
    }

    public function pay(Booking $booking)
    {
        $booking->update([
            'status' => 'paid'
        ]);

        return redirect()->route('bookings.index')->with('success', 'Payment successful!');
    }

    public function approve(Booking $booking)
    {
        $booking->update([
            'status' => 'paid'
        ]);

        return redirect()->route('admin.bookings')->with('success', 'Booking approved successfully!');
    }
    public function showPaymentQr(Booking $booking)
    {
        $booking->refresh();

        if ($booking->status === 'paid') {
            return redirect()->route('bookings.index')
                ->with('success', 'Payment successful!');
        }

        return view('bookings.payment-qr', compact('booking'));
    }
    public function scanPayment($code)
    {
        $booking = Booking::where('booking_code', $code)
            ->firstOrFail();

        $booking->update([
            'status' => 'paid'
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Payment successful!');
    }

}