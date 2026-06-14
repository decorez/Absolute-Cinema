@extends('layouts.admin')

@section('title', 'Add Promo')

@section('content')
<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h3 class="mb-6 text-2xl font-bold tracking-tight text-white">
        Add New Promo
    </h3>

    @if ($errors->any())
        <div class="mb-5 rounded-xl bg-red-500/10 border border-red-500/20 p-4 text-red-400 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('promos.store') }}" method="POST" enctype="multipart/form-data" class="m-0">
        @csrf

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Promo Title
            </label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Description
            </label>
            <textarea name="description" rows="4" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                    Start Date
                </label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">
            </div>
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                    End Date
                </label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">
            </div>
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Promo Banner Image
            </label>
            <input type="file" name="image" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#D2C1B6] file:text-[#1B3C53] hover:file:bg-white transition">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Save Promo
            </button>
            <a href="{{ route('promos.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection