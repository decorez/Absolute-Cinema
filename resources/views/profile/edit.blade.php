@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="min-h-screen bg-[#1B3C53] py-10 px-4">
    <div class="max-w-2xl mx-auto">

        <a href="{{ url('/') }}"
           class="inline-flex items-center text-xs text-[#D2C1B6] hover:text-white transition font-bold uppercase tracking-widest mb-6">
            ← Back
        </a>

        <h2 class="text-3xl font-black text-white mb-8 mt-2">My Profile</h2>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6 flex items-center gap-6">
            <div class="w-16 h-16 rounded-full bg-[#D2C1B6] text-[#1B3C53] flex items-center justify-center text-2xl font-black uppercase flex-shrink-0">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="ml-1">
                <p class="text-white font-bold text-lg">{{ auth()->user()->name }}</p>
                <p class="text-[#D2C1B6] text-sm">{{ auth()->user()->email }}</p>
                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase
                    {{ auth()->user()->role === 'admin' ? 'bg-purple-500/20 text-purple-400' : 'bg-blue-500/20 text-blue-400' }}">
                    {{ auth()->user()->role ?? 'user' }}
                </span>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6">
            <h3 class="text-white font-bold text-lg mb-5">Update Profile</h3>

            @if(session('status') === 'profile-updated')
                <div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-3 text-green-400 text-sm">
                    Profile updated successfully!
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#D2C1B6] mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                    @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#D2C1B6] mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                    @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit"
                    class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                    Save Changes
                </button>
            </form>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6">
            <h3 class="text-white font-bold text-lg mb-5">Change Password</h3>

            @if(session('status') === 'password-updated')
                <div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-3 text-green-400 text-sm">
                    Password updated successfully!
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#D2C1B6] mb-2">Current Password</label>
                    <input type="password" name="current_password"
                        class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                    @error('current_password', 'updatePassword')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#D2C1B6] mb-2">New Password</label>
                    <input type="password" name="password"
                        class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                    @error('password', 'updatePassword')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#D2C1B6] mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                </div>

                <button type="submit"
                    class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                    Update Password
                </button>
            </form>
        </div>

        <div class="bg-red-500/5 border border-red-500/20 rounded-2xl p-6">
            <h3 class="text-red-400 font-bold text-lg mb-2">Delete Account</h3>
            <p class="text-xs text-[#D2C1B6] mb-5">Once deleted, all data will be permanently removed.</p>

            <form method="POST" action="{{ route('profile.destroy') }}" id="delete-form">
                @csrf
                @method('DELETE')
                <input type="password" name="password" placeholder="Enter your password to confirm"
                    class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-red-400 mb-4">
                @error('password', 'userDeletion')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror

                <button type="submit" id="delete-btn"
                    class="rounded-xl bg-red-500/10 border border-red-500/20 px-6 py-3 text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white transition">
                    Delete Account
                </button>
            </form>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('delete-btn').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Delete Account?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#4b5563',
        confirmButtonText: 'Yes, delete it',
        background: '#1B3C53',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form').submit();
        }
    });
});
</script>

@endsection