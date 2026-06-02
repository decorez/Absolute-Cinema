<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Schedule;
use App\Models\Studio;  
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = Seat::with('studio')->get();
        return view('seats.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studios = Studio::all();

        return view('seats.create', compact('studios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'studio_id' => 'required',
            'rows' => 'required|integer|min:1',
            'cols' => 'nullable|integer|min:1   ',
        ]);

        $studioId = $input['studio_id'];

        for($r = 0; $r < $input['rows']; $r++) {

            $rowLetter = chr(65 + $r);

            for($c = 1; $c < ($input['cols'] ?? 10); $c++) {
                Seat::create([
                    'studio_id' => $studioId,
                    'seat_number' => $rowLetter . $c,
                ]);
            }
        }

        return redirect()->route('seats.index')->with('success', 'Seats added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        return view('seats.edit', [
            'seat' => $seat,
            'schedules' => Schedule::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        $input = $request->validate([
            'schedule_id' => 'required',
            'seat_number' => 'required',
            'is_booked' => 'nullable',
        ]);

        $seat->update([
            'schedule_id' => $input['schedule_id'],
            'seat_number' => $input['seat_number'],
            'is_booked' => $input['is_booked'] ?? false,
        ]);

        return redirect()->route('seats.index')->with('success', 'Seat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('seats.index')->with('success', 'Seat deleted successfully.');
    }
}
