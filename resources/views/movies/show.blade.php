@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882] py-10 px-6">
    
    <div class="max-w-3xl mx-auto">
        
        <div class="mb-6">
            <a href="{{ url('/') }}" class="text-sm text-[#D2C1B6] hover:opacity-80 transition font-medium">
                ← Back to Home
            </a>
        </div>

        <div class="rounded-[36px] overflow-hidden bg-white/5 p-8 backdrop-blur-sm border border-white/10">
            
            <div class="flex flex-col sm:flex-row gap-8 pb-6 border-b border-white/10">
                
                <div class="w-full sm:w-44 aspect-[2/3] bg-[#234C6A]/80 rounded-2xl overflow-hidden border border-white/10 flex-shrink-0">
                    @if($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-xs text-[#D2C1B6] p-4 text-center">
                            No Poster Available
                        </div>
                    @endif
                </div>

                <div class="flex flex-col justify-center space-y-3">
                    <span class="inline-block bg-[#D2C1B6] text-[#1B3C53] text-xs font-bold px-3 py-1 rounded-full w-max">
                        {{ $movie->genre ?? 'Genre' }} • {{ $movie->duration ?? '0' }} Min
                    </span>
                    
                    <h1 class="text-3xl font-bold tracking-tight">
                        {{ $movie->title }}
                    </h1>
                    
                    <p class="text-sm text-[#D2C1B6] leading-relaxed">
                        {{ $movie->synopsis ?? 'No synopsis available for this movie.' }}
                    </p>
                </div>

            </div>

            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4">Select Showtimes</h2>

                <div class="space-y-3">
                    @foreach($movie->schedules as $schedule)
                        <div class="p-4 rounded-2xl bg-[#234C6A]/80 border border-white/5 flex justify-between items-center transition hover:scale-[1.01]">
                            
                            <div>
                                <p class="font-semibold text-white">
                                    {{ \Carbon\Carbon::parse($schedule->show_date)->format('d M Y') }}
                                </p>
                                <p class="text-xs text-[#D2C1B6] mt-0.5">
                                    {{ \Carbon\Carbon::parse($schedule->show_time)->format('H:i') }} WIB — Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <a href="{{ route('bookings.create', $schedule->id) }}" class="rounded-xl bg-[#D2C1B6] px-5 py-2.5 text-xs font-bold text-[#1B3C53] transition hover:scale-105 whitespace-nowrap">
                                Select Seats
                            </a>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
@endsection