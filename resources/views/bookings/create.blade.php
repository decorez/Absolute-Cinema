@extends('layouts.app') 

@section('title', 'Select Seats')

@section('content')
<div class="min-h-screen bg-[#1B3C53] py-10 px-4 text-white">
    <div class="max-w-2xl mx-auto">

        @if(session('error'))
            <div class="mb-6 rounded-xl bg-red-500/10 border border-red-500/20 p-4 text-red-400 text-sm">
                {{ session('error') }}
            </div>
        @endif
        
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
                <div class="border-t border-white/10 pt-6 mb-6">
                    <h3 class="text-sm font-black uppercase tracking-wider text-[#D2C1B6] mb-4">
                        Add Snacks (Optional)
                    </h3>

                    <div class="space-y-3">
                        @foreach($snacks as $snack)
                            <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl p-3">
                                
                                <div>
                                    <p class="font-bold text-white">
                                        {{ $snack->name }}
                                    </p>
                                    <p class="text-xs text-[#D2C1B6]">
                                        Rp {{ number_format($snack->price, 0, ',', '.') }}
                                    </p>
                                </div>

                            <div class="flex items-center gap-3">

                                <button
                                    type="button"
                                    class="minus-btn w-10 h-10 rounded-xl bg-white/10 border border-white/10 text-white font-black text-lg hover:bg-white/20 transition"
                                >
                                    −
                                </button>

                                <input
                                    type="text"
                                    name="snacks[{{ $snack->id }}]"
                                    value="0"
                                    min="0"
                                    max="{{ $snack->stock }}"
                                    data-price="{{ $snack->price }}"
                                    class="snack-input w-12 bg-transparent text-center text-lg font-black text-white border-0 focus:ring-0"
                                    readonly
                                >

                                <button
                                    type="button"
                                    class="plus-btn w-10 h-10 rounded-xl bg-[#D2C1B6] text-[#1B3C53] font-black text-lg hover:scale-105 transition"
                                >
                                    +
                                </button>

                            </div>
                            </div>
                        @endforeach
                    </div>
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
    const snackInputs = document.querySelectorAll('.snack-input');

    const countEl = document.getElementById('selected-count');
    const totalPriceEl = document.getElementById('total-price');

    const ticketPrice = Number('{{ $schedule->price }}');

    function calculateTotal() {

        const selectedCount =
            document.querySelectorAll(
                'input[name="seats[]"]:checked'
            ).length;

        let total = selectedCount * ticketPrice;

        snackInputs.forEach(input => {
            const qty = Number(input.value);
            const price = Number(input.dataset.price);

            total += qty * price;
        });

        countEl.innerText = selectedCount;
        totalPriceEl.innerText = total.toLocaleString('id-ID');
    }
    function updateSnackButtons() {

        document.querySelectorAll('.snack-input').forEach(input => {

            const max = Number(input.max);
            const value = Number(input.value);

            const plusBtn =
                input.parentElement.querySelector('.plus-btn');

            plusBtn.disabled = value >= max;

            if (value >= max) {
                plusBtn.classList.add(
                    'opacity-50',
                    'cursor-not-allowed'
                );
            } else {
                plusBtn.classList.remove(
                    'opacity-50',
                    'cursor-not-allowed'
                );
            }
        });
    }

    checkboxes.forEach(box => {
        box.addEventListener('change', calculateTotal);
    });

    document.querySelectorAll('.plus-btn').forEach(btn => {
        btn.addEventListener('click', () => {

            const container = btn.parentElement;
            const input = container.querySelector('input');

            const max = Number(input.max || Infinity);
            const value = Number(input.value || 0);

            if (value < max) {
                input.value = value + 1;

                calculateTotal();
                updateSnackButtons();
            }
        });
    });

    document.querySelectorAll('.minus-btn').forEach(btn => {
        btn.addEventListener('click', () => {

            const input = btn.nextElementSibling;

            const value = Number(input.value);

            if (value > 0) {
                input.value = value - 1;

                calculateTotal();
                updateSnackButtons();
            }
        });
    });

    calculateTotal();
    updateSnackButtons();
});
</script>
@endsection