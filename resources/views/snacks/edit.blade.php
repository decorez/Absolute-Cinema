@extends('layouts.admin')

@section('title', 'Edit Snack')

@section('content')

<div class="max-w-2xl rounded-2xl bg-white p-8 shadow-sm">

    <h3 class="mb-6 text-2xl font-bold text-[#1B3C53]">
        Edit Snack
    </h3>

    <form action="{{ route('snacks.update', $snack->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="mb-2 block font-medium text-[#1B3C53]">
                Snack Name
            </label>
            <input type="text" name="name" value="{{ $snack->name }}" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">

            <label class="mb-2 block font-medium text-[#1B3C53]">
                Price
            </label>

            <input type="number" name="price" value="{{ $snack->price }}" class="w-full rounded-xl border border-gray-300 p-3">

        </div>

        <div class="mb-6">

            <label class="mb-2 block font-medium text-[#1B3C53]">
                Stock
            </label>

            <input type="number" name="stock" value="{{ $snack->stock }}" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <button type="submit" class="rounded-xl bg-[#456882] px-6 py-3 text-white transition hover:opacity-90">

            Update Snack

        </button>
    </form>
</div>
@endsection