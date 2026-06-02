@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Seat List</h1>

<a href="{{ route('seats.create') }}" class="rounded-xl bg-[#1B3C53] px-5 py-3 text-white">+ Generate Seats</a>

<br><br>

@foreach($seats->groupBy('studio_id') as $studioSeats)

    <h2 class="text-xl font-bold mt-6">{{ $studioSeats->first()->studio->name }}</h2>

    <div class="grid grid-cols-10 gap-2 mt-3">

        @foreach($studioSeats as $seat)

            <div class="rounded-lg bg-[#1B3C53] text-white p-2 text-center">
                {{ $seat->seat_number }}
            </div>

        @endforeach

    </div>

    <hr class="my-6">

@endforeach

@endsection