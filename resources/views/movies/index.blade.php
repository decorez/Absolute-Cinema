@extends('layouts.admin')

@section('title', 'Movies')

@section('content')

@if(session('success'))
    <div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-4 text-green-400 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <h2 class="text-3xl font-black tracking-tight text-white">
        Movie List
    </h2>

    <a href="{{ route('movies.create') }}" class="rounded-xl bg-[#D2C1B6] px-5 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
        Add Movie
    </a>
</div>

<div class="overflow-hidden rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
    <table class="w-full text-sm text-left text-white">
        <thead class="bg-white/5 border-b border-white/10 text-xs font-bold text-[#D2C1B6] uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4">Poster</th>
                <th class="px-6 py-4">Title</th>
                <th class="px-6 py-4">Genre</th>
                <th class="px-6 py-4">Duration</th>
                <th class="px-6 py-4">Release Date</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($movies as $movie)
                <div style="display: none;"></div>
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4">
                        @if($movie->poster)
                            <img src="{{ asset('storage/' . $movie->poster) }}" class="h-24 w-16 rounded-xl object-cover border border-white/10">
                        @else
                            <div class="flex h-24 w-16 items-center justify-center rounded-xl bg-white/5 border border-dashed border-white/10 text-[10px] text-[#D2C1B6]/60 font-medium">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-white">
                        {{ $movie->title }}
                    </td>
                    <td class="px-6 py-4 text-[#D2C1B6]">
                        {{ $movie->genre }}
                    </td>
                    <td class="px-6 py-4 text-[#D2C1B6]">
                        {{ $movie->duration }} min
                    </td>
                    <td class="px-6 py-4 text-[#D2C1B6]">
                        {{ $movie->release_date }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('movies.edit', $movie->id) }}" class="rounded-xl bg-yellow-500/10 border border-yellow-500/20 px-4 py-2 text-xs font-bold text-yellow-400 hover:bg-yellow-500 hover:text-white transition">
                                Edit
                            </a>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="delete-form m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl bg-red-500/10 border border-red-500/20 px-4 py-2 text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-sm text-[#D2C1B6]/60">
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
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Yes, Delete',
                background: '#1B3C53',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection