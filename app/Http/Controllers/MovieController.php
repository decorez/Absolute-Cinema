<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'genre' => 'required',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $poster = null;
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster')->store('movies', 'public');
            $input['poster'] = $poster;
        }

        Movie::create($input);
        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $input = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'genre' => 'required',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $poster = $movie->poster;
        if ($request->hasFile('poster')) {
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            $poster = $request->file('poster')->store('movies', 'public');
        }
        $movie->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'genre' => $input['genre'],
            'duration' => $input['duration'],
            'release_date' => $input['release_date'],
            'poster' => $poster
        ]);
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        if ($movie->poster) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}