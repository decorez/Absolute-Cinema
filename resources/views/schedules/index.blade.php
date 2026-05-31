<h1>Schedule List</h1>

<a href="{{ route('schedules.create') }}">
    Add Schedule
</a>

<hr>

@foreach($schedules as $schedule)

    <p>
        {{ $schedule->movie->title }}
    </p>

    <p>
        {{ $schedule->show_date }}
    </p>

    <p>
        {{ $schedule->show_time }}
    </p>

    <p>
        {{ $schedule->price }}
    </p>

    <a href="{{ route('schedules.edit', $schedule->id) }}">
        Edit
    </a>

    <form
        action="{{ route('schedules.destroy', $schedule->id) }}"
        method="POST"
    >
        @csrf
        @method('DELETE')

        <button type="submit">
            Delete
        </button>
    </form>

    <hr>

@endforeach