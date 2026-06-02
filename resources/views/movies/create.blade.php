@extends('layouts.admin')

@section('title', 'Add Movie')

@section('content')

<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm p-8">

    <h2 class="text-3xl font-bold text-[#1B3C53] mb-6">
        Add Movie
    </h2>

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Title
            </label>

            <input type="text" name="title" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Genre
            </label>

            <input type="text" name="genre" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Duration (Minutes)
            </label>

            <input type="number" name="duration" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Release Date
            </label>

            <input type="date" name="release_date" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="block mb-2 font-medium text-[#1B3C53]">
                Poster
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
                      class="w-full rounded-xl border border-gray-300 p-3"></textarea>
        </div>

        <button type="submit"
                class="rounded-xl bg-[#234C6A] px-6 py-3 text-white hover:bg-[#1B3C53] transition">
            Save Movie
        </button>

    </form>

</div>

@endsection