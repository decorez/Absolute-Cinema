@extends('layouts.app') {{-- Pastikan kamu punya layout ini, atau gunakan layout user biasa --}}

@section('title', 'My Tickets')

@section('content')
<div class="min-h-screen bg-[#1B3C53] py-10 px-4">
    <div class="max-w-4xl mx-auto">

        <a href="{{ url('/') }}" class="inline-flex items-center text-xs text-[#D2C1B6] hover:text-white transition font-bold uppercase tracking-widest">
            ← Back
        </a>

        <h2 class="text-3xl font-black text-white mb-8">My Tickets</h2>

        <div class="grid gap-4">
            @forelse($bookings as $booking)
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $booking->schedule->movie->title }}</h3>
                        <p class="text-[#D2C1B6] text-sm">{{ $booking->schedule->show_date }} | {{ $booking->schedule->show_time }}</p>
                        <p class="text-white font-bold mt-2">
                            @foreach($booking->bookingDetails as $detail)
                                <span class="bg-white/10 px-2 py-1 rounded text-xs mr-1">{{ $detail->seat->seat_number }}</span>
                            @endforeach
                        </p>
                    </div>
                    
                    <div class="text-right">
                        <span class="block text-lg font-bold text-white mb-2">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        <div class="flex gap-2">
                            @if($booking->status === 'pending')
                                <form action="{{ route('bookings.pay', $booking->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-[#D2C1B6] text-[#1B3C53] px-4 py-1.5 rounded-lg text-xs font-bold hover:scale-105 transition">Pay Now</button>
                                </form>
                            @endif
                            <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase {{ $booking->status === 'paid' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-amber-500/20 text-amber-400' }}">
                                {{ $booking->status }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 text-[#D2C1B6]">No tickets found.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection