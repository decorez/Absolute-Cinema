<h1>Edit Schedule</h1>

<form
    method="POST"
    action="{{ route('schedules.update', $schedule->id) }}"
>

    @csrf
    @method('PUT')

    <label>Movie</label>

    <select name="movie_id">

        @foreach($movies as $movie)

            <option
                value="{{ $movie->id }}"
                {{ $schedule->movie_id == $movie->id ? 'selected' : '' }}
            >
                {{ $movie->title }}
            </option>

        @endforeach

    </select>

    <br><br>

    <label>Date</label>

    <input
        type="date"
        name="show_date"
        value="{{ $schedule->show_date }}"
    >

    <br><br>

    <label>Time</label>

    <input
        type="time"
        name="show_time"
        value="{{ $schedule->show_time }}"
    >

    <br><br>

    <label>Price</label>

    <input
        type="number"
        name="price"
        value="{{ $schedule->price }}"
    >

    <br><br>

    <button type="submit">
        Update Schedule
    </button>

</form>