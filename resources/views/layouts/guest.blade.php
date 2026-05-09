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

    <div class="min-h-screen flex items-center justify-center px-4 relative overflow-hidden
                bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]">

        <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-[#D2C1B6]/20 rounded-full blur-3xl"></div>

        <div class="w-full max-w-md relative z-10">

            <div class="text-center mb-8">
                <a href="/">
                    <x-application-logo class="w-16 h-16 mx-auto fill-[#D2C1B6]" />
                </a>

                <h1 class="text-3xl font-bold text-white mt-4 tracking-wide">
                    Absolute Cinema
                </h1>

                <p class="text-gray-200 mt-2 text-sm">
                    Premium movie experience
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-xl border border-white/20
                        shadow-2xl rounded-3xl p-8">

                {{ $slot }}

            </div>

        </div>

    </div>

</body>
</html>