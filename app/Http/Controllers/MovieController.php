<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\CloudinaryService;

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

    public function store(Request $request, CloudinaryService $cloudinary)
    {
        $input = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'genre' => 'required',
            'duration' => 'required|integer',
            'release_date' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('poster')) {

            $filePath = $request->file('poster')->getRealPath();

            $uploaded = $cloudinary->uploadImage($filePath, 'movies');

            $input['poster'] = $uploaded['public_id'];
        }

        Movie::create($input);

        return redirect()->route('movies.index')
            ->with('success', 'Movie added successfully.');
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

            $filePath = $request->file('poster')->getRealPath();

            $uploaded = app(CloudinaryService::class)
                ->uploadImage($filePath, 'movies');

            $poster = $uploaded['public_id'];
        }

        $movie->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'genre' => $input['genre'],
            'duration' => $input['duration'],
            'release_date' => $input['release_date'],
            'poster' => $poster
        ]);

        return redirect()->route('movies.index')
            ->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        // Cloudinary delete can be added later using public_id

        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', 'Movie deleted successfully.');
    }

    public function show(Movie $movie)
    {
        $schedules = $movie->schedules()
            ->with('studio')
            ->orderBy('show_date')
            ->orderBy('show_time')
            ->get();

        return view('movies.show', compact('movie', 'schedules'));
    }
}