<h1>Edit Schedule</h1>

<form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
    @csrf
    @method('PUT')

    <select name="movie_id" class="w-full rounded-xl border border-gray-300 p-3">
        @foreach($movies as $movie)
            <option value="{{ $movie->id }}" {{ $schedule->movie_id == $movie->id ? 'selected' : '' }}>
                {{ $movie->title }}
            </option>
        @endforeach
    </select>

    <br><br>

    <select name="studio_id" class="w-full rounded-xl border border-gray-300 p-3">
        @foreach($studios as $studio)
            <option value="{{ $studio->id }}" {{ $schedule->studio_id == $studio->id ? 'selected' : '' }}>
                {{ $studio->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <input type="date" name="show_date" value="{{ $schedule->show_date }}" class="w-full rounded-xl border border-gray-300 p-3">

    <br><br>

    <input type="time" name="show_time" value="{{ $schedule->show_time }}" class="w-full rounded-xl border border-gray-300 p-3">

    <br><br>

    <input type="number" name="price" value="{{ $schedule->price }}" class="w-full rounded-xl border border-gray-300 p-3">

    <br><br>

    <button class="rounded-xl bg-[#1B3C53] px-6 py-3 text-white">Update</button>
</form>