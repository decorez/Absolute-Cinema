@extends('layouts.app')

@section('content')
<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882] py-10 px-6">
    <div class="max-w-6xl mx-auto">
        
        <div class="mb-8 border-b border-white/10 pb-5">
            <a href="{{ url('/') }}" class="text-xs text-[#D2C1B6] hover:text-white flex items-center gap-1 mb-2 transition">
                ← Back to Home
            </a>
            <h1 class="text-3xl font-extrabold tracking-tight">Special Offers & Promos</h1>
            <p class="text-sm text-[#D2C1B6] mt-1">Take advantage of these daily special promos for a more budget-friendly movie experience!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 flex flex-col justify-between p-6 min-h-[220px] hover:border-yellow-400/20 transition duration-300 shadow-lg">
                <div>
                    <span class="inline-block rounded-md bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 px-2.5 py-1 text-xs font-bold uppercase">
                        Food Promo
                    </span>
                    <h3 class="mt-4 text-xl font-bold text-white">Popcorn Combo Pack</h3>
                    <p class="mt-2 text-sm text-[#D2C1B6] leading-relaxed">
                        Enjoy 1 Large Popcorn (sweet/salty) + 2 soft drinks at a special 30% discount, exclusively for purchases made today.
                    </p>
                </div>
                <button class="mt-6 w-max rounded-xl bg-white/10 border border-white/10 px-5 py-2 text-xs font-semibold text-white hover:bg-white/20 transition">
                    Claim Promo
                </button>
            </div>

            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 flex flex-col justify-between p-6 min-h-[220px] hover:border-red-400/20 transition duration-300 shadow-lg">
                <div>
                    <span class="inline-block rounded-md bg-red-400/20 text-red-300 border border-red-400/30 px-2.5 py-1 text-xs font-bold uppercase">
                        Ticket Deal
                    </span>
                    <h3 class="mt-4 text-xl font-bold text-white">Buy 1 Get 1 Free</h3>
                    <p class="mt-2 text-sm text-[#D2C1B6] leading-relaxed">
                        Buy one movie ticket for the Deluxe Studio and get an extra ticket for the same showtime completely free this weekend!
                    </p>
                </div>
                <button class="mt-6 w-max rounded-xl bg-white/10 border border-white/10 px-5 py-2 text-xs font-semibold text-white hover:bg-white/20 transition">
                    Use Promo
                </button>
            </div>

            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 flex flex-col justify-between p-6 min-h-[220px] hover:border-cyan-400/20 transition duration-300 shadow-lg">
                <div>
                    <span class="inline-block rounded-md bg-cyan-400/20 text-cyan-300 border border-cyan-400/30 px-2.5 py-1 text-xs font-bold uppercase">
                        Member Perk
                    </span>
                    <h3 class="mt-4 text-xl font-bold text-white">10% Points Cashback</h3>
                    <p class="mt-2 text-sm text-[#D2C1B6] leading-relaxed">
                        Earn generous point cashback for every multiple transaction of Rp 50,000 using the Absolute e-wallet payment method.
                    </p>
                </div>
                <button class="mt-6 w-max rounded-xl bg-white/10 border border-white/10 px-5 py-2 text-xs font-semibold text-white hover:bg-white/20 transition">
                    Join Now
                </button>
            </div>

            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 flex flex-col justify-between p-6 min-h-[220px] hover:border-purple-400/20 transition duration-300 shadow-lg">
                <div>
                    <span class="inline-block rounded-md bg-purple-400/20 text-purple-300 border border-purple-400/30 px-2.5 py-1 text-xs font-bold uppercase">
                        Midnight Deal
                    </span>
                    <h3 class="mt-4 text-xl font-bold text-white">20% Late Night Discount</h3>
                    <p class="mt-2 text-sm text-[#D2C1B6] leading-relaxed">
                        Love midnight shows? Get a flat discount on all movie tickets for screenings scheduled after 9:00 PM with no minimum purchase required.
                    </p>
                </div>
                <button class="mt-6 w-max rounded-xl bg-white/10 border border-white/10 px-5 py-2 text-xs font-semibold text-white hover:bg-white/20 transition">
                    Get Discount
                </button>
            </div>

        </div>

    </div>
</div>
@endsection