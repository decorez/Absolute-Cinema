@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]">

    <nav class="sticky top-0 z-50 mx-auto flex items-center justify-between px-6 sm:px-10 py-4 backdrop-blur-md bg-[#1B3C53]/60 border-b border-white/10">
        <a href="{{ url('/') }}" class="text-2xl sm:text-3xl font-bold tracking-tight">
            Absolute Cinema
        </a>

        <div class="flex items-center gap-4 sm:gap-6">
            @auth
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.bookings') }}" class="transition hover:text-[#D2C1B6] text-sm font-medium">Manage Bookings</a>
            @else
            <a href="{{ route('bookings.index') }}" class="transition hover:text-[#D2C1B6] text-sm font-medium">My Tickets</a>
            @endif
            @endauth

            <a href="{{ route('promos.all') }}" class="transition hover:text-[#D2C1B6] text-sm font-medium">Promos</a>

            @auth
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2.5 bg-white/5 border border-white/10 hover:bg-white/10 px-3 py-1.5 rounded-full transition focus:outline-none">
                    <div class="w-6 h-6 rounded-full bg-[#D2C1B6] text-[#1B3C53] flex items-center justify-center text-xs font-black uppercase">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <span class="text-xs font-bold text-white tracking-wide max-w-[80px] truncate hidden sm:inline">
                        {{ auth()->user()->name }}
                    </span>
                    <svg class="w-3 h-3 text-[#D2C1B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-[#1B3C53]/95 border border-white/10 rounded-xl shadow-xl overflow-hidden z-50 py-1 backdrop-blur-lg">
                    <div class="px-4 py-2 border-b border-white/5">
                        <p class="text-[9px] text-[#D2C1B6] uppercase font-bold tracking-wider">Signed in as</p>
                        <p class="text-xs text-white font-bold truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-xs text-red-400 hover:text-white hover:bg-red-500/10 transition font-bold">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="flex items-center gap-3 sm:gap-4">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-white/90 hover:text-[#D2C1B6] transition py-2 px-1">
                    Login
                </a>
                <a href="{{ route('register') }}" class="rounded-xl bg-[#D2C1B6] px-4 py-2 text-sm font-bold text-[#1B3C53] shadow-md transition duration-300 hover:bg-[#c4b1a4] hover:shadow-lg active:scale-95">
                    Make an account
                </a>
            </div>
            @endauth
        </div>
    </nav>

    <section class="max-w-6xl mx-auto pt-8 pb-10 px-6 flex flex-col items-center">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-center tracking-tight mb-6 text-white">
            Feel the movies beyond
        </h1>

        <div class="relative group/hero overflow-hidden rounded-2xl w-full aspect-[21/9] max-h-[380px] bg-slate-800 shadow-xl border border-white/5 mb-8">
            <div class="swiper hero-single-swiper w-full h-full">
                <div class="swiper-wrapper">
                    <div class="swiper-slide relative w-full h-full">
                        <img src="{{ asset('images/banner1.webp') }}" class="w-full h-full object-cover" alt="New Movie Release">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-6 sm:p-10">
                            <span class="w-max bg-red-600 text-white text-xs font-black px-2.5 py-1 rounded mb-2 uppercase tracking-wider">Trending</span>
                            <h2 class="text-xl sm:text-3xl font-extrabold text-white leading-tight max-w-2xl">Experience Ultimate Cinematic Vision</h2>
                        </div>
                    </div>
                    <div class="swiper-slide relative w-full h-full">
                        <img src="{{ asset('images/banner2.jpeg') }}" class="w-full h-full object-cover" alt="Snack Promo">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-6 sm:p-10">
                            <span class="w-max bg-yellow-500 text-[#1B3C53] text-xs font-black px-2.5 py-1 rounded mb-2 uppercase tracking-wider">Halal Certified</span>
                            <h2 class="text-xl sm:text-3xl font-extrabold text-white leading-tight max-w-2xl">Absolute Cinema's Menu Officially Halal Certified</h2>
                        </div>
                    </div>
                    <div class="swiper-slide relative w-full h-full">
                        <a href="{{ route('snacks.all') }}">
                            <img src="{{ asset('images/snack.webp') }}" class="w-full h-full object-cover" alt="Absolute Snack">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-6 sm:p-10">
                                <span class="w-max bg-yellow-500 text-[#1B3C53] text-xs font-black px-2.5 py-1 rounded mb-2 uppercase tracking-wider">Absolute Snack</span>
                                <h2 class="text-xl sm:text-3xl font-extrabold text-white">Fresh Popcorn, Drinks & Combos</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <button class="hero-prev absolute left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center opacity-0 group-hover/hero:opacity-100 transition-opacity duration-300 focus:outline-none backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="hero-next absolute right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center opacity-0 group-hover/hero:opacity-100 transition-opacity duration-300 focus:outline-none backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div class="hero-pagination absolute bottom-4 left-1/2 -translate-x-1/2 z-10 flex gap-1.5"></div>
        </div>

        <div class="w-full max-w-2xl relative mb-10">
            <span class="absolute inset-y-0 left-4 flex items-center pl-1 pointer-events-none">
                <svg class="w-5 h-5 text-[#D2C1B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" placeholder="Search for movies or cinemas..." class="w-full pl-12 pr-4 py-3 bg-[#1B3C53]/40 border border-white/10 rounded-full text-sm text-white placeholder-white/40 focus:outline-none focus:border-[#D2C1B6] focus:ring-1 focus:ring-[#D2C1B6] backdrop-blur-md shadow-lg transition duration-300" />
        </div>

        <div class="grid grid-cols-3 gap-4 sm:gap-10 max-w-md w-full text-center">
            <a href="{{ route('movies.all') }}" class="group flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 group-hover:border-[#D2C1B6] flex items-center justify-center transition-all duration-300 group-hover:-translate-y-1 shadow-md">
                    <svg class="w-7 h-7 text-[#D2C1B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-white/80 group-hover:text-[#D2C1B6] tracking-wide transition">Movies</span>
            </a>

            <a href="{{ route('snacks.all') }}" class="group flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 group-hover:border-[#D2C1B6] flex items-center justify-center transition-all duration-300 group-hover:-translate-y-1 shadow-md">
                    <svg class="w-7 h-7 text-[#D2C1B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 7.5a2.5 2.5 0 014.8-.8 2.5 2.5 0 014.2 1.8 2 2 0 01-1.5 2h-9A2 2 0 016 8.5a2.5 2.5 0 013-1z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 10.5l1.5 10.5h7l1.5-10.5H7z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 10.5l.5 10.5M14 10.5l-.5 10.5" />
                    </svg>
                </div>
                <span class="text-xs font-semibold text-white/80 group-hover:text-[#D2C1B6] tracking-wide transition">Absolute Snack</span>
            </a>

            <a href="#" class="group flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 group-hover:border-[#D2C1B6] flex items-center justify-center transition-all duration-300 group-hover:-translate-y-1 shadow-md">
                    <svg class="w-7 h-7 text-[#D2C1B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-white/80 group-hover:text-[#D2C1B6] tracking-wide transition">Private Booking</span>
            </a>
        </div>
    </section>

    <section id="movies-list" class="max-w-6xl mx-auto pb-16 px-6 scroll-mt-24">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight">Now Showing</h2>
            <a href="{{ route('movies.all') }}" class="text-sm font-medium text-[#D2C1B6] hover:opacity-80 transition">
                See All Movies →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($movies as $movie)
            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 shadow-md flex flex-col justify-between group hover:border-[#D2C1B6]/30 transition duration-300">
                <div>
                    <div class="overflow-hidden relative h-[380px]">
                        @if($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                        <div class="h-full bg-gradient-to-b from-[#456882] to-[#234C6A] flex items-center justify-center text-xs text-[#D2C1B6]">
                            No Poster Available
                        </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold line-clamp-2 text-white">
                            {{ $movie->title }}
                        </h3>
                        <p class="mt-1 text-xs text-[#D2C1B6]">
                            {{ $movie->genre ?? 'Genre' }} • {{ $movie->duration ?? '0' }} Min
                        </p>
                    </div>
                </div>

                <div class="px-5 pb-5">
                    <a href="{{ route('movies.show', $movie->id) }}" class="block w-full rounded-xl bg-[#D2C1B6] py-2.5 text-center text-xs font-bold text-[#1B3C53] transition hover:opacity-90 uppercase tracking-wide">
                        Buy Ticket
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="rounded-2xl bg-white/5 border border-dashed border-white/10 p-12 text-center">
                    <p class="text-sm text-[#D2C1B6]">No Movies Available At The Moment.</p>
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <section id="promo-list" class="max-w-6xl mx-auto pb-16 px-6 scroll-mt-24">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight">
                Special Offers For You
            </h2>

            <div class="flex items-center gap-4">
                <a href="{{ route('promos.all') }}" class="text-sm font-medium text-[#D2C1B6] hover:opacity-80 transition">
                    See All Promos →
                </a>
                <div class="flex gap-2">
                    <button class="promo-prev bg-white/5 hover:bg-white/10 border border-white/10 p-2 rounded-full transition">
                        ←
                    </button>
                    <button class="promo-next bg-white/5 hover:bg-white/10 border border-white/10 p-2 rounded-full transition">
                        →
                    </button>
                </div>
            </div>
        </div>

        <div class="swiper promo-swiper">
            <div class="swiper-wrapper">
                @forelse($promos as $promo)
                <div class="swiper-slide">
                    <div class="group relative rounded-2xl w-full h-auto border border-white/10 shadow-xl overflow-hidden bg-transparent">

                        @if($promo->image)
                        <img
                            src="{{ asset('storage/' . $promo->image) }}"
                            alt="{{ $promo->title }}"
                            class="w-full h-auto block transition duration-500 group-hover:scale-[1.01]">
                        @else
                        <div class="w-full aspect-[21/9] bg-gradient-to-br from-[#234C6A] to-[#1B3C53]"></div>
                        @endif

                        <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

                        <a href="{{ route('promos.all') }}" class="absolute inset-0 z-20"></a>
                    </div>
                </div>
                @empty
                <div class="swiper-slide">
                    <div class="rounded-2xl bg-white/5 border border-dashed border-white/10 p-10 text-center text-sm text-[#D2C1B6]">
                        No promotions available
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto pb-24 px-6">
        <div class="overflow-hidden rounded-[28px] bg-gradient-to-r from-[#355A75] to-[#4E728C] border border-white/10 p-10 sm:p-12">
            <span class="inline-block rounded-full bg-[#D2C1B6] px-3 py-1 text-xs font-bold text-[#1B3C53]">
                ABSOLUTE SNACK
            </span>
            <h2 class="mt-6 text-3xl sm:text-4xl font-bold leading-tight">
                Delicious food & drinks ready <br class="hidden sm:block">
                to accompany your movie night
            </h2>
            <a href="{{ route('snacks.all') }}" class="inline-block mt-8 rounded-xl bg-[#D2C1B6] px-6 py-3 text-sm font-bold text-[#1B3C53] transition hover:scale-105">
                Order Absolute Snack
            </a>
        </div>
    </section>

    <footer class="border-t border-white/10 py-6 bg-[#1B3C53]/40">
        <div class="max-w-6xl mx-auto px-6 flex justify-between text-xs text-[#D2C1B6]">
            <p>© 2026 Absolute Cinema</p>
            <p>Premium Booking Experience</p>
        </div>
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroSingleSwiper = new Swiper('.hero-single-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.hero-next',
                prevEl: '.hero-prev',
            },
            pagination: {
                el: '.hero-pagination',
                clickable: true,
            }
        });

        const promoSwiper = new Swiper('.promo-swiper', {
            slidesPerView: 1.2,
            spaceBetween: 20,
            loop: true,

            navigation: {
                nextEl: '.promo-next',
                prevEl: '.promo-prev',
            },

            breakpoints: {
                640: {
                    slidesPerView: 2
                },

                1024: {
                    slidesPerView: 3
                }
            }
        });
    });
</script>

<style>
    html {
        scroll-behavior: smooth;
    }

    .hero-pagination .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.4);
        opacity: 1;
        width: 7px;
        height: 7px;
        transition: all 0.3s ease;
    }

    .hero-pagination .swiper-pagination-bullet-active {
        background: #D2C1B6;
        width: 20px;
        border-radius: 4px;
    }

    .promo-swiper {
        overflow: hidden;
    }

    .promo-swiper .swiper-wrapper {
        height: auto !important;
        align-items: flex-start;
    }

    .promo-swiper .swiper-slide {
        height: auto !important;
    }

    .promo-swiper .swiper-slide img {
        width: 100%;
        height: auto;
        object-fit: unset;
        object-position: center top;
        display: block;
    }

    .promo-swiper .swiper-slide > div {
        aspect-ratio: 21/9;
        overflow: hidden;
    }
</style>
@endsection