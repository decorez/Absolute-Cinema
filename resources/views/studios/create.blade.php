@extends('layouts.admin')

@section('title', 'Add Studio')

@section('content')

<div class="max-w-2xl">

    <h1 class="mb-6 text-3xl font-bold text-[#1B3C53]">Add Studio</h1>

    <form action="{{ route('studios.store') }}" method="POST">

        @csrf

        <div class="mb-5">
            <label class="mb-2 block font-medium">Studio Name</label>
            <input type="text" name="name" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <div class="mb-5">
            <label class="mb-2 block font-medium">Capacity</label>
            <input type="number" name="capacity" class="w-full rounded-xl border border-gray-300 p-3">
        </div>

        <button type="submit" class="rounded-xl bg-[#1B3C53] px-6 py-3 text-white hover:bg-[#234C6A]">Save Studio</button>

    </form>

</div>

@endsection