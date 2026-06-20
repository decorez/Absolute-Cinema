@extends('layouts.admin')

@section('title', 'Edit Snack')

@section('content')
<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h3 class="mb-6 text-2xl font-bold tracking-tight text-white">
        Edit Snack
    </h3>

    <form action="{{ route('snacks.update', $snack->id) }}" method="POST" enctype="multipart/form-data" class="m-0">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Snack Name
            </label>
            <input type="text" name="name" value="{{ $snack->name }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Category
            </label>

            <select
                name="category"
                class="w-full rounded-xl bg-[#234C6A] border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                <option value="">Select Category</option>
                <option value="Popcorn"
                    {{ $snack->category == 'Popcorn' ? 'selected' : '' }}>
                    Popcorn
                </option>
                <option value="Beverage"
                    {{ $snack->category == 'Beverage' ? 'selected' : '' }}>
                    Beverage
                </option>
                <option value="Sides"
                    {{ $snack->category == 'Sides' ? 'selected' : '' }}>
                    Sides
                </option>
            </select>
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Snack Image
            </label>

            @if($snack->image)
            <div class="mb-3">
                <img src="{{ $snack->image }}" alt="{{ $snack->name }}" class="w-20 h-20 object-cover rounded-xl border border-white/10">
            </div>
            @endif

            <input type="file" name="image" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#D2C1B6] file:text-[#1B3C53] hover:file:bg-white transition">
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Price
            </label>
            <input type="number" name="price" value="{{ $snack->price }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Stock
            </label>
            <input type="number" name="stock" value="{{ $snack->stock }}" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Update Snack
            </button>
            <a href="{{ route('snacks.admin') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection