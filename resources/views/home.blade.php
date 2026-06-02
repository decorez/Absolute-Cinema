@extends('layouts.app')

@section('content')

<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]">

    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50 mx-auto flex items-center justify-between px-10 py-5 backdrop-blur-md bg-[#1B3C53]/60 border-b border-white/10">
        <h1 class="text-3xl font-bold" style="font-family:'Noto Sans', sans-serif;">
            Absolute Cinema
        </h1>

        <div class="flex items-center gap-8">
            <a href="#" class="transition hover:text-[#D2C1B6]">
                Movies
            </a>
            <a href="#" class="transition hover:text-[#D2C1B6]">
                Tickets
            </a>
            <a href="#" class="transition hover:text-[#D2C1B6]">
                Promo
            </a>


            @auth
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                        class="rounded-xl bg-[#D2C1B6] px-5 py-2 text-[#1B3C53] transition hover:scale-105">
                        Logout
                    </button>

                </form>
            </div>
            @else
            <a href="{{ route('login') }}"
                class="rounded-xl bg-[#D2C1B6] px-5 py-2 text-[#1B3C53] transition hover:scale-105">
                Login
            </a>

            @endauth

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto pt-16 pb-24">
        <div class="rounded-[36px] overflow-hidden bg-white/5 p-16 backdrop-blur-sm">

            <span class="rounded-full bg-[#D2C1B6] px-5 py-2 font-medium text-[#1B3C53]">
                NOW SHOWING
            </span>

            <h1 class="mt-8 text-7xl font-black leading-tight">
                Experience <br>
                Cinema <br>
                Like Never Before
            </h1>

            <p class="mt-8 max-w-xl text-xl text-[#D2C1B6]">
                Reserve your seat and enjoy premium cinematic moments.
            </p>

            <button class="mt-10 rounded-xl bg-[#D2C1B6] px-10 py-4 font-semibold text-[#1B3C53] transition hover:scale-105">
                Book Ticket
            </button>
        </div>
    </section>

    <!-- Now Showing Section-->
    <section class="container mx-auto pb-24">
        <div class="mb-10 flex items-center justify-between">
            <h2 class="text-4xl font-bold">
                Now Showing
            </h2>

            <button class="text-[#D2C1B6] hover:opacity-80">
                See All →
            </button>
        </div>

        <div class="grid grid-cols-4 gap-8">
            @forelse($movies as $movie)
            <div class="overflow-hidden rounded-3xl bg-[#234C6A]/80 backdrop-blur-md transition hover:-translate-y-2 hover:shadow-2xl">
                @if($movie->poster)

                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="h-[420px] w-full object-cover">

                @else
                <div class="h-[420px] bg-gradient-to-b from-[#456882] to-[#234C6A]"></div>
                @endif

                <div class="p-6">

                    <h3 class="h-24 text-2xl font-semibold">
                        {{ $movie->title }}
                    </h3>

                    <p class="mt-2 text-[#D2C1B6]">
                        {{ $movie->genre }} • {{ $movie->duration }} min
                    </p>

                    <button class="mt-6 w-full rounded-xl bg-[#D2C1B6] py-3 font-semibold text-[#1B3C53] transition hover:scale-[1.02]">
                        Buy Ticket
                    </button>
                </div>
            </div>

            @empty

            <div class="col-span-4">
                <div class="rounded-3xl bg-white/5 p-10 text-center">

                    <h3 class="text-2xl font-semibold">
                        No Movies Available
                    </h3>
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Promo Section -->
    <section class="container mx-auto pb-24">
        <div class="mb-10">
            <h2 class="text-4xl font-bold">
                Special Offers For You
            </h2>
        </div>

        <div class="grid grid-cols-3 gap-8">
            <!-- Promo 1 -->
            <div class="overflow-hidden rounded-3xl bg-[#234C6A]/80 backdrop-blur-md">
                <div class="h-56 bg-gradient-to-r from-amber-400 to-orange-500"></div>
                <div class="p-6">
                    <span class="rounded-full bg-yellow-300 px-3 py-1 text-sm font-medium text-black">
                        FOOD PROMO
                    </span>

                    <h3 class="mt-5 text-2xl font-semibold">
                        Popcorn Combo
                    </h3>

                    <p class="mt-3 text-[#D2C1B6]">
                        Large popcorn + 2 drinks special price today.
                    </p>

                    <button class="mt-6 rounded-xl bg-[#D2C1B6] px-6 py-3 font-semibold text-[#1B3C53]">
                        Claim Promo
                    </button>
                </div>
            </div>

            <!-- Promo 2 -->
            <div class="overflow-hidden rounded-3xl bg-[#234C6A]/80 backdrop-blur-md">
                <div class="h-56 bg-gradient-to-r from-red-400 to-pink-500"></div>
                <div class="p-6">
                    <span class="rounded-full bg-red-200 px-3 py-1 text-sm font-medium text-black">
                        TICKET DEAL
                    </span>

                    <h3 class="mt-5 text-2xl font-semibold">
                        Buy 1 Get 1
                    </h3>

                    <p class="mt-3 text-[#D2C1B6]">
                        Buy one movie ticket and get another free.
                    </p>

                    <button class="mt-6 rounded-xl bg-[#D2C1B6] px-6 py-3 font-semibold text-[#1B3C53]">
                        Use Promo
                    </button>
                </div>
            </div>

            <!-- Promo 3 -->
            <div class="overflow-hidden rounded-3xl bg-[#234C6A]/80 backdrop-blur-md">
                <div class="h-56 bg-gradient-to-r from-cyan-400 to-blue-500"></div>
                <div class="p-6">
                    <span class="rounded-full bg-cyan-200 px-3 py-1 text-sm font-medium text-black">
                        MEMBER
                    </span>

                    <h3 class="mt-5 text-2xl font-semibold">
                        Member Cashback
                    </h3>

                    <p class="mt-3 text-[#D2C1B6]">
                        Get cashback for every movie transaction.
                    </p>

                    <button class="mt-6 rounded-xl bg-[#D2C1B6] px-6 py-3 font-semibold text-[#1B3C53]">
                        Join Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Absolute Snack -->
    <section class="container mx-auto pb-24 ">

        <div class="mb-10">
            <h2 class="text-4xl font-bold">
                Get tasty snacks at Absolute Snack
            </h2>
        </div>

        <div class="overflow-hidden rounded-3xl bg-gradient-to-r from-[#355A75] to-[#4E728C] border border-white/20 shadow-2x1 px-16 py-14">
            <div class="flex items-center justify-between gap-10">
                <div class="max-w-2xl">
                    <span
                        class="rounded-full bg-[#D2C1B6] px-4 py-2 text-sm font-medium text-[#1B3C53]">
                        ABSOLUTE SNACK
                    </span>

                    <h2 class="mt-8 text-5xl font-bold leading-tight">
                        Delicious food & drinks <br>
                        ready to accompany <br>
                        your movie night
                    </h2>

                    <button
                        class="mt-10 rounded-xl bg-[#D2C1B6] px-8 py-4 text-lg font-semibold text-[#1B3C53] transition hover:scale-105">
                        Order Absolute Snack
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-white/10 py-8">
        <div class="container mx-auto flex justify-between">
            <p class="text-[#D2C1B6]">
                © 2026 Absolute Cinema
            </p>
            <p class="text-[#D2C1B6]">
                Premium Booking Experience
            </p>
        </div>
    </footer>
</div>

@endsection