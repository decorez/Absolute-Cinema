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

        $input['poster'] = null;

        if ($request->hasFile('poster')) {  
                $file = $request->file('poster');
                $uploaded = $cloudinary->uploadImage($file->getRealPath(), 'movies');
                $input['poster'] = $uploaded['secure_url'];

            if (!isset($uploaded['secure_url'])) {
                throw new \Exception('Cloudinary upload failed');
            }

            $input['poster'] = $uploaded['secure_url'];
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

            $file = $request->file('poster');

            $uploaded = app(CloudinaryService::class)
                ->uploadImage($file->getRealPath(), 'movies');

            if (!isset($uploaded['secure_url'])) {
                throw new \Exception('Cloudinary upload failed');
            }

            $poster = $uploaded['secure_url'];
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