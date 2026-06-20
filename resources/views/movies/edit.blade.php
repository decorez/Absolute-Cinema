@extends('layouts.admin')

@section('title', 'Edit Movie')

@section('content')
<div class="max-w-4xl mx-auto bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h2 class="text-3xl font-black tracking-tight text-white mb-6">
        Edit Movie
    </h2>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="m-0">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Title
            </label>
            <input type="text" name="title" value="{{ $movie->title }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Genre
            </label>
            <input type="text" name="genre" value="{{ $movie->genre }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Duration (Minutes)
            </label>
            <input type="number" name="duration" value="{{ $movie->duration }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Release Date
            </label>
            <input type="date" name="release_date" value="{{ $movie->release_date }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        @if($movie->poster)
            <div class="mb-5">
                <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                    Current Poster
                </label>
                <img src="{{ asset('images/movies/'.$movie->poster) }}" class="h-40 rounded-xl border border-white/10 object-cover">
            </div>
        </if>
        @endif

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Change Poster
            </label>
            <input type="file" name="poster" accept=".jpg,.jpeg,.png" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-sm text-[#D2C1B6] file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#D2C1B6] file:text-[#1B3C53]">
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Description
            </label>
            <textarea name="description" rows="5" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">{{ $movie->description }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Update Movie
            </button>
            <a href="{{ route('movies.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection