<h1>Movie List</h1>

<a href="{{ route('movies.create') }}">
    Add Movie
</a>

<hr>

@foreach($movies as $movie)
    <h2>{{ $movie->title }}</h2>
    <p>{{ $movie->genre }}</p>
    <p>{{ $movie->duration }}</p>
    <p>{{ $movie->release_date }}</p>
    <a href="{{ route('movies.edit', $movie->id) }}">
        Edit
    </a>
    <form
        action="{{ route('movies.destroy', $movie->id) }}"
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