<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = Seat::all();
        return view('seats.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seat_number' => 'required',
        ]);
        Seat::create($validated);
        return redirect()->route('seats.index');
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
        $validated = $request->validate([
            'seat_number' => 'required',
        ]);
        $seat->update($validated);
        return redirect()->route('seats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('seats.index');
    }
}
