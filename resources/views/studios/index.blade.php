@extends('layouts.admin')

@section('title', 'Manage Studios')

@section('content')

@if(session('success'))
<div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-4 text-green-400 text-sm font-medium">
    {{ session('success') }}
</div>
@endif

<div class="flex items-center justify-between mb-6">
    <h2 class="text-3xl font-black tracking-tight text-white">
        Cinema Studios
    </h2>
    <a href="{{ route('studios.create') }}"
        class="rounded-xl bg-[#D2C1B6] px-5 py-2.5 text-xs font-bold text-[#1B3C53] transition hover:scale-105 shadow-lg shadow-black/20">
        + Add Studio
    </a>
</div>

<div class="overflow-hidden rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
    <table class="w-full text-sm text-left text-white">
        <thead class="bg-white/5 border-b border-white/10 text-xs font-bold text-[#D2C1B6] uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4">Studio Name</th>
                <th class="px-6 py-4">Studio Type</th>
                <th class="px-6 py-4">Seat Capacity</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($studios as $studio)
            <tr class="hover:bg-white/5 transition">
                <td class="px-6 py-4 font-bold text-white text-base">
                    {{ $studio->name }}
                </td>
                <td class="px-6 py-4">
                    <span class="inline-block text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide
                            {{ $studio->type === 'IMAX' ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-500/30' : '' }}
                            {{ $studio->type === 'Dolby Atmos' ? 'bg-indigo-500/20 text-indigo-300 border border-indigo-500/30' : '' }}
                            {{ $studio->type === 'The Premiere' || $studio->type === 'Premiere' ? 'bg-amber-500/20 text-amber-300 border border-amber-500/30' : '' }}
                            {{ $studio->type === 'Deluxe' ? 'bg-gray-500/20 text-gray-300 border border-gray-500/30' : '' }}">
                        {{ $studio->type }}
                    </span>
                </td>
                <td class="px-6 py-4 font-semibold text-[#D2C1B6]">
                    {{ $studio->capacity }} Seats
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('studios.edit', $studio->id) }}"  class="rounded-xl bg-amber-500/10 border border-amber-500/20 px-4 py-2 text-xs font-bold text-amber-400 hover:bg-amber-500 hover:text-white transition">
                            Edit
                        </a>

                        <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" class="delete-form m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded-xl bg-red-500/10 border border-red-500/20 px-4 py-2 text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-12 text-center text-sm text-[#D2C1B6]/60">
                    No studios created yet.
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
                title: 'Delete Studio?',
                text: 'This studio and its seat configurations will be permanently removed.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Yes, Delete It',
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