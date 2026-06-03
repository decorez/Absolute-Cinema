@extends('layouts.admin')

@section('content')
<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h1 class="text-3xl font-black tracking-tight text-white mb-6">Generate Seats</h1>

    <form method="POST" action="{{ route('seats.store') }}" class="m-0">
        @csrf

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Studio</label>
            <select name="studio_id" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                @foreach($studios as $studio)
                    <option value="{{ $studio->id }}" class="bg-[#1B3C53] text-white">{{ $studio->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Rows</label>
            <input type="number" name="rows" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white placeholder-white/30 focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">Columns</label>
            <input type="number" name="cols" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white placeholder-white/30 focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Generate
            </button>
            <a href="{{ route('seats.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection