<x-guest-layout>

    <div class="text-center mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-white">
            Create Account
        </h2>

        <p class="text-gray-200 text-sm mt-2">
            Join Absolute Cinema
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label class="text-white text-sm">Full Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required

                class="w-full mt-2 px-4 py-3 rounded-xl
                       bg-white/10 border border-white/20
                       text-white"
            >

            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300 text-sm" />
        </div>

        <div class="mt-4">
            <label class="text-white text-sm">Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required

                class="w-full mt-2 px-4 py-3 rounded-xl
                       bg-white/10 border border-white/20
                       text-white"
            >

            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300 text-sm" />
        </div>

        <div class="mt-4">
            <label class="text-white text-sm">Password</label>

            <input
                type="password"
                name="password"
                required

                class="w-full mt-2 px-4 py-3 rounded-xl
                       bg-white/10 border border-white/20
                       text-white"
            >

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300 text-sm" />
        </div>

        <div class="mt-4">
            <label class="text-white text-sm">Confirm Password</label>

            <input
                type="password"
                name="password_confirmation"
                required

                class="w-full mt-2 px-4 py-3 rounded-xl
                       bg-white/10 border border-white/20
                       text-white"
            >

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-300 text-sm" />
        </div>

        <button
            type="submit"

            class="w-full mt-6 bg-[#D2C1B6]
                   text-[#1B3C53]
                   font-bold py-3 rounded-xl">

            Create Account

        </button>

    </form>

</x-guest-layout>