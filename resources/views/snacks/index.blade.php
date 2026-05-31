<h1>Snack List</h1>

<a href="{{ route('snacks.create') }}">
    Add Snack
</a>

<hr>

@foreach($snacks as $snack)

    <p>{{ $snack->name }}</p>

    <p>{{ $snack->price }}</p>

    <p>{{ $snack->stock }}</p>

    <a href="{{ route('snacks.edit', $snack->id) }}">
        Edit
    </a>

    <form action="{{ route('snacks.destroy', $snack->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">
            Delete
        </button>
    </form>

    <hr>

@endforeach