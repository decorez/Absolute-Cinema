@extends('layouts.admin')

@section('title', 'Schedules')

@section('content')

<div class="flex items-center justify-between mb-6">

    <h2 class="text-3xl font-bold text-[#1B3C53]">
        Schedule List
    </h2>

    <a href="{{ route('schedules.create') }}"
       class="rounded-xl bg-[#234C6A] px-5 py-3 text-white transition hover:bg-[#1B3C53]">
        Add Schedule
    </a>

</div>

<div class="overflow-hidden rounded-2xl bg-white shadow-sm">

    <table class="w-full">

        <thead class="bg-gray-50 border-b">

            <tr>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Movie
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Studio
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Date
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Time
                </th>

                <th class="px-6 py-4 text-left font-semibold text-gray-600">
                    Price
                </th>

                <th class="px-6 py-4 text-center font-semibold text-gray-600">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($schedules as $schedule)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-6 py-4 font-medium text-gray-800">
                    {{ $schedule->movie->title }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    {{ $schedule->studio->name }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    {{ $schedule->show_date }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    {{ $schedule->show_time }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    Rp {{ number_format($schedule->price, 0, ',', '.') }}
                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center gap-3">

                        <a href="{{ route('schedules.edit', $schedule->id) }}"
                           class="rounded-lg bg-yellow-400 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-500">
                            Edit
                        </a>

                        <form action="{{ route('schedules.destroy', $schedule->id) }}"
                              method="POST"
                              class="delete-form">

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
                <td colspan="6" class="py-10 text-center text-gray-500">
                    No schedules found.
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
            title: 'Delete Schedule?',
            text: 'This schedule will be permanently removed.',
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