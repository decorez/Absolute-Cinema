@extends('layouts.admin')

@section('title', 'Edit Movie')

@section('content')

<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm p-8">

    <h2 class="text-3xl font-bold text-[#1B3C53] mb-6">
        Edit Movie
    </h2>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Title
            </label>

            <input type="text" name="title" value="{{ $movie->title }}" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Genre
            </label>

            <input type="text" name="genre" value="{{ $movie->genre }}" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Duration
            </label>

            <input type="number" name="duration" value="{{ $movie->duration }}" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Release Date
            </label>

            <input type="date" name="release_date" value="{{ $movie->release_date }}" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        @if($movie->poster)

            <div class="mb-5">

                <label class="block mb-2 font-medium text-[#1B3C53]">
                    Current Poster
                </label>

                <img src="{{ asset('storage/' . $movie->poster) }}"
                     class="h-40 rounded-xl border">

            </div>

        @endif

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Change Poster
            </label>

            <input type="file"
                   name="poster"
                   accept=".jpg,.jpeg,.png"
                   class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-6">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Description
            </label>

            <textarea name="description"
                      rows="5"
                      class="w-full rounded-xl border border-gray-300 p-3">{{ $movie->description }}</textarea>
        </div>

        <button type="submit"
                class="rounded-xl bg-[#234C6A] px-6 py-3 text-white hover:bg-[#1B3C53] transition">
            Update Movie
        </button>

    </form>

</div>

@endsection