<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Support\Str;
use App\Models\Snack;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['schedule.movie', 'bookingDetails.seat', 'snacks'])->where('user_id', auth()->id())->orderByRaw("FIELD(status, 'pending', 'paid', 'cancelled')")->latest()->get();

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

        $snacks = Snack::where('stock', '>', 0)->get();

        return view('bookings.create', [
            'schedule' => $schedule,
            'bookedSeatIds' => $bookedSeatIds,
            'snacks' => $snacks,
        ]);
    }

    public function store(Request $request, Schedule $schedule)
    {
        $input = $request->validate([
            'seats' => 'required|array|min:1',
            'snacks' => 'nullable|array',
        ]);

        if ($request->filled('snacks')) {
            foreach ($request->snacks as $snackId => $qty) {
                $snack = Snack::find($snackId);
                if (!$snack) continue;
                if ($qty > $snack->stock) {
                    return back()->withInput()->with('error', "{$snack->name} only has {$snack->stock} stock left.");
                }
            }
        }

        $ticketTotal = count($input['seats']) * $schedule->price;
        $snackTotal = 0;

        if ($request->filled('snacks')) {
            foreach ($request->snacks as $snackId => $qty) {
                if ($qty > 0) {
                    $snack = Snack::find($snackId);
                    if ($snack) $snackTotal += $snack->price * $qty;
                }
            }
        }

        $booking = Booking::create([
            'user_id'      => auth()->id(),
            'schedule_id'  => $schedule->id,
            'booking_code' => (string) Str::uuid(),
            'total_price'  => $ticketTotal + $snackTotal,
            'status'       => 'pending',
        ]);

        foreach ($input['seats'] as $seatId) {
            BookingDetail::create(['booking_id' => $booking->id, 'seat_id' => $seatId]);
        }

        if ($request->filled('snacks')) {
            foreach ($request->snacks as $snackId => $qty) {
                if ($qty > 0) {
                    $booking->snacks()->attach($snackId, ['quantity' => $qty]);
                }
            }
        }

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    public function show(Booking $booking) {}

    public function edit(Booking $booking)
    {
        $schedules = Schedule::with('movie')->get();
        return view('bookings.edit', compact('booking', 'schedules'));
    }

    public function update(Request $request, Booking $booking) {}

    public function destroy(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);

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
        $booking->update(['status' => 'paid']);
        return redirect()->route('bookings.index')->with('success', 'Payment successful!');
    }

    public function approve(Booking $booking)
    {
        if ($booking->status === 'paid') {
            return redirect()->route('admin.bookings');
        }

        $booking->update([
            'status' => 'paid'
        ]);

        $snacks = $booking->snacks()->get();

        foreach ($snacks as $snack) {
            $snack->decrement('stock', $snack->pivot->quantity);
        }

        return redirect()
            ->route('admin.bookings')
            ->with('success', 'Booking approved successfully!');
    }

    public function showPaymentQr(Booking $booking)
    {
        $booking->refresh();

        if ($booking->status === 'paid') {
            return redirect()->route('bookings.index')->with('success', 'Payment successful!');
        }

        return view('bookings.payment-qr', compact('booking'));
    }

    public function scanPayment($code)
    {
        $booking = Booking::where('booking_code', $code)->firstOrFail();

        if ($booking->status === 'paid') {
            return redirect()
                ->route('bookings.index')
                ->with('success', 'Payment already completed.');
        }

        foreach ($booking->snacks()->get() as $snack) {
            $snack->decrement('stock', $snack->pivot->quantity);
        }

        $booking->update([
            'status' => 'paid'
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Payment successful!');
    }

    public function snackCheckout(Request $request)
    {
        try {
            $request->validate([
                'snacks'       => 'required|array|min:1',
                'snacks.*.id'  => 'required|integer|exists:snacks,id',
                'snacks.*.qty' => 'required|integer|min:1',
            ]);

            $snacks = $request->snacks;

            foreach ($snacks as $item) {
                $snack = Snack::findOrFail($item['id']);
                if ($item['qty'] > $snack->stock) {
                    return response()->json([
                        'error' => "{$snack->name} only has {$snack->stock} stock left."
                    ], 422);
                }
            }

            $total = 0;
            $lines = [];
            foreach ($snacks as $item) {
                $snack = Snack::find($item['id']);
                $total += $snack->price * $item['qty'];
                $lines[] = ['snack' => $snack, 'qty' => $item['qty']];
            }

            $booking = Booking::create([
                'user_id'      => auth()->id(),
                'schedule_id'  => null,
                'booking_code' => (string) Str::uuid(),
                'total_price'  => $total,
                'status'       => 'pending',
            ]);

            foreach ($lines as $line) {
                $booking->snacks()->attach($line['snack']->id, ['quantity' => $line['qty']]);
            }

            return response()->json([
                'redirect' => route('bookings.qr', $booking->id)
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation: ' . collect($e->errors())->flatten()->implode(', ')], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => get_class($e) . ': ' . $e->getMessage()], 500);
        }
    }
}