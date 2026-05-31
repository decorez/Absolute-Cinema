<h1>Edit Seat</h1>

<form action="{{ route('seats.update', $seat->id) }}" method="POST">

    @csrf
    @method('PUT')

    <input
        type="text"
        name="seat_number"
        value="{{ $seat->seat_number }}"
    >

    <button type="submit">
        Update
    </button>

</form>