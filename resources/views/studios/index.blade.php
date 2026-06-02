@extends('layouts.admin')

@section('title', 'Studios')

@section('content')

<div class="flex items-center justify-between mb-6">

    <h2 class="text-3xl font-bold text-[#1B3C53]">
        Studio List
    </h2>

    <a href="{{ route('studios.create') }}"
       class="rounded-xl bg-[#234C6A] px-5 py-3 text-white transition hover:bg-[#1B3C53]">
        Add Studio
    </a>

</div>

<div class="overflow-hidden rounded-2xl bg-white shadow-sm">

    <table class="w-full">

        <thead class="bg-gray-50 border-b">

            <tr>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Studio
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Capacity
                </th>

                <th class="px-6 py-4 text-center font-semibold text-gray-600">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($studios as $studio)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-6 py-4 font-medium text-gray-800">
                    {{ $studio->name }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    {{ $studio->capacity }} Seats
                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center gap-3">

                        <a href="{{ route('studios.edit', $studio->id) }}"
                           class="rounded-lg bg-yellow-400 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-500">
                            Edit
                        </a>

                        <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600">
                                Delete
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="3" class="py-10 text-center text-gray-500">
                    No studios found.
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
            text: 'This studio will be permanently removed.',
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