<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Absolute Cinema</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

<div class="min-h-screen relative overflow-hidden
            bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]
            flex items-center justify-center px-4 py-6 sm:px-6 lg:px-8">

    <div class="absolute top-0 left-0 w-40 h-40 sm:w-72 sm:h-72 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-40 h-40 sm:w-72 sm:h-72 bg-[#D2C1B6]/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-md">

        <div class="text-center mb-6 sm:mb-8">

            <a href="/">
                <x-application-logo
                    class="w-12 h-12 sm:w-16 sm:h-16 mx-auto fill-[#D2C1B6]" />
            </a>

            <h1 class="mt-3 text-2xl sm:text-3xl font-bold tracking-wide text-white">
                Absolute Cinema
            </h1>

            <p class="mt-2 text-xs sm:text-sm text-gray-200">
                Premium movie experience
            </p>

        </div>

        <div class="bg-white/10 backdrop-blur-xl border border-white/20
                    shadow-2xl rounded-2xl sm:rounded-3xl
                    px-5 py-6 sm:px-8 sm:py-8">

            {{ $slot }}

        </div>

    </div>

</div>

</body>
</html>