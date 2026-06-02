@extends('layouts.admin')

@section('title', 'Edit Seat')

@section('content')

<div class="max-w-xl bg-white p-8 rounded-2xl shadow-sm">

    <h2 class="text-3xl font-bold text-[#1B3C53] mb-6">
        Edit Seat
    </h2>

    <form action="{{ route('seats.update', $seat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block mb-2 font-medium text-[#1B3C53]">
                Seat Number
            </label>

            <input type="text"
                   name="seat_number"
                   value="{{ $seat->seat_number }}"
                   class="w-full border rounded-xl p-3">

        </div>

        <button type="submit"
                class="rounded-xl bg-[#234C6A] px-6 py-3 text-white hover:bg-[#1B3C53]">
            Update
        </button>

    </form>

</div>

@endsection