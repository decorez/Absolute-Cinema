@extends('layouts.app')

@section('content')
<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]">

    <nav class="sticky top-0 z-50 mx-auto flex items-center justify-between px-10 py-5 backdrop-blur-md bg-[#1B3C53]/60 border-b border-white/10">
        <a href="{{ url('/') }}" class="text-3xl font-bold tracking-tight">
            Absolute Cinema
        </a>

        <div class="flex items-center gap-8">
            <a href="#" class="transition hover:text-[#D2C1B6] text-sm font-medium">Movies</a>
            
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.bookings') }}" class="transition hover:text-[#D2C1B6] text-sm font-medium">Manage Bookings</a>
                @else
                    <a href="{{ route('bookings.index') }}" class="transition hover:text-[#D2C1B6] text-sm font-medium">My Tickets</a>
                @endif
            @endauth
            
            <a href="#" class="transition hover:text-[#D2C1B6] text-sm font-medium">Promo</a>

            @auth
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="rounded-xl bg-[#D2C1B6] px-5 py-2 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="rounded-xl bg-[#D2C1B6] px-5 py-2 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                    Login
                </a>
            @endauth
        </div>
    </nav>

    <section class="max-w-6xl mx-auto pt-16 pb-20 px-6">
        <div class="rounded-[36px] overflow-hidden bg-white/5 p-12 border border-white/10 backdrop-blur-sm">
            <span class="inline-block rounded-full bg-[#D2C1B6] px-4 py-1.5 text-xs font-bold text-[#1B3C53]">
                NOW SHOWING
            </span>

            <h1 class="mt-6 text-5xl font-black leading-tight tracking-tight">
                Experience Cinema <br>
                Like Never Before
            </h1>

            <p class="mt-4 max-w-md text-base text-[#D2C1B6] leading-relaxed">
                Reserve your seat and enjoy premium cinematic moments with friends and family.
            </p>

            <a href="#movies-list" class="inline-block mt-8 rounded-xl bg-[#D2C1B6] px-8 py-3.5 text-sm font-bold text-[#1B3C53] transition hover:scale-105">
                Book Tickets Now
            </a>
        </div>
    </section>

    <section id="movies-list" class="max-w-6xl mx-auto pb-20 px-6">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight">Now Showing</h2>
            <button class="text-sm font-medium text-[#D2C1B6] hover:opacity-80">See All →</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($movies as $movie)
                <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 shadow-md flex flex-col justify-between">
                    <div>
                        @if($movie->poster)
                            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="h-[380px] w-full object-cover">
                        @else
                            <div class="h-[380px] bg-gradient-to-b from-[#456882] to-[#234C6A] flex items-center justify-center text-xs text-[#D2C1B6]">
                                No Poster Available
                            </div>
                        @endif

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
                        <a href="{{ route('movies.show', $movie->id) }}" class="block w-full rounded-xl bg-[#D2C1B6] py-2.5 text-center text-xs font-bold text-[#1B3C53] transition hover:opacity-90">
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

    <section class="max-w-6xl mx-auto pb-20 px-6">
        <div class="mb-8">
            <h2 class="text-2xl font-bold tracking-tight">Special Offers For You</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 flex flex-col justify-between p-6">
                <div>
                    <span class="inline-block rounded-md bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 px-2.5 py-1 text-xs font-bold uppercase">
                        Food Promo
                    </span>
                    <h3 class="mt-4 text-xl font-bold">Popcorn Combo</h3>
                    <p class="mt-2 text-sm text-[#D2C1B6] leading-relaxed">
                        Large popcorn + 2 drinks special price today.
                    </p>
                </div>
                <button class="mt-6 w-max rounded-xl bg-white/10 border border-white/10 px-5 py-2 text-xs font-semibold text-white hover:bg-white/20 transition">
                    Claim Promo
                </button>
            </div>

            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 flex flex-col justify-between p-6">
                <div>
                    <span class="inline-block rounded-md bg-red-400/20 text-red-300 border border-red-400/30 px-2.5 py-1 text-xs font-bold uppercase">
                        Ticket Deal
                    </span>
                    <h3 class="mt-4 text-xl font-bold">Buy 1 Get 1</h3>
                    <p class="mt-2 text-sm text-[#D2C1B6] leading-relaxed">
                        Buy one movie ticket and get another free.
                    </p>
                </div>
                <button class="mt-6 w-max rounded-xl bg-white/10 border border-white/10 px-5 py-2 text-xs font-semibold text-white hover:bg-white/20 transition">
                    Use Promo
                </button>
            </div>

            <div class="overflow-hidden rounded-2xl bg-[#234C6A]/80 border border-white/5 flex flex-col justify-between p-6">
                <div>
                    <span class="inline-block rounded-md bg-cyan-400/20 text-cyan-300 border border-cyan-400/30 px-2.5 py-1 text-xs font-bold uppercase">
                        Member
                    </span>
                    <h3 class="mt-4 text-xl font-bold">Member Cashback</h3>
                    <p class="mt-2 text-sm text-[#D2C1B6] leading-relaxed">
                        Get cashback for every movie transaction.
                    </p>
                </div>
                <button class="mt-6 w-max rounded-xl bg-white/10 border border-white/10 px-5 py-2 text-xs font-semibold text-white hover:bg-white/20 transition">
                    Join Now
                </button>
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
            <button class="mt-8 rounded-xl bg-[#D2C1B6] px-6 py-3 text-sm font-bold text-[#1B3C53] transition hover:scale-105">
                Order Absolute Snack
            </button>
        </div>
    </section>

    <footer class="border-t border-white/10 py-6 bg-[#1B3C53]/40">
        <div class="max-w-6xl mx-auto px-6 flex justify-between text-xs text-[#D2C1B6]">
            <p>© 2026 Absolute Cinema</p>
            <p>Premium Booking Experience</p>
        </div>
    </footer>
</div>
@endsection