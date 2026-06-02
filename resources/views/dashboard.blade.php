@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-500">
            Total Movies
        </h3>

        <p class="text-4xl font-bold mt-2">
            {{ $totalMovies }}
        </p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-500">
            Total Schedules
        </h3>

        <p class="text-4xl font-bold mt-2">
            {{ $totalSchedules }}
        </p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-500">
            Total Snacks
        </h3>

        <p class="text-4xl font-bold mt-2">
            {{ $totalSnacks }}
        </p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-500">
            Total Bookings
        </h3>

        <p class="text-4xl font-bold mt-2">
            {{ $totalBookings }}
        </p>
    </div>

</div>

@endsection