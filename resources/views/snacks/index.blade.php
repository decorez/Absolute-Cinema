@extends('layouts.admin')

@section('title', 'Snacks')

@section('content')

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({icon: 'success', title: 'Success', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false});
    });
</script>
@endif

<div class="overflow-hidden rounded-2xl bg-white shadow-sm">

    <div class="flex items-center justify-between border-b p-6">

        <div>
            <h3 class="text-xl font-bold text-[#1B3C53]">
                Snack List
            </h3>

            <p class="text-sm text-gray-500">
                Manage snacks and beverages available at Absolute Cinema
            </p>
        </div>
        <a href="{{ route('snacks.create') }}" class="rounded-xl bg-[#234C6A] px-5 py-3 text-white transition hover:bg-[#1B3C53]">
            Add Snack
        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-[#1B3C53]">Name</th>
                    <th class="px-6 py-4 text-left font-semibold text-[#1B3C53]">Price</th>
                    <th class="px-6 py-4 text-left font-semibold text-[#1B3C53]">Stock</th>
                    <th class="px-6 py-4 text-center font-semibold text-[#1B3C53]">Action</th>
                </tr>

            </thead>
            <tbody>

                @forelse ($snacks as $snack)
                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $snack->name }}
                    </td>

                    <td class="px-6 py-4">
                        Rp {{ number_format($snack->price, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $snack->stock }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('snacks.edit', $snack->id) }}" class="rounded-xl bg-[#456882] px-4 py-2 text-white transition hover:opacity-90">
                                Edit
                            </a>
                            <form id="delete-form-{{ $snack->id }}" action="{{ route('snacks.destroy', $snack->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="confirmDelete('{{ $snack->id }}')" class="rounded-xl bg-red-500 px-4 py-2 text-white transition hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>
                @empty
                <tr>

                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                        No snack data available.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection

@section('scripts')

<script>
    function confirmDelete(id) {

        Swal.fire({
            title: 'Delete Snack?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            background: '#ffffff',
            color: '#1B3C53',
            showCancelButton: true,
            confirmButtonColor: '#1B3C53',
            cancelButtonColor: '#456882',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }

        });

    }
</script>

@endsection