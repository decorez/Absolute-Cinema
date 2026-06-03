@extends('layouts.admin')

@section('title', 'Edit Seat')

@section('content')
<div class="max-w-xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h2 class="text-3xl font-black tracking-tight text-white mb-6">
        Edit Seat Number
    </h2>

    <form action="{{ route('seats.update', $seat->id) }}" method="POST" class="m-0">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Seat Number
            </label>
            <input type="text" name="seat_number" value="{{ $seat->seat_number }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Update Seat
            </button>
            <a href="{{ route('seats.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection