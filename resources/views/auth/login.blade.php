<x-guest-layout>

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-white">
            Welcome Back
        </h2>

        <p class="text-gray-200 text-sm mt-2">
            Sign in to your account
        </p>
    </div>

    <x-auth-session-status class="mb-4 text-green-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <label class="text-white text-sm font-medium">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full mt-2 rounded-xl border-0 bg-white/10 text-white
                       placeholder-gray-300 focus:ring-2 focus:ring-[#D2C1B6]"
                placeholder="Enter your email"
            >

            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <label class="text-white text-sm font-medium">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full mt-2 rounded-xl border-0 bg-white/10 text-white
                       placeholder-gray-300 focus:ring-2 focus:ring-[#D2C1B6]"
                placeholder="Enter your password"
            >

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
        </div>

        <!-- Remember -->
        <div class="flex justify-between items-center mt-5 text-sm">

            <label class="text-gray-200">
                <input type="checkbox" name="remember" class="mr-2">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-[#D2C1B6] hover:underline">
                    Forgot Password?
                </a>
            @endif

        </div>

        <!-- Button -->
        <button
            type="submit"
            class="w-full mt-6 bg-[#D2C1B6] text-[#1B3C53]
                   font-bold py-3 rounded-xl
                   hover:scale-[1.02] transition duration-300">

            Log In

        </button>

        <!-- Register -->
        <p class="text-center text-gray-200 text-sm mt-5">
            Don't have an account?

            <a href="{{ route('register') }}"
               class="text-[#D2C1B6] font-semibold hover:underline">

                Register

            </a>
        </p>

    </form>

</x-guest-layout>