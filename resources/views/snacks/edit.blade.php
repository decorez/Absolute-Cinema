<h1>Edit Snack</h1>

<form action="{{ route('snacks.update', $snack->id) }}" method="POST">

    @csrf
    @method('PUT')

    <input
        type="text"
        name="name"
        value="{{ $snack->name }}"
    >

    <br><br>

    <input
        type="number"
        name="price"
        value="{{ $snack->price }}"
    >

    <br><br>

    <input
        type="number"
        name="stock"
        value="{{ $snack->stock }}"
    >

    <br><br>

    <button type="submit">
        Update
    </button>

</form>