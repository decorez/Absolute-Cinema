<?php

namespace App\Http\Controllers;

use App\Models\Snack;
use Illuminate\Http\Request;

class SnackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $snacks = Snack::all();
        return view('snacks.index', compact('snacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('snacks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        Snack::create($validated);
        return redirect()->route('snacks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Snack $snack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Snack $snack)
    {
        return view('snacks.edit', compact('snack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Snack $snack)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $snack->update($validated);
        return redirect()->route('snacks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Snack $snack)
    {
        $snack->delete();
        return redirect()->route('snacks.index');
    }
}
