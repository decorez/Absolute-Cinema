@extends('layouts.admin')

@section('title', 'Edit Snack')

@section('content')
<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h3 class="mb-6 text-2xl font-bold tracking-tight text-white">
        Edit Snack
    </h3>

    <form action="{{ route('snacks.update', $snack->id) }}" method="POST" class="m-0">
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
            <a href="{{ route('snacks.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection