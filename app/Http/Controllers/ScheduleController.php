<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Studio;
use App\Models\Movie;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['movie', 'studio'])->get();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        $studios = Studio::all();

        return view('schedules.create', compact('movies', 'studios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'movie_id' => 'required',
            'studio_id' => 'required',
            'show_date' => 'required',
            'show_time' => 'required',
            'price' => 'required',
        ]);

        Schedule::create($input);

        return redirect()->route('schedules.index')->with('success', 'Schedule added successfully.');
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
        $studios = Studio::all();

        return view('schedules.edit', compact('schedule', 'movies', 'studios'));
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $input = $request->validate([
            'movie_id' => 'required',
            'studio_id' => 'required',
            'show_date' => 'required',
            'show_time' => 'required',
            'price' => 'required',
        ]);

        $schedule->update($input);

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}