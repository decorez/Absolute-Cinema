<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absolute Cinema Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-[#1B3C53] text-white">

            <div class="border-b border-white/10 p-6">

                <h1 class="text-2xl font-bold text-[#D2C1B6]">
                    Absolute Cinema
                </h1>

                <p class="mt-1 text-sm text-gray-300">
                    Admin Panel
                </p>

            </div>

            <nav class="p-4 space-y-2">
                <a href="/dashboard"
                    class="block rounded-xl px-4 py-3 transition hover:bg-[#234C6A]">
                    Dashboard
                </a>

                <a href="/movies"
                    class="block rounded-xl px-4 py-3 transition hover:bg-[#234C6A]">
                    Movies
                </a>

                <a href="/schedules"
                    class="block rounded-xl px-4 py-3 transition hover:bg-[#234C6A]">
                    Schedules
                </a>

                <a href="/seats"
                    class="block rounded-xl px-4 py-3 transition hover:bg-[#234C6A]">
                    Seats
                </a>

                <a href="/snacks"
                    class="block rounded-xl px-4 py-3 transition hover:bg-[#234C6A]">
                    Snacks
                </a>

                <a href="/bookings"
                    class="block rounded-xl px-4 py-3 transition hover:bg-[#234C6A]">
                    Bookings
                </a>

                <a href="/studios"
                    class="block rounded-xl px-4 py-3 transition hover:bg-[#234C6A]">
                    Studios
                </a>
            </nav>
        </aside>

        <div class="flex-1">

            <header class="flex items-center justify-between bg-white px-8 py-5 shadow-sm">

                <h2 class="text-2xl font-bold text-[#1B3C53]">
                    @yield('title')
                </h2>

                <div class="flex items-center gap-4">

                    <span class="font-medium text-gray-700">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="rounded-xl bg-[#1B3C53] px-4 py-2 text-white transition hover:bg-[#234C6A]">
                            Logout
                        </button>
                    </form>

                </div>

            </header>

            <main class="p-8">
                @yield('content')
            </main>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')

</body>

</html>