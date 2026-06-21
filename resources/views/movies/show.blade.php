@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@php
$groupedByDate = $schedules->groupBy(function($s) {
return \Carbon\Carbon::parse($s->show_date)->format('Y-m-d');
});
$dates = $groupedByDate->keys();
$firstDate = $dates->first();
@endphp

<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882] py-10 px-6"
    x-data="{ activeDate: '{{ $firstDate }}' }">

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
                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
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

                @if($dates->isEmpty())
                <div class="rounded-2xl bg-white/5 border border-dashed border-white/10 p-8 text-center">
                    <p class="text-sm text-[#D2C1B6]">No showtimes available.</p>
                </div>
                @else
                <div class="flex gap-2 overflow-x-auto pb-2 mb-6 scrollbar-hide">
                    @foreach($dates as $date)
                    <button
                        @click="activeDate = '{{ $date }}'"
                        :class="activeDate === '{{ $date }}'
                                ? 'bg-[#D2C1B6] text-[#1B3C53]'
                                : 'bg-white/5 text-white border border-white/10 hover:border-[#D2C1B6]/50'"
                        class="flex-shrink-0 flex flex-col items-center px-4 py-3 rounded-2xl transition font-bold min-w-[64px]">
                        <span class="text-[10px] uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($date)->format('D') }}
                        </span>
                        <span class="text-xl font-black leading-tight">
                            {{ \Carbon\Carbon::parse($date)->format('d') }}
                        </span>
                        <span class="text-[10px] uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($date)->format('M') }}
                        </span>
                    </button>
                    @endforeach
                </div>

                @foreach($groupedByDate as $date => $dateSchedules)
                <div x-show="activeDate === '{{ $date }}'" x-transition>
                    @php $groupedByStudio = $dateSchedules->groupBy('studio_id'); @endphp

                    @foreach($groupedByStudio as $studioId => $studioSchedules)
                    <div class="mb-4 bg-white/5 border border-white/10 rounded-2xl p-4">
                        <div class="flex justify-between items-center mb-3">
                            <p class="text-sm font-bold text-white">
                                {{ $studioSchedules->first()->studio->name ?? 'Studio ' . $studioId }}
                                @if($studioSchedules->first()->studio->type ?? false)
                                <span class="text-xs font-normal text-[#D2C1B6]">
                                    ({{ $studioSchedules->first()->studio->type }})
                                </span>
                                @endif
                            </p>
                            <p class="text-xs text-[#D2C1B6]">
                                Rp {{ number_format($studioSchedules->first()->price, 0, ',', '.') }} / seat
                            </p>
                        </div>

                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                        
                            @foreach($studioSchedules as $schedule)
                            @php
                            $isPast = \Carbon\Carbon::parse($schedule->show_date . ' ' . $schedule->show_time)->lt(now());
                            @endphp

                            @if($isPast)
                            <span class="rounded-xl bg-white/10 text-white/30 font-bold text-sm py-3 text-center cursor-not-allowed line-through">
                                {{ \Carbon\Carbon::parse($schedule->show_time)->format('H:i') }}
                            </span>
                            @else
                            <a href="{{ route('bookings.create', $schedule->id) }}"
                                class="rounded-xl bg-[#D2C1B6] text-[#1B3C53] font-bold text-sm py-3 text-center transition hover:scale-105 hover:brightness-110">
                                {{ \Carbon\Carbon::parse($schedule->show_time)->format('H:i') }}
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                @endif
            </div>

        </div>

    </div>
</div>
@endsection