@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#1B3C53] text-white p-10">

    <a href="{{ url('/') }}" class="text-xs text-[#D2C1B6] hover:text-white flex items-center gap-1 mb-2 transition">
        ← Back to Home
    </a>

    <h1 class="text-3xl font-bold mb-8">

        Search Results for "{{ $search }}"

    </h1>

    @if($movies->count())

        <div class="grid grid-cols-4 gap-6">

            @foreach($movies as $movie)

                <a href="{{ route('movies.show', $movie) }}">

                    <div class="bg-white/10 rounded-xl p-4">

                        <img
                            src="{{ asset('storage/'.$movie->poster) }}"
                            class="w-full h-72 object-cover rounded-lg"
                        >

                        <h2 class="font-bold mt-3">

                            {{ $movie->title }}

                        </h2>

                        <p>

                            {{ $movie->genre }}

                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <p>No movies found.</p>

    @endif

</div>

@endsection