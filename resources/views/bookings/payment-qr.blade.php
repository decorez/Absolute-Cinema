@extends('layouts.app')

@section('title', 'Scan Payment')

@section('content')
<div class="min-h-screen bg-[#1B3C53] flex items-center justify-center p-4">

    <div class="bg-white/5 border border-white/10 p-8 rounded-3xl max-w-sm w-full text-center backdrop-blur-md shadow-2xl relative overflow-hidden">
        
        <div class="absolute -top-10 -left-10 w-24 h-24 bg-[#D2C1B6]/10 rounded-full blur-xl"></div>
        <div class="absolute -bottom-10 -right-10 w-24 h-24 bg-amber-500/10 rounded-full blur-xl"></div>

        <a href="{{ route('bookings.index') }}" class="absolute top-4 left-4 text-xs text-[#D2C1B6] hover:text-white transition font-bold uppercase tracking-widest">
            ← Cancel
        </a>

        <h1 class="text-xl font-black text-white mt-4 mb-2 uppercase tracking-wider">
            Scan QR to Pay
        </h1>
        <p class="text-xs text-[#D2C1B6] mb-6">Please complete your payment to secure your seat.</p>

        <div class="flex justify-center bg-white p-5 rounded-2xl shadow-inner inline-block mx-auto max-w-[280px]">
            {!! QrCode::size(240)->margin(1)->generate(
                route('booking.scanPayment', $booking->booking_code)
            ) !!}
        </div>

        <div class="mt-6 bg-white/5 border border-white/10 py-2.5 px-4 rounded-xl inline-flex items-center gap-2">
            <span class="text-[10px] font-black text-[#D2C1B6] uppercase tracking-widest">Code:</span>
            <span class="text-sm font-mono font-bold text-white tracking-wider">{{ $booking->booking_code }}</span>
        </div>

        <div class="mt-6 flex items-center justify-center gap-2 text-xs text-[#D2C1B6]/80 font-medium">
            <svg class="animate-spin h-4 w-4 text-[#D2C1B6]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Waiting for payment confirmation...</span>
        </div>

    </div>

    {{-- Polling Otomatis Bawaan Temanmu --}}
    <script>
    setInterval(() => {
        location.reload();
    }, 2000);
    </script>

</div>
@endsection