@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
<div class="min-h-screen bg-[#1B3C53] py-10 px-4" x-data="{ activeTab: 'movies' }">
    <div class="max-w-4xl mx-auto">

        <a href="{{ url('/') }}"
           class="inline-flex items-center text-xs text-[#D2C1B6] hover:text-white transition font-bold uppercase tracking-widest">
            ← Back
        </a>

        <h2 class="text-3xl font-black text-white mb-6 mt-2">My Tickets</h2>

        <div class="flex gap-2 mb-6">
            <button @click="activeTab = 'movies'"
                :class="activeTab === 'movies' ? 'bg-[#D2C1B6] text-[#1B3C53]' : 'bg-white/5 text-white border border-white/10'"
                class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition">
                🎬 Movies
            </button>
            <button @click="activeTab = 'snacks'"
                :class="activeTab === 'snacks' ? 'bg-[#D2C1B6] text-[#1B3C53]' : 'bg-white/5 text-white border border-white/10'"
                class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition">
                🍿 Snack Orders
            </button>
        </div>

        <div x-show="activeTab === 'movies'" x-transition>
            <div class="grid gap-4">
                @php $movieBookings = $bookings->filter(fn($b) => $b->schedule && $b->schedule->movie); @endphp

                @forelse($movieBookings as $booking)
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-white">
                            {{ $booking->schedule->movie->title }}
                        </h3>
                        <p class="text-[#D2C1B6] text-sm">
                            {{ \Carbon\Carbon::parse($booking->schedule->show_date)->format('d M Y') }}
                            | {{ \Carbon\Carbon::parse($booking->schedule->show_time)->format('H:i') }} WIB
                        </p>

                        @if($booking->bookingDetails && $booking->bookingDetails->count())
                            <div class="mt-2">
                                @foreach($booking->bookingDetails as $detail)
                                    <span class="bg-white/10 px-2 py-1 rounded text-xs mr-1 text-white">
                                        {{ optional($detail->seat)->seat_number }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        @if($booking->snacks && $booking->snacks->count())
                            <div class="mt-3">
                                @foreach($booking->snacks as $snack)
                                    <span class="bg-white/10 px-2 py-1 rounded text-xs mr-1 text-white inline-block mb-1">
                                        {{ $snack->name }} x{{ $snack->pivot->quantity }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="text-right">
                        <span class="block text-lg font-bold text-white mb-2">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>
                        <div class="flex gap-2 justify-end items-center">
                            @if($booking->status === 'pending')
                                <a href="{{ route('bookings.checkout-promo', $booking->id) }}"
                                   class="bg-[#D2C1B6] text-[#1B3C53] px-4 py-1.5 rounded-lg text-xs font-bold hover:scale-105 transition uppercase">
                                    Pay Now
                                </a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="cancel-form m-0 inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition uppercase">
                                        Cancel
                                    </button>
                                </form>
                            @endif
                            <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase
                                {{ $booking->status === 'paid' ? 'bg-emerald-500/20 text-emerald-400'
                                    : ($booking->status === 'cancelled' ? 'bg-red-500/20 text-red-400'
                                    : 'bg-amber-500/20 text-amber-400') }}">
                                {{ $booking->status }}
                            </span>
                            @if($booking->status === 'paid')
                                <a href="{{ route('bookings.ticket', $booking->id) }}"
                                   class="bg-white/10 text-white border border-white/20 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-white/20 transition uppercase">
                                    🎟 Ticket
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 text-[#D2C1B6]">
                    No movie tickets found.
                </div>
                @endforelse
            </div>
        </div>

        <div x-show="activeTab === 'snacks'" x-transition>
            <div class="grid gap-4">
                @php $snackBookings = $bookings->filter(fn($b) => !$b->schedule || !$b->schedule->movie); @endphp

                @forelse($snackBookings as $booking)
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-white">Snack Order</h3>
                        @if($booking->snacks && $booking->snacks->count())
                            <div class="mt-2">
                                @foreach($booking->snacks as $snack)
                                    <span class="bg-white/10 px-2 py-1 rounded text-xs mr-1 text-white inline-block mb-1">
                                        {{ $snack->name }} x{{ $snack->pivot->quantity }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="text-right">
                        <span class="block text-lg font-bold text-white mb-2">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>
                        <div class="flex gap-2 justify-end items-center">
                            @if($booking->status === 'pending')
                                <a href="{{ route('bookings.checkout-promo', $booking->id) }}"
                                   class="bg-[#D2C1B6] text-[#1B3C53] px-4 py-1.5 rounded-lg text-xs font-bold hover:scale-105 transition uppercase">
                                    Pay Now
                                </a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="cancel-form m-0 inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500/10 text-red-400 border border-red-500/20 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition uppercase">
                                        Cancel
                                    </button>
                                </form>
                            @endif
                            <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase
                                {{ $booking->status === 'paid' ? 'bg-emerald-500/20 text-emerald-400'
                                    : ($booking->status === 'cancelled' ? 'bg-red-500/20 text-red-400'
                                    : 'bg-amber-500/20 text-amber-400') }}">
                                {{ $booking->status }}
                            </span>
                            @if($booking->status === 'paid')
                                <a href="{{ route('bookings.ticket', $booking->id) }}"
                                   class="bg-white/10 text-white border border-white/20 px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-white/20 transition uppercase">
                                    🎟 Ticket
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 text-[#D2C1B6]">
                    No snack orders found.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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