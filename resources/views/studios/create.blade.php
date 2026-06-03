@extends('layouts.admin')

@section('title', 'Add Studio')

@section('content')

<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">

    <h2 class="mb-6 text-3xl font-black tracking-tight text-white">
        Add New Studio
    </h2>

    <form action="{{ route('studios.store') }}" method="POST" class="m-0">
        @csrf

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Studio Name
            </label>
            <input type="text" name="name" placeholder="e.g., Studio 1, Studio 2 VIP" required
                   class="w-full rounded-xl bg-[#1B3C53] border border-white/10 p-3 text-white placeholder-white/30 focus:outline-none focus:border-[#D2C1B6] transition">
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Studio Type
            </label>
            <select name="type" required
                    class="w-full rounded-xl bg-[#1B3C53] border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] transition">
                <option value="Deluxe">Deluxe</option>
                <option value="Dolby Atmos">Dolby Atmos</option>
                <option value="IMAX">IMAX</option>
                <option value="The Premiere">The Premiere</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Seat Capacity
            </label>
            <input type="number" name="capacity" placeholder="e.g., 50" required
                   class="w-full rounded-xl bg-[#1B3C53] border border-white/10 p-3 text-white placeholder-white/30 focus:outline-none focus:border-[#D2C1B6] transition">
        </div>

        <div class="flex gap-3 pt-4 border-t border-white/10">
            <button type="submit" 
                    class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105 shadow-lg shadow-black/20">
                Save Studio
            </button>
            <a href="{{ route('studios.index') }}" 
               class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection