<h1>Add Snack</h1>

<form action="{{ route('snacks.store') }}" method="POST">

    @csrf

    <input type="text" name="name" placeholder="Snack Name">

    <br><br>

    <input type="number" name="price" placeholder="Price">

    <br><br>

    <input type="number" name="stock" placeholder="Stock">

    <br><br>

    <button type="submit">
        Save
    </button>

</form>