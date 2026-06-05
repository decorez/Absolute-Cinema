@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#1B3C53] flex items-center justify-center">

    <div class="bg-white p-8 rounded-xl text-center">

        <h1 class="text-2xl font-bold mb-4">
            Scan QR to Pay
        </h1>

        <div class="flex justify-center">
            {!! QrCode::size(250)->generate(
                route('booking.scanPayment', $booking->booking_code)
            ) !!}
        </div>

        <p class="mt-4">
            Booking Code: {{ $booking->booking_code }}
        </p>

    </div>

    <script>
    setInterval(() => {
        location.reload();
    }, 2000);
    </script>

</div>
@endsection