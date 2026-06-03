@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')

@if(session('success'))
    <div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-4 text-green-400 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <h2 class="text-3xl font-black tracking-tight text-white">
        All Customer Bookings
    </h2>
</div>

<div class="overflow-hidden rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
    <table class="w-full text-sm text-left text-white">
        <thead class="bg-white/5 border-b border-white/10 text-xs font-bold text-[#D2C1B6] uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4">Customer</th>
                <th class="px-6 py-4">Movie</th>
                <th class="px-6 py-4">Show Info</th>
                <th class="px-6 py-4">Seats</th>
                <th class="px-6 py-4">Total Price</th>
                <th class="px-6 py-4 text-center">Status</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($bookings as $booking)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4 font-bold text-white">
                        {{ $booking->user->name ?? 'Guest/Deleted' }}
                    </td>

                    <td class="px-6 py-4 text-white font-medium">
                        {{ $booking->schedule->movie->title }}
                    </td>

                    <td class="px-6 py-4 text-[#D2C1B6] text-xs space-y-0.5">
                        <p class="font-semibold text-white">{{ $booking->schedule->studio->name }}</p>
                        <p>{{ \Carbon\Carbon::parse($booking->schedule->show_date)->format('d M Y') }}</p>
                        <p>{{ \Carbon\Carbon::parse($booking->schedule->show_time)->format('H:i') }} WIB</p>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1 max-w-[180px]">
                            @foreach($booking->bookingDetails as $detail)
                                <span class="px-2 py-0.5 bg-white/10 text-white rounded text-xs border border-white/5">
                                    {{ $detail->seat->seat_number }}
                                </span>
                            @endforeach
                        </div>
                    </td>

                    <td class="px-6 py-4 text-[#D2C1B6] font-semibold">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="inline-block text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide
                            {{ $booking->status === 'paid' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-500/20 text-red-300 border border-red-500/30' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-amber-500/20 text-amber-300 border border-amber-500/30' : '' }}">
                            {{ $booking->status }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            @if($booking->status === 'pending')
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-3 py-1.5 text-xs font-bold text-emerald-400 hover:bg-emerald-500 hover:text-white transition">
                                        Approve
                                    </button>
                                </form>
                            @endif

                            @if($booking->status !== 'cancelled')
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="delete-form m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-xl bg-amber-500/10 border border-amber-500/20 px-3 py-1.5 text-xs font-bold text-amber-400 hover:bg-amber-500 hover:text-white transition">
                                        Cancel
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.bookings.forceDelete', $booking->id) }}" method="POST" class="delete-permanent-form m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl bg-red-500/10 border border-red-500/20 px-3 py-1.5 text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-12 text-center text-sm text-[#D2C1B6]/60">
                        No customer bookings found.
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
                title: 'Cancel this Booking?',
                text: "The seats will be released back to available status.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Yes, Cancel It',
                background: '#1B3C53',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    document.querySelectorAll('.delete-permanent-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Delete Permanently?',
                text: "This data will be wiped from database and cannot be recovered!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Yes, Delete data',
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