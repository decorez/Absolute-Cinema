<h1>Add Seat</h1>

<form action="{{ route('seats.store') }}" method="POST">

    @csrf

    <input
        type="text"
        name="seat_number"
        placeholder="A1"
    >

    <button type="submit">
        Save
    </button>

</form>