<h1>Booking List</h1>

<a href="{{ route('bookings.create') }}">
    Create Booking
</a>

<hr>

@foreach($bookings as $booking)

    <p>
        Movie:
        {{ $booking->schedule->movie->title }}
    </p>

    <p>
        Date:
        {{ $booking->schedule->show_date }}
    </p>

    <p>
        Time:
        {{ $booking->schedule->show_time }}
    </p>
    
    <p>
        Seats:
    </p>

    <ul>

        @foreach($booking->bookingDetails as $detail)

            <li>
                {{ $detail->seat->seat_number }}
            </li>

        @endforeach

    </ul>

    <form
        action="{{ route('bookings.destroy', $booking->id) }}"
        method="POST"
    >

        @csrf
        @method('DELETE')

        <button type="submit">
            Cancel Booking
        </button>

    </form>

    <hr>

@endforeach