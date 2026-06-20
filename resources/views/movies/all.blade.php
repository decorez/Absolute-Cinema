@extends('layouts.app')

@section('content')
<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882] py-10 px-6">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-5">
            <div>
                <a href="{{ url('/') }}" class="text-xs text-[#D2C1B6] hover:text-white flex items-center gap-1 mb-2 transition">
                    ← Back to Home
                </a>
                <h1 class="text-3xl font-extrabold tracking-tight">Now Showing in Cinema</h1>
            </div>
            <p class="text-xs font-bold text-[#D2C1B6] bg-white/5 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                Total: {{ $movies->count() }} Movies
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($movies as $movie)
                <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 shadow-md flex flex-col justify-between group hover:border-[#D2C1B6]/30 transition duration-300">
                    <div>
                        <div class="overflow-hidden relative h-[380px]">
                            @if($movie->poster)
                                <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" alt="{{ $movie->title }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="h-full bg-gradient-to-b from-[#456882] to-[#234C6A] flex items-center justify-center text-xs text-[#D2C1B6]">
                                    No Poster Available
                                </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-bold line-clamp-2 text-white">
                                {{ $movie->title }}
                            </h3>
                            <p class="mt-1 text-xs text-[#D2C1B6]">
                                {{ $movie->genre ?? 'Genre' }} • {{ $movie->duration ?? '0' }} Min
                            </p>
                        </div>
                    </div>

                    <div class="px-5 pb-5">
                        <a href="{{ route('movies.show', $movie->id) }}" class="block w-full rounded-xl bg-[#D2C1B6] py-2.5 text-center text-xs font-bold text-[#1B3C53] transition hover:opacity-90 uppercase tracking-wide">
                            Buy Ticket
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="rounded-2xl bg-white/5 border border-dashed border-white/10 p-12 text-center">
                        <p class="text-sm text-[#D2C1B6]">No Movies Available At The Moment.</p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection