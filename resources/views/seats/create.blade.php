@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Generate Seats</h1>

<form method="POST" action="{{ route('seats.store') }}">
    @csrf

    <select name="studio_id" class="w-full rounded-xl border border-gray-300 p-3 mb-4">
        @foreach($studios as $studio)
            <option value="{{ $studio->id }}">{{ $studio->name }}</option>
        @endforeach
    </select>

    <input type="number" name="rows" placeholder="Rows" class="w-full rounded-xl border border-gray-300 p-3 mb-4">

    <input type="number" name="cols" placeholder="Columns" class="w-full rounded-xl border border-gray-300 p-3 mb-4">

    <button class="rounded-xl bg-[#1B3C53] px-6 py-3 text-white">Generate</button>

</form>

@endsection