<h1>Seats</h1>

<a href="{{ route('seats.create') }}">
    Add Seat
</a>

<hr>

@foreach($seats as $seat)

    <p>{{ $seat->seat_number }}</p>

    <a href="{{ route('seats.edit', $seat->id) }}">
        Edit
    </a>

    <form action="{{ route('seats.destroy', $seat->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">
            Delete
        </button>
    </form>

    <hr>

@endforeach