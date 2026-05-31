<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('movie')->get();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();

        return view('schedules.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'show_date' => 'required',
            'show_time' => 'required',
            'price' => 'required',
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $movies = Movie::all();

        return view('schedules.edit', compact('schedule', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'show_date' => 'required',
            'show_time' => 'required',
            'price' => 'required',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }
}