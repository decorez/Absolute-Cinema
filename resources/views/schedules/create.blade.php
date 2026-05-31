<h1>Add Schedule</h1>

<form method="POST" action="{{ route('schedules.store') }}">

    @csrf

    <select name="movie_id">

        @foreach($movies as $movie)

            <option value="{{ $movie->id }}">
                {{ $movie->title }}
            </option>

        @endforeach

    </select>

    <br><br>

    <input type="date" name="show_date">

    <br><br>

    <input type="time" name="show_time">

    <br><br>

    <input type="number" name="price">

    <br><br>

    <button type="submit">
        Save
    </button>

</form>