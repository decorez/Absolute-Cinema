@extends('layouts.admin')

@section('title', 'Edit Schedule')

@section('content')
<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h2 class="text-3xl font-black tracking-tight text-white mb-6">Edit Schedule</h2>

    <form method="POST" action="{{ route('schedules.update', $schedule->id) }}" class="m-0">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Movie</label>
            <select name="movie_id" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}" class="bg-[#1B3C53] text-white" {{ $schedule->movie_id == $movie->id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Studio</label>
            <select name="studio_id" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                @foreach($studios as $studio)
                    <option value="{{ $studio->id }}" class="bg-[#1B3C53] text-white" {{ $schedule->studio_id == $studio->id ? 'selected' : '' }}>
                        {{ $studio->name }} ({{ $studio->type }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Show Date</label>
            <input type="date" name="show_date" value="{{ $schedule->show_date }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Show Time</label>
            <input type="time" name="show_time" value="{{ $schedule->show_time }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Ticket Price</label>
            <input type="number" name="price" value="{{ $schedule->price }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Update Schedule
            </button>
            <a href="{{ route('schedules.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection