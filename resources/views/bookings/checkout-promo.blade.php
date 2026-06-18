@extends('layouts.app')

@section('title', 'Confirm Payment')

@section('content')
<div class="min-h-screen bg-[#1B3C53] flex items-center justify-center p-4 text-white">
    <div class="max-w-xl w-full bg-[#1F425C] border border-white/10 rounded-3xl border border-white/10 shadow-[0_20px_60px_rgba(0,0,0,0.35)] p-6 relative overflow-hidden"
        x-data="{ 
            subtotal: {{ $booking->total_price }},
            adminFee: {{ $booking->schedule ? 4000 : 0 }},
            ticketCount: {{ $booking->bookingDetails->count() }},
            ticketPrice: {{ $booking->schedule ? $booking->schedule->price : 0 }},
            
            promoType: '',
            promoValue: 0,
            voucherApplied: false,
            voucherTitle: '',

            applyVoucher(event) {
                const selected = event.target.options[event.target.selectedIndex];
                this.promoType = selected.getAttribute('data-type') || '';
                this.promoValue = parseFloat(selected.getAttribute('data-value')) || 0;
                
                if(this.promoType) {
                    this.voucherApplied = true;
                    this.voucherTitle = selected.text;
                } else {
                    this.voucherApplied = false;
                    this.voucherTitle = '';
                }
            },

            get discountAmount() {
                if (this.promoType === 'discount') {
                    return this.promoValue;
                }
                if (this.promoType === 'buy_1_get_1') {
                    return this.ticketCount > 1 ? this.ticketPrice : 0;
                }
                return 0;
            },

            get totalPayment() {
                let total = this.subtotal + this.adminFee - this.discountAmount;
                return total < 0 ? 0 : total;
            }
         }">

        <div class="flex items-center justify-between mb-6 border-b border-white/10 pb-4">
            <a href="{{ route('bookings.index') }}" class="text-xs text-gray-400 hover:text-white transition">
                ← Cancel
            </a>
            <h1 class="text-base font-bold uppercase tracking-wider text-center flex-1 pr-6">Confirm Payment</h1>
        </div>

        <div class="bg-white/5 rounded-2xl p-4 mb-5 border border-white/5">
            @if($booking->schedule && $booking->schedule->movie)

                <h2 class="text-lg font-black tracking-tight text-[#D2C1B6] uppercase">
                    {{ $booking->schedule->movie->title }}
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Studio 2, 2D
                </p>

                <p class="text-xs text-gray-300 mt-0.5">
                    🗓️ {{ \Carbon\Carbon::parse($booking->schedule->show_date)->format('D, d M Y') }}
                    |
                    {{ $booking->schedule->show_time }}
                </p>

                @if($booking->bookingDetails->count())

                    <div class="mt-3 flex flex-wrap gap-1">

                        <span class="text-xs bg-white/10 px-2 py-0.5 rounded text-gray-400 font-bold">
                            Tickets ({{ $booking->bookingDetails->count() }}):
                        </span>

                        @foreach($booking->bookingDetails as $detail)

                            <span class="text-xs bg-[#D2C1B6]/20 border border-amber-500/30 text-[#D2C1B6] px-2 py-0.5 rounded font-mono font-bold">
                                {{ optional($detail->seat)->seat_number }}
                            </span>

                        @endforeach

                    </div>

                @endif

            @else

                <h2 class="text-lg font-black tracking-tight text-[#D2C1B6] uppercase">
                    Snack Order
                </h2>

            @endif

            @php
                $orderedSnacks = $booking->getRelation('snacks');
            @endphp

            @if($orderedSnacks && $orderedSnacks->count())

                <div class="mt-4 border-t border-white/10 pt-3">

                    <p class="text-xs text-gray-400 uppercase font-bold mb-3">
                        Ordered Snacks
                    </p>

                    @foreach($orderedSnacks as $snack)

                        <div class="flex justify-between items-center bg-white/5 rounded-lg px-3 py-2 mb-2">

                            <div>
                                <p class="text-white font-bold">
                                    {{ $snack->name }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    {{ $snack->category }}
                                </p>
                            </div>

                            <div class="text-right">

                                <p class="text-[#D2C1B6] font-bold">
                                    x{{ $snack->pivot->quantity }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    Rp {{ number_format($snack->price * $snack->pivot->quantity,0,',','.') }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

        <form action="{{ route('bookings.process-to-qr', $booking->id) }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Select Promo Voucher</label>
                <div class="relative">
                    <select name="promo_id" @change="applyVoucher($event)" class="w-full p-4 rounded-2xl bg-white/5 border border-white/10 text-white focus:outline-none focus:border-[#D2C1B6] appearance-none">
                        <option value="" data-type="" data-value="0"
                            class="bg-[#1B3C53] text-white">
                            🎟️ Do Not Use Voucher
                        </option>

                        @foreach($availablePromos as $promo)
                        <option value="{{ $promo->id }}" data-type="{{ $promo->type }}" data-value="{{ $promo->value }}" class="bg-[#1B3C53] text-white">
                            {{ Str::limit($promo->title, 60) }}
                        </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400 text-xs">▼</div>
                </div>

                <div x-show="voucherApplied" class="mt-2 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs py-2 px-3 rounded-xl" style="display: none;">
                    <span>✨ Voucher applied: <strong x-text="voucherTitle"></strong></span>
                    <template x-if="promoType === 'free_reward'">
                        <span class="block text-[11px] text-amber-400 font-bold mt-1">
                            *Claim your free merchandise / beverage gift reward at the cinema counter by showing your digital ticket.
                        </span>
                    </template>
                </div>
            </div>

            <div class="mb-5 bg-white/5 rounded-2xl border border-white/10 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Booking ID</p>
                        <p class="font-mono font-bold text-[#D2C1B6]">#BK-{{ $booking->id }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Status</p>
                        <span class="px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 text-xs font-bold">PENDING</span>
                    </div>
                </div>
            </div>

            <div class="space-y-2 text-sm border-t border-white/5 pt-4 mb-6">
                <div class="flex justify-between text-gray-400">
                    <span>Subtotal</span>
                    <span>Rp <span x-text="subtotal.toLocaleString('id-ID')"></span></span>
                </div>

                <div class="flex justify-between text-gray-400">
                    <span>Service Fee</span>
                    <span>Rp <span x-text="adminFee.toLocaleString('id-ID')"></span></span>
                </div>

                <div x-show="discountAmount > 0" class="flex justify-between text-emerald-400" style="display: none;">
                    <span x-text="promoType === 'buy_1_get_1' ? 'Promo Buy 1 Get 1' : 'Voucher Discount'"></span>
                    <span>-Rp <span x-text="discountAmount.toLocaleString('id-ID')"></span></span>
                </div>

                <div x-show="promoType === 'free_reward'" class="flex justify-between text-amber-400" style="display: none;">
                    <span>Additional Reward</span>
                    <span class="font-bold">🎁 Free Gift Added</span>
                </div>

                <div class="h-[1px] bg-white/5 my-2"></div>

                <div class="flex justify-between items-center pt-4 mt-3 border-t border-white/10">
                    <span class="text-sm font-bold text-white">Total Payment</span>
                    <span class="text-2xl font-black text-[#D2C1B6]">Rp <span x-text="totalPayment.toLocaleString('id-ID')"></span></span>
                </div>

                <p class="text-center text-[11px] text-gray-400 mt-2">
                    You will earn <span class="text-[#D2C1B6] font-bold">+50 Cinema Points</span>
                </p>
            </div>

            <div class="mb-4 flex justify-center gap-4 text-gray-400 text-xs">
                <span>💳 Card</span>
                <span>📱 QRIS</span>
                <span>🏦 Bank Transfer</span>
            </div>

            <input type="hidden" name="final_total" :value="totalPayment">
            <button type="submit" class="w-full bg-[#D2C1B6] hover:scale-[1.02] hover:brightness-110 text-[#1B3C53] font-black py-4 rounded-2xl transition duration-300 shadow-xl">
                Proceed To Payment
            </button>
        </form>
    </div>
</div>
@endsection