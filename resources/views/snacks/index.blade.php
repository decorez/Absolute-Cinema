@extends('layouts.admin')

@section('title', 'Snacks')

@section('content')

@if(session('success'))
    <div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-4 text-green-400 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <h2 class="text-3xl font-black tracking-tight text-white">
        Snack List
    </h2>

    <a href="{{ route('snacks.create') }}"
       class="rounded-xl bg-[#D2C1B6] px-5 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
        Add Snack
    </a>
</div>

<div class="overflow-hidden rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
    <table class="w-full text-sm text-left text-white">
        <thead class="bg-white/5 border-b border-white/10 text-xs font-bold text-[#D2C1B6] uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4">Image</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Category</th>
                <th class="px-6 py-4">Price</th>
                <th class="px-6 py-4">Stock</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-white/5">
            @forelse($snacks as $snack)
                <tr class="hover:bg-white/5 transition">

                    <td class="px-6 py-4">
                        @if($snack->image)
                            <img
                                src="{{ $snack->image }}" alt="{{ $snack->name }}"
                                alt="{{ $snack->name }}"
                                class="w-20 h-20 object-cover rounded-xl border border-white/10"
                            >
                        @else
                            <div class="w-20 h-20 rounded-xl bg-white/5 flex items-center justify-center text-xs text-gray-400">
                                No Image
                            </div>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-bold text-white">
                        {{ $snack->name }}
                    </td>

                    <td class="px-6 py-4 text-[#D2C1B6]">
                        {{ $snack->category }}
                    </td>

                    <td class="px-6 py-4 text-[#D2C1B6]">
                        Rp {{ number_format($snack->price, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4 text-[#D2C1B6]">
                        {{ $snack->stock }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('snacks.edit', $snack->id) }}"
                               class="rounded-xl bg-yellow-500/10 border border-yellow-500/20 px-4 py-2 text-xs font-bold text-yellow-400 hover:bg-yellow-500 hover:text-white transition">
                                Edit
                            </a>

                            <form action="{{ route('snacks.destroy', $snack->id) }}"
                                  method="POST"
                                  class="delete-form m-0">
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
                    <td colspan="5" class="py-12 text-center text-sm text-[#D2C1B6]/60">
                        No snacks found.
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
                title: 'Delete Snack?',
                text: 'This snack will be permanently removed.',
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