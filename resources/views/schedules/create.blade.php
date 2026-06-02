<h1>Add Schedule</h1>

<form method="POST" action="{{ route('schedules.store') }}">
    @csrf

    <select name="movie_id" class="w-full rounded-xl border border-gray-300 p-3">
        @foreach($movies as $movie)
            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
        @endforeach
    </select>

    <br><br>

    <select name="studio_id" class="w-full rounded-xl border border-gray-300 p-3">
        @foreach($studios as $studio)
            <option value="{{ $studio->id }}">{{ $studio->name }}</option>
        @endforeach
    </select>

    <br><br>

    <input type="date" name="show_date" class="w-full rounded-xl border border-gray-300 p-3">

    <br><br>

    <input type="time" name="show_time" class="w-full rounded-xl border border-gray-300 p-3">

    <br><br>

    <input type="number" name="price" class="w-full rounded-xl border border-gray-300 p-3">

    <br><br>

    <button class="rounded-xl bg-[#1B3C53] px-6 py-3 text-white">Save</button>
</form>