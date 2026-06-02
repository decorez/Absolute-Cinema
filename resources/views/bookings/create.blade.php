@extends('layouts.admin')

@section('title', 'Select Seats')

@section('content')

<h2 class="text-3xl font-bold text-[#1B3C53] mb-2">
    {{ $schedule->movie->title }}
</h2>

<p class="text-gray-500 mb-6">
    {{ $schedule->show_date }} | {{ $schedule->show_time }}
</p>

<form action="{{ route('booking.store', $schedule->id) }}" method="POST">
    @csrf

    <div class="bg-white p-6 rounded-2xl shadow-sm">

        <div class="text-center mb-6 text-gray-500">
            SCREEN
        </div>

        <div class="grid grid-cols-10 gap-3 mb-6">

            @foreach($schedule->seats as $seat)

            <label>

                <input type="checkbox" name="seats[]" value="{{ $seat->id }}" class="hidden peer" {{ $seat->is_booked ? 'disabled' : '' }}>

                <div class="w-10 h-10 flex items-center justify-center rounded text-white cursor-pointer
                        {{ $seat->is_booked ? 'bg-red-500 cursor-not-allowed' : 'bg-green-500 peer-checked:bg-yellow-400' }}">

                    {{ $seat->seat_number }}

                </div>

            </label>

            @endforeach

        </div>

        <button type="submit" class="w-full py-3 bg-[#234C6A] text-white rounded-xl hover:bg-[#1B3C53]">

            Book Selected Seats

        </button>

    </div>

</form>

@endsection