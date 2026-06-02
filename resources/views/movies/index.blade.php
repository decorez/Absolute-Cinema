@extends('layouts.admin')

@section('title', 'Movies')

@section('content')

<div class="flex items-center justify-between mb-6">

    <h2 class="text-3xl font-bold text-[#1B3C53]">
        Movie List
    </h2>

    <a href="{{ route('movies.create') }}" class="rounded-xl bg-[#234C6A] px-5 py-3 text-white transition hover:bg-[#1B3C53]">
        Add Movie
    </a>

</div>

<div class="overflow-hidden rounded-2xl bg-white shadow-sm">

    <table class="w-full">

        <thead class="bg-gray-50 border-b">

            <tr>
                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Poster
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Title
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Genre
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Duration
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Release Date
                </th>

                <th class="px-6 py-4 text-center font-semibold text-gray-600">
                    Action
                </th>
            </tr>

        </thead>

        <tbody>

            @forelse($movies as $movie)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-6 py-4">

                        @if($movie->poster)

                            <img src="{{ asset('storage/' . $movie->poster) }}" class="h-24 w-16 rounded-lg object-cover">
                        @else
                            <div class="flex h-24 w-16 items-center justify-center rounded-lg bg-gray-200 text-xs text-gray-500">
                                No Image
                            </div>

                        @endif

                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $movie->title }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $movie->genre }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $movie->duration }} min
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $movie->release_date }}
                    </td>

                    <td class="px-6 py-4">

                        <div class="flex justify-center gap-3">

                            <a href="{{ route('movies.edit', $movie->id) }}" class="rounded-lg bg-yellow-400 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-500">
                                Edit
                            </a>

                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="delete-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty

                <tr>

                    <td colspan="6" class="py-10 text-center text-gray-500">
                        No movies found.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Delete Movie?',
                text: "This movie will be permanently removed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

</script>

@endsection