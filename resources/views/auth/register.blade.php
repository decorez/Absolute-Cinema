<x-guest-layout>

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-white">
            Create Account
        </h2>

        <p class="text-gray-200 text-sm mt-2">
            Join Absolute Cinema today
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label class="text-white text-sm font-medium">
                Full Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                class="w-full mt-2 rounded-xl border-0 bg-white/10 text-white"
                placeholder="Enter your name"
            >

            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300" />
        </div>

        <!-- Email -->
        <div class="mt-5">
            <label class="text-white text-sm font-medium">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full mt-2 rounded-xl border-0 bg-white/10 text-white"
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
                class="w-full mt-2 rounded-xl border-0 bg-white/10 text-white"
                placeholder="Enter password"
            >

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-5">
            <label class="text-white text-sm font-medium">
                Confirm Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full mt-2 rounded-xl border-0 bg-white/10 text-white"
                placeholder="Confirm password"
            >

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-300" />
        </div>

        <!-- Button -->
        <button
            type="submit"
            class="w-full mt-6 bg-[#D2C1B6] text-[#1B3C53]
                   font-bold py-3 rounded-xl
                   hover:scale-[1.02] transition duration-300">

            Create Account

        </button>

        <!-- Login -->
        <p class="text-center text-gray-200 text-sm mt-5">
            Already have an account?

            <a href="{{ route('login') }}"
               class="text-[#D2C1B6] font-semibold hover:underline">

                Login

            </a>
        </p>

    </form>

</x-guest-layout>