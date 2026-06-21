<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket - {{ $booking->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Space+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background: #1B3C53; }
        .mono { font-family: 'Space Mono', monospace; }
        .ticket-hole { width: 28px; height: 28px; background: #0f1923; border-radius: 50%; }
        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            .ticket-hole { background: white; }
            .print-bg { background: #1B3C53 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center py-10 px-4">

    <div class="no-print flex gap-3 mb-6">
        <a href="{{ route('bookings.index') }}" class="text-xs text-gray-400 hover:text-white transition px-4 py-2 rounded-xl border border-white/10">
            ← Back
        </a>
        <button onclick="window.print()" class="bg-[#D2C1B6] text-[#1B3C53] font-black text-xs px-6 py-2 rounded-xl hover:scale-105 transition uppercase tracking-wider">
            🖨️ Print Ticket
        </button>
    </div>

    <div class="w-full max-w-md print-bg" style="background: #1B3C53; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.5);">

        <div class="px-8 pt-8 pb-6" style="background: linear-gradient(135deg, #1B3C53, #234C6A);">
            <div class="flex items-center justify-between mb-4">
                <span class="text-white font-black text-lg tracking-tight">Absolute Cinema</span>
                <span class="bg-emerald-500/20 text-emerald-400 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider border border-emerald-500/30">
                    ✓ PAID
                </span>
            </div>

            @if($booking->schedule && $booking->schedule->movie)
                <h1 class="text-2xl font-black text-white leading-tight uppercase tracking-tight">
                    {{ $booking->schedule->movie->title }}
                </h1>
                <p class="text-[#D2C1B6] text-sm mt-1">
                    {{ \Carbon\Carbon::parse($booking->schedule->show_date)->format('D, d M Y') }}
                    &nbsp;|&nbsp;
                    {{ \Carbon\Carbon::parse($booking->schedule->show_time)->format('H:i') }} WIB
                </p>
            @else
                <h1 class="text-2xl font-black text-white uppercase tracking-tight">
                    Snack Order
                </h1>
                <p class="text-[#D2C1B6] text-sm mt-1">Absolute Cinema Snack Lounge</p>
            @endif
        </div>

        <div class="flex items-center" style="margin: 0 -1px;">
            <div class="ticket-hole -ml-3"></div>
            <div class="flex-1 border-t-2 border-dashed border-white/20"></div>
            <div class="ticket-hole -mr-3"></div>
        </div>

        <div class="px-8 py-6">
            @if($booking->schedule && $booking->schedule->movie)
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Studio</p>
                        <p class="text-white font-bold text-sm">Studio 1</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Seats</p>
                        <div class="flex flex-wrap gap-1">
                            @foreach($booking->bookingDetails as $detail)
                                <span class="mono bg-[#D2C1B6]/20 text-[#D2C1B6] text-xs font-bold px-2 py-0.5 rounded">
                                    {{ optional($detail->seat)->seat_number }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Tickets</p>
                        <p class="text-white font-bold text-sm">{{ $booking->bookingDetails->count() }} pax</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Booking ID</p>
                        <p class="mono text-[#D2C1B6] font-bold text-sm">#BK-{{ $booking->id }}</p>
                    </div>
                </div>
            @endif

            @php $snacks = $booking->snacks()->get(); @endphp

            @if($snacks->count())
                <div class="mb-6 border-t border-white/10 pt-4">
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-2">Snack Order</p>
                    @foreach($snacks as $snack)
                        <div class="flex justify-between items-center py-1.5 border-b border-white/5">
                            <span class="text-white text-sm">{{ $snack->name }}</span>
                            <span class="text-[#D2C1B6] text-sm font-bold mono">x{{ $snack->pivot->quantity }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex justify-between items-center bg-white/5 rounded-xl px-4 py-3 mb-6">
                <span class="text-gray-400 text-xs uppercase tracking-widest font-bold">Total Paid</span>
                <span class="text-[#D2C1B6] font-black text-lg mono">
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-white p-4 rounded-2xl mb-3">
                    {!! QrCode::size(160)->margin(1)->generate(
                        route('booking.scanPayment', $booking->booking_code)
                    ) !!}
                </div>
                <p class="mono text-xs text-gray-400 tracking-widest">{{ $booking->booking_code }}</p>
            </div>

        </div>

        <div class="px-8 pb-8 text-center">
            <p class="text-[10px] text-gray-500">Thank you for choosing Absolute Cinema</p>
            <p class="text-[10px] text-gray-600 mt-1">Please show this ticket at the entrance</p>
        </div>

    </div>

</body>
</html>