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
            'studio_id' => 'required|exists:studios,id',
            'rows' => 'required|integer|min:1|max:20',
            'cols' => 'nullable|integer|min:1|max:10',
        ]);

        $studioId = $input['studio_id'];
        $maxCols = $input['cols'] ?? 10;

        for($r = 0; $r < $input['rows']; $r++) {
            $rowLetter = chr(65 + $r);

            for($c = 1; $c <= $maxCols; $c++) {
                Seat::firstOrCreate([
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
        return view('seats.edit', compact('seat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        $input = $request->validate([
            'seat_number' => 'required|string|max:10',
        ]);

        $seat->update([
            'seat_number' => $input['seat_number'],
        ]);

        return redirect()->route('seats.index')->with('success', 'Seat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        // ganti dengan delete by studio
    }

    public function destroyByStudio(Studio $studio)
    {
        $studio->seats()->delete();
        return redirect()->route('seats.index')->with('success', 'All seats deleted successfully.');
    }
}
