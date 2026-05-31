<h1>Create Booking</h1>

<form action="{{ route('bookings.store') }}" method="POST">

    @csrf

    <label>Schedule</label>

    <select name="schedule_id">

        @foreach($schedules as $schedule)

            <option value="{{ $schedule->id }}">
                {{ $schedule->movie->title }}
                -
                {{ $schedule->show_date }}
                -
                {{ $schedule->show_time }}
            </option>

        @endforeach

    </select>

    <br><br>

    <label>Seat</label>

    <select name="seat_id">

        @foreach($seats as $seat)

            <option value="{{ $seat->id }}">
                {{ $seat->seat_number }}
            </option>

        @endforeach

    </select>

    <br><br>

    <button type="submit">
        Book
    </button>

</form>