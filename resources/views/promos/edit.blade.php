@extends('layouts.admin')

@section('title', 'Edit Promo')

@section('content')
<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h3 class="mb-6 text-2xl font-bold tracking-tight text-white">
        Edit Promo
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

    <form action="{{ route('promos.update', $promo->id) }}" method="POST" enctype="multipart/form-data" class="m-0">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Promo Title
            </label>
            <input type="text" name="title" value="{{ old('title', $promo->title) }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Description
            </label>
            <textarea name="description" rows="4" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">{{ old('description', $promo->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                    Start Date
                </label>
                <input type="date" name="start_date" value="{{ old('start_date', $promo->start_date) }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">
            </div>
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                    End Date
                </label>
                <input type="date" name="end_date" value="{{ old('end_date', $promo->end_date) }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">
            </div>
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Status Active
            </label>
            <div class="flex items-center gap-3 bg-white/5 border border-white/10 p-3 rounded-xl">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $promo->is_active ? 'checked' : '' }} class="rounded border-white/10 bg-white/5 text-[#D2C1B6] focus:ring-0 w-4 h-4">
                <label for="is_active" class="text-xs text-white/80 font-bold cursor-pointer select-none">Show this promo on customer page</label>
            </div>
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Promo Banner Image
            </label>
            
            @if($promo->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $promo->image) }}" class="w-40 h-24 object-cover rounded-xl border border-white/10">
                </div>
            @endif

            <input type="file" name="image" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#D2C1B6] file:text-[#1B3C53] hover:file:bg-white transition">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Update Promo
            </button>
            <a href="{{ route('promos.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection