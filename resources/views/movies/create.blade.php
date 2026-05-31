<h1>Add Movie</h1>

<form method="POST" action="{{ route('movies.store') }}">

    @csrf

    <input type="text" name="title" placeholder="Title">

    <br><br>

    <textarea
        name="description"
        placeholder="Description"
    ></textarea>

    <br><br>

    <input type="text" name="genre" placeholder="Genre">

    <br><br>

    <input type="number" name="duration" placeholder="Duration">

    <br><br>

    <input type="date" name="release_date">

    <br><br>

    <button type="submit">
        Save
    </button>

</form>