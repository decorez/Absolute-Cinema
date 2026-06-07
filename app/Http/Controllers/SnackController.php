<?php

namespace App\Http\Controllers;

use App\Models\Snack;
use Illuminate\Http\Request;

class SnackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->category;

        $snacks = Snack::when($category && $category !== 'All', function ($query) use ($category) {
            $query->where('category', $category);
        })->get();

        return view('snacks.all', compact('snacks', 'category'));
    }

    public function adminIndex()
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
            'category' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('snacks', 'public');
            $validated['image'] = $imagePath;
        }

        Snack::create($validated);
        return redirect()->route('snacks.admin')->with('success', 'Snack added successfully.');
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
            'category' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('snacks', 'public');
        }

        $snack->update($validated);

        return redirect()
            ->route('snacks.admin')
            ->with('success', 'Snack updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Snack $snack)
    {
        $snack->delete();
        return redirect()->route('snacks.admin')->with('success', 'Snack deleted successfully.');
    }
}
