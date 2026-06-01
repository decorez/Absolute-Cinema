@extends('layouts.admin')

@section('title', 'Add Snack')

@section('content')

<div class="max-w-2xl rounded-2xl bg-white p-8 shadow-sm">

    <h3 class="mb-6 text-2xl font-bold text-[#1B3C53]">
        Add New Snack
    </h3>

    <form action="{{ route('snacks.store') }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="mb-2 block font-medium text-[#1B3C53]">
                Snack Name
            </label>

            <input type="text"
                name="name"
                class="w-full rounded-xl border border-gray-300 p-3 focus:border-[#234C6A] focus:outline-none">

        </div>
        <div class="mb-5">

            <label class="mb-2 block font-medium text-[#1B3C53]">
                Price
            </label>
            <input type="number"
                name="price"
                class="w-full rounded-xl border border-gray-300 p-3 focus:border-[#234C6A] focus:outline-none">

        </div>
        <div class="mb-6">

            <label class="mb-2 block font-medium text-[#1B3C53]">
                Stock
            </label>

            <input type="number"
                name="stock"
                class="w-full rounded-xl border border-gray-300 p-3 focus:border-[#234C6A] focus:outline-none">

        </div>
        <button type="submit" class="rounded-xl bg-[#234C6A] px-6 py-3 text-white transition hover:bg-[#1B3C53]">
            Save Snack

        </button>
    </form>

</div>
@endsection