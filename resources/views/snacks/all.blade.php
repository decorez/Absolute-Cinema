@extends('layouts.app')

@section('content')
<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]">

    <header class="max-w-6xl mx-auto pt-12 pb-6 px-6 text-center">
        <span class="inline-block rounded-full bg-[#D2C1B6] px-3 py-1 text-[10px] font-black tracking-wider text-[#1B3C53] uppercase mb-3 shadow-sm">
            Absolute Lounge
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-3">
            Concession & Snacks
        </h1>
        <p class="text-sm text-[#D2C1B6] max-w-md mx-auto leading-relaxed">
            Lengkapi keseruan menonton film favoritmu dengan pilihan menu cemilan dan minuman premium kami.
        </p>
    </header>

    <section class="max-w-6xl mx-auto px-6 mb-10">
        <div class="flex justify-center items-center gap-3 overflow-x-auto pb-3 scrollbar-none">
            <button class="px-5 py-2 rounded-full text-xs font-bold bg-[#D2C1B6] text-[#1B3C53] shadow transition whitespace-nowrap">
                All Items
            </button>
            <button class="px-5 py-2 rounded-full text-xs font-semibold bg-white/5 border border-white/10 text-white/80 hover:bg-white/10 hover:text-white transition whitespace-nowrap">
                🍿 Popcorn
            </button>
            <button class="px-5 py-2 rounded-full text-xs font-semibold bg-white/5 border border-white/10 text-white/80 hover:bg-white/10 hover:text-white transition whitespace-nowrap">
                🥤 Beverages
            </button>
            <button class="px-5 py-2 rounded-full text-xs font-semibold bg-white/5 border border-white/10 text-white/80 hover:bg-white/10 hover:text-white transition whitespace-nowrap">
                🍟 Sides
            </button>
        </div>
    </section>

    <main class="max-w-6xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($snacks as $snack)
                <div class="group relative overflow-hidden rounded-2xl bg-[#234C6A]/60 border border-white/5 shadow-xl flex flex-col justify-between p-4 transition-all duration-300 hover:border-[#D2C1B6]/30 hover:-translate-y-1">
                    
                    <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-[#456882] to-[#1B3C53] border border-white/5 overflow-hidden flex items-center justify-center text-4xl opacity-80 group-hover:opacity-100 transition duration-300 relative select-none">
                        @if($snack->image)
                            <img src="{{ asset('storage/' . $snack->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $snack->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl opacity-80">
                                @if(str_contains(strtolower($snack->name), 'popcorn'))
                                    🍿
                                @elseif(str_contains(strtolower($snack->name), 'drink'))
                                    🥤
                                @elseif(str_contains(strtolower($snack->name), 'combo'))
                                    🍱
                                @else
                                    🍔
                                @endif
                            </div>
                        @endif

                        @if($snack->stock <= 5 && $snack->stock > 0)
                            <span class="absolute top-2 right-2 bg-yellow-500/20 text-yellow-400 text-[9px] font-bold px-2 py-0.5 rounded-md border border-yellow-500/30 uppercase tracking-wide backdrop-blur-sm">
                                Limit Stock
                            </span>
                        @endif
                    </div>

                    <div class="mt-5 pt-3 border-t border-white/5 flex items-center justify-between gap-2">
                        @if($snack->stock > 0)
                            <span class="text-[11px] text-white/50">
                                Stock: <span class="text-white font-semibold">{{ $snack->stock }}</span>
                            </span>
                            <button class="rounded-xl bg-[#D2C1B6] px-3.5 py-2 text-[11px] font-black text-[#1B3C53] transition hover:scale-105 uppercase tracking-wide">
                                Add +
                            </button>
                        @else
                            <span class="w-full text-center py-2 text-xs font-bold text-red-400 bg-red-500/10 border border-red-500/20 rounded-xl uppercase tracking-wider">
                                Sold Out
                            </span>
                        @endif
                    </div>

                </div>
            @empty
                <div class="col-span-full">
                    <div class="rounded-2xl bg-white/5 border border-dashed border-white/10 p-16 text-center">
                        <div class="text-4xl mb-3">🍽️</div>
                        <p class="text-sm text-[#D2C1B6] font-medium">Lounge kami sedang mempersiapkan menu baru.</p>
                        <p class="text-xs text-white/40 mt-1">Silakan kembali beberapa saat lagi!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="border-t border-white/10 py-6 bg-[#1B3C53]/40">
        <div class="max-w-6xl mx-auto px-6 flex justify-between text-xs text-[#D2C1B6]">
            <p>© 2026 Absolute Cinema</p>
            <p>Premium Lounge Experience</p>
        </div>
    </footer>
</div>

<style>
    .scrollbar-none::-webkit-scrollbar { display: none; }
    .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection