@extends('layouts.app') 

@section('title', 'Select Seats')

@section('content')
<div class="min-h-screen bg-[#1B3C53] py-10 px-4 text-white">
    <div class="max-w-2xl mx-auto">
        
        <div class="mb-8">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-xs text-[#D2C1B6] hover:text-white transition font-bold uppercase tracking-widest">
                ← Back
            </a>
            <h1 class="text-3xl font-black mt-4 tracking-tight">{{ $schedule->movie->title }}</h1>
            <p class="text-[#D2C1B6] text-sm mt-1">
                {{ \Carbon\Carbon::parse($schedule->show_date)->format('d M Y') }} • {{ \Carbon\Carbon::parse($schedule->show_time)->format('H:i') }} WIB
            </p>
        </div>

        <form action="{{ route('bookings.store', $schedule->id) }}" method="POST">
            @csrf

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 backdrop-blur-sm">
                
                <div class="w-full bg-white/10 text-center py-2 text-[10px] font-black text-[#D2C1B6] rounded-xl mb-10 tracking-widest uppercase">
                    Cinema Screen
                </div>

                <div class="flex justify-center gap-6 text-[10px] font-bold uppercase text-[#D2C1B6] mb-8">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-white/10 rounded border border-white/20"></div> Available
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 bg-[#D2C1B6] rounded"></div> Selected
                    </div>
                </div>

                <div class="grid grid-cols-10 gap-2 mb-10">
                    @foreach($schedule->studio->seats as $seat)
                        @php 
                            $isBooked = $bookedSeatIds->contains($seat->id);
                        @endphp
                        
                        <label class="block aspect-square">
                            <input type="checkbox" name="seats[]" value="{{ $seat->id }}" 
                                   class="hidden peer" {{ $isBooked ? 'disabled' : '' }}>
                            
                            @if($isBooked)
                                <div class="w-full h-full flex items-center justify-center rounded-lg bg-red-500/10 border border-red-500/20 text-red-500/50 text-[10px] font-bold cursor-not-allowed">
                                    X
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center rounded-lg bg-white/10 border border-white/10 text-white text-[10px] font-bold cursor-pointer hover:bg-white/20 peer-checked:bg-[#D2C1B6] peer-checked:border-[#D2C1B6] peer-checked:text-[#1B3C53] transition-all">
                                    {{ $seat->seat_number }}
                                </div>
                            @endif
                        </label>
                    @endforeach
                </div>

                <div class="border-t border-white/10 pt-6 flex justify-between items-center">
                    <div>
                        <p class="text-[10px] font-bold uppercase text-[#D2C1B6]">Total Selected: <span id="selected-count" class="text-white">0</span></p>
                        <p class="text-2xl font-black mt-1">Rp <span id="total-price">0</span></p>
                    </div>

                    <button type="submit" class="px-8 py-4 bg-[#D2C1B6] text-[#1B3C53] text-xs font-black uppercase rounded-2xl hover:scale-105 transition shadow-lg shadow-black/20">
                        Confirm Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('input[name="seats[]"]');
        const countEl = document.getElementById('selected-count');
        const totalPriceEl = document.getElementById('total-price');
        const ticketPrice = Number('{{ $schedule->price }}');

        checkboxes.forEach(box => {
            box.addEventListener('change', () => {
                const selectedCount = document.querySelectorAll('input[name="seats[]"]:checked').length;
                countEl.innerText = selectedCount;
                totalPriceEl.innerText = (selectedCount * ticketPrice).toLocaleString('id-ID');
            });
        });
    });
</script>
@endsection