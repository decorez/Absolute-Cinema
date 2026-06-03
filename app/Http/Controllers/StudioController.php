<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studios = Studio::all();

        return view('studios.index', compact('studios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        Studio::create($input);

        return redirect()->route('studios.index')->with('success', 'Studio added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Studio $studio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Studio $studio)
    {
        return view('studios.edit', compact('studio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Studio $studio)
    {
        $input = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        $studio->update($input);

        return redirect()->route('studios.index')->with('success', 'Studio updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studio $studio)
    {
        $studio->delete();

        return redirect()->route('studios.index')->with('success', 'Studio deleted successfully.');
    }
}