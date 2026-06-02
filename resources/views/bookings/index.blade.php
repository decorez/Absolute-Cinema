@extends('layouts.admin')

@section('title', 'Bookings')

@section('content')

<div class="flex items-center justify-between mb-6">

    <h2 class="text-3xl font-bold text-[#1B3C53]">
        Booking List
    </h2>

    <a href="{{ route('bookings.create') }}"
        class="rounded-xl bg-[#234C6A] px-5 py-3 text-white hover:bg-[#1B3C53] transition">
        Create Booking
    </a>

</div>

<div class="bg-white rounded-2xl shadow-sm p-6">

    @forelse($bookings as $booking)

    <div class="border-b py-5">

        <p class="font-semibold text-lg text-[#1B3C53]">
            {{ $booking->schedule->movie->title }}
        </p>

        <p class="text-gray-500">
            {{ $booking->schedule->show_date }} |
            {{ $booking->schedule->show_time }}
        </p>

        <p class="mt-2 font-medium text-gray-700">
            Seats:
        </p>

        <div class="flex flex-wrap gap-2 mt-2">

            @foreach($booking->bookingDetails as $detail)

            <span class="px-3 py-1 bg-[#234C6A] text-white rounded-lg text-sm">
                {{ $detail->seat->seat_number }}
            </span>

            @endforeach

        </div>

        <form action="{{ route('bookings.destroy', $booking->id) }}"
            method="POST"
            class="mt-4">

            @csrf
            @method('DELETE')

            <button type="submit"
                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Cancel Booking
            </button>

        </form>

    </div>

    @empty

    <p class="text-center text-gray-500 py-10">
        No bookings found.
    </p>

    @endforelse

</div>

@endsection