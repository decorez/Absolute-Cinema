<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absolute Cinema Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #1B3C53; }
        ::-webkit-scrollbar-thumb { background: #456882; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #D2C1B6; }
    </style>
    
</head>

<body class="bg-[#1B3C53] font-sans antialiased text-white">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-[#1B3C53] text-white flex flex-col justify-between border-r border-white/10">
            <div>
                <div class="border-b border-white/10 p-6">
                    <h1 class="text-2xl font-bold text-[#D2C1B6] tracking-tight">
                        Absolute Cinema
                    </h1>
                    <p class="mt-1 text-xs text-[#D2C1B6]/60 font-medium uppercase tracking-wider">
                        Admin Panel
                    </p>
                </div>

                <nav class="p-4 space-y-1 text-sm font-medium">
                    <a href="/dashboard" class="block rounded-xl px-4 py-3 transition {{ request()->is('dashboard') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Dashboard
                    </a>
                    <a href="/movies" class="block rounded-xl px-4 py-3 transition {{ request()->is('movies*') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Movies
                    </a>
                    <a href="/schedules" class="block rounded-xl px-4 py-3 transition {{ request()->is('schedules*') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Schedules
                    </a>
                    <a href="/seats" class="block rounded-xl px-4 py-3 transition {{ request()->is('seats*') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Seats
                    </a>
                    <a href="/snacks" class="block rounded-xl px-4 py-3 transition {{ request()->is('snacks*') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Snacks
                    </a>
                    <a href="/admin/promos" class="block rounded-xl px-4 py-3 transition {{ request()->is('promos*') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Promos
                    </a>
                    <a href="/admin/bookings" class="block rounded-xl px-4 py-3 transition {{ request()->is('bookings*') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Bookings
                    </a>
                    <a href="/studios" class="block rounded-xl px-4 py-3 transition {{ request()->is('studios*') ? 'text-white bg-white/10 font-bold' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                        Studios
                    </a>
                </nav>
            </div>
            
            <div class="p-4 border-t border-white/10">
                <a href="{{ url('/') }}" class="block text-center rounded-xl bg-white/5 border border-white/10 px-4 py-2 text-xs font-semibold text-[#D2C1B6] hover:bg-white/10 transition">
                    ← View Website
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]">

            <header class="flex items-center justify-between px-8 py-5 border-b border-white/10 backdrop-blur-md bg-[#1B3C53]/60">
                <h2 class="text-xl font-bold text-white tracking-tight">
                    @yield('title')
                </h2>

                <div class="flex items-center gap-4">
                    <span class="text-sm font-semibold text-[#D2C1B6]">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="rounded-xl bg-[#D2C1B6] px-4 py-2 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="p-8 flex-1">
                @yield('content')
            </main>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')

</body>

</html>