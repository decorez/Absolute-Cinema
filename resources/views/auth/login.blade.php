<x-guest-layout>

    <div class="text-center mb-5 sm:mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-white">
            Welcome Back
        </h2>

        <p class="text-gray-200 text-xs sm:text-sm mt-2">
            Sign in to continue
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label class="block text-sm text-white mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required

                class="w-full rounded-xl bg-white/10 border border-white/20
                       text-white placeholder-gray-300
                       text-sm sm:text-base
                       px-4 py-3
                       focus:ring-2 focus:ring-[#D2C1B6]"

                placeholder="Enter your email"
            >

            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300 text-sm" />
        </div>

        <div class="mt-4 sm:mt-5">

            <label class="block text-sm text-white mb-2">
                Password
            </label>

            <input
                type="password"
                name="password"
                required

                class="w-full rounded-xl bg-white/10 border border-white/20
                       text-white placeholder-gray-300
                       text-sm sm:text-base
                       px-4 py-3
                       focus:ring-2 focus:ring-[#D2C1B6]"

                placeholder="Enter your password"
            >

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300 text-sm" />

        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mt-5">

            <label class="text-gray-200 text-sm">
                <input type="checkbox" name="remember" class="mr-2">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-[#D2C1B6] text-sm hover:underline">
                    Forgot password?
                </a>
            @endif

        </div>

        <button
            type="submit"

            class="w-full mt-6 bg-[#D2C1B6] text-[#1B3C53]
                   font-bold text-sm sm:text-base
                   py-3 rounded-xl
                   hover:scale-[1.02] transition">

            Log In

        </button>

        <p class="text-center text-gray-200 text-sm mt-5">

            Don't have an account?

            <a href="{{ route('register') }}"
               class="text-[#D2C1B6] font-semibold hover:underline">

                Register

            </a>

        </p>

    </form>

</x-guest-layout>