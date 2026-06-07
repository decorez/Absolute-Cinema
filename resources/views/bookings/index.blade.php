@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
<div class="min-h-screen bg-[#1B3C53] py-10 px-4">
    <div class="max-w-4xl mx-auto">

        <a href="{{ url('/') }}"
           class="inline-flex items-center text-xs text-[#D2C1B6] hover:text-white transition font-bold uppercase tracking-widest">
            ← Back
        </a>

        <h2 class="text-3xl font-black text-white mb-8">My Tickets</h2>

        <div class="grid gap-4">
            @forelse($bookings as $booking)

                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl flex flex-wrap items-center justify-between gap-4">

                    <div>

                        @if($booking->schedule && $booking->schedule->movie)

                            <h3 class="text-xl font-bold text-white">
                                {{ $booking->schedule->movie->title }}
                            </h3>

                            <p class="text-[#D2C1B6] text-sm">
                                {{ $booking->schedule->show_date }}
                                |
                                {{ $booking->schedule->show_time }}
                            </p>

                            @if($booking->bookingDetails->count())
                                <div class="mt-2">
                                    @foreach($booking->bookingDetails as $detail)
                                        <span class="bg-white/10 px-2 py-1 rounded text-xs mr-1 text-white">
                                            {{ optional($detail->seat)->seat_number }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                        @else

                            <h3 class="text-xl font-bold text-white">
                                Booking #{{ $booking->id }}
                            </h3>

                            <p class="text-[#D2C1B6] text-sm">
                                No schedule attached
                            </p>

                        @endif

                    </div>

                    <div class="text-right">

                        <span class="block text-lg font-bold text-white mb-2">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>

                        <div class="flex gap-2 justify-end items-center">

                            @if($booking->status === 'pending')

                                <a href="{{ route('bookings.qr', $booking->id) }}"
                                   class="bg-[#D2C1B6] text-[#1B3C53] px-4 py-1.5 rounded-lg text-xs font-bold hover:scale-105 transition uppercase">
                                    Pay Now
                                </a>

                                <form action="{{ route('bookings.destroy', $booking->id) }}"
                                      method="POST"
                                      class="cancel-form m-0 inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition uppercase">
                                        Cancel
                                    </button>
                                </form>

                            @endif

                            <span
                                class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase
                                {{ $booking->status === 'paid'
                                    ? 'bg-emerald-500/20 text-emerald-400'
                                    : ($booking->status === 'cancelled'
                                        ? 'bg-red-500/20 text-red-400'
                                        : 'bg-amber-500/20 text-amber-400') }}">
                                {{ $booking->status }}
                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-20 text-[#D2C1B6]">
                    No tickets found.
                </div>

            @endforelse
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.cancel-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Cancel Booking?',
            text: 'Your seat will be released again.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4b5563',
            confirmButtonText: 'Yes, cancel it',
            cancelButtonText: 'No',
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