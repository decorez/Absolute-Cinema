@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882] py-10 px-6"
    x-data="{ 
        openModal: false, 
        activePromo: {},
        isClaiming: false,
        
        async claimPromo(promoId) {
            if (!promoId) {
                alert('⚠️ Promo ID is invalid.');
                return;
            }
            this.isClaiming = true;
            try {
                let response = await fetch(`/promos/${promoId}/claim`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
                
                let result = await response.json();
                
                if (response.ok && result.success) {
                    alert('🎉 ' + result.message);
                    this.openModal = false;
                } else {
                    alert('⚠️ ' + result.message);
                }
            } catch (error) {
                alert('⚠️ Something went wrong. Please check your connection.');
            } finally {
                this.isClaiming = false;
            }
        }
     }">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-5">
            <div>
                <a href="{{ url('/') }}" class="text-xs text-[#D2C1B6] hover:text-white flex items-center gap-1 mb-2 transition">
                    ← Back to Home
                </a>
                <h1 class="text-3xl font-extrabold tracking-tight">Special Offers & Promos</h1>
            </div>
            <p class="text-xs font-bold text-[#D2C1B6] bg-white/5 border border-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                Total: {{ $promos->count() }} Promos
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($promos as $promo)
            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 shadow-md flex flex-col justify-between group hover:border-[#D2C1B6]/30 transition duration-300">

                <div>
                    <div class="overflow-hidden relative aspect-[2.35/1] bg-slate-900 cursor-pointer"
                        @click="openModal = true; activePromo = { 
                                id: {{ $promo->id }},
                                title: '{{ addslashes($promo->title) }}', 
                                image: '{{ $promo->image ? asset('storage/' . $promo->image) : '' }}',
                                date: '{{ \Carbon\Carbon::parse($promo->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}',
                                desc: '{{ addslashes(str_replace(["\r", "\n"], ' ', $promo->description)) }}'
                             }">

                        @if($promo->image)
                        <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->title }}" class="h-full w-full object-cover group-hover:scale-102 transition duration-500">
                        @else
                        <div class="h-full bg-gradient-to-br from-[#456882] to-[#234C6A] flex items-center justify-center text-xs text-[#D2C1B6]">
                            No Image Available
                        </div>
                        @endif

                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                            <span class="rounded-xl bg-white/10 backdrop-blur-md px-4 py-2 text-xs font-bold text-white border border-white/10 tracking-wide transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                                View Promo Details
                            </span>
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold line-clamp-1 text-white">
                            {{ $promo->title }}
                        </h3>
                        <p class="mt-1 text-xs text-[#D2C1B6] font-medium">
                            Period: {{ \Carbon\Carbon::parse($promo->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <div class="px-5 pb-5 grid grid-cols-2 gap-3">
                    <button @click="openModal = true; activePromo = { 
                                    id: {{ $promo->id }},
                                    title: '{{ addslashes($promo->title) }}', 
                                    image: '{{ $promo->image ? asset('storage/' . $promo->image) : '' }}',
                                    date: '{{ \Carbon\Carbon::parse($promo->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}',
                                    desc: '{{ addslashes(str_replace(["\r", "\n"], ' ', $promo->description)) }}'
                                 }"
                        class="w-full rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 py-2.5 text-center text-xs font-bold text-white transition uppercase tracking-wide">
                        Details
                    </button>

                    <button @click="claimPromo({{ $promo->id }})" :disabled="isClaiming" class="w-full rounded-xl bg-[#D2C1B6] py-2.5 text-center text-xs font-bold text-[#1B3C53] transition hover:opacity-90 uppercase tracking-wide disabled:opacity-50">
                        <span x-text="isClaiming ? 'Claiming...' : 'Claim Promo'"></span>
                    </button>
                </div>

            </div>
            @empty
            <div class="col-span-full">
                <div class="rounded-2xl bg-white/5 border border-dashed border-white/10 p-12 text-center">
                    <p class="text-sm text-[#D2C1B6]">No Promos Available At The Moment.</p>
                </div>
            </div>
            @endforelse
        </div>

    </div>

    <div x-show="openModal"
        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;">

        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" @click="openModal = false"></div>

        <div class="relative w-full max-w-2xl bg-[#1B3C53] border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-10 transform transition-all"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4">

            <button @click="openModal = false" class="absolute top-4 right-4 z-30 bg-black/40 hover:bg-black/70 border border-white/10 text-white p-2 rounded-full transition focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="aspect-[2.35/1] w-full bg-slate-900 relative">
                <template x-if="activePromo.image">
                    <img :src="activePromo.image" class="w-full h-full object-cover">
                </template>
                <template x-if="!activePromo.image">
                    <div class="w-full h-full bg-gradient-to-br from-[#234C6A] to-[#456882] flex items-center justify-center text-4xl">🎟️</div>
                </template>
                <div class="absolute inset-0 bg-gradient-to-t from-[#1B3C53] via-transparent to-transparent"></div>
            </div>

            <div class="p-6 sm:p-8">
                <h2 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight" x-text="activePromo.title"></h2>

                <div class="flex items-center gap-2 mt-2 text-xs font-semibold text-[#D2C1B6]">
                    <svg class="w-4 h-4 text-[#D2C1B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Promo Period: <span x-text="activePromo.date"></span></span>
                </div>

                <div class="h-[1px] w-full bg-white/5 my-5"></div>

                <div class="overflow-y-auto max-h-[200px] pr-2 text-sm text-white/80 leading-relaxed custom-scrollbar">
                    <p class="whitespace-pre-line text-xs sm:text-sm text-justify" x-text="activePromo.desc"></p>
                </div>

                <div class="mt-8 pt-4 border-t border-white/5 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-white/40 uppercase tracking-wider">*T&C Apply</span>
                    <div class="flex items-center gap-3">
                        <button @click="openModal = false" class="rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 px-4 py-2 text-xs font-bold text-white transition">
                            Close
                        </button>
                        <button @click="claimPromo(activePromo.id)"
                            :disabled="isClaiming"
                            class="rounded-xl bg-[#D2C1B6] px-5 py-2 text-xs font-bold text-[#1B3C53] shadow-md transition duration-300 hover:bg-[#c4b1a4] active:scale-95 disabled:opacity-50">
                            <span x-text="isClaiming ? 'Claiming...' : 'Claim Promo'"></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }
</style>
@endsection