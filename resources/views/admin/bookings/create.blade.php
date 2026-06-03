@extends('layouts.admin')

@section('title', 'Create Booking (Admin)')

@section('content')
<div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white">
    <h3 class="mb-6 text-2xl font-bold tracking-tight text-white">
        Create New Ticket Booking
    </h3>

    <form action="{{ route('bookings.store', $schedule->id ?? '') }}" method="POST" class="m-0">
        @csrf

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Select Customer / User
            </label>
            <select name="user_id" class="w-full rounded-xl bg-[#1B3C53] border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                <option value="">-- Select Customer --</option>
                @foreach($users ?? [] as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Select Movie Schedule
            </label>
            <select name="schedule_id" class="w-full rounded-xl bg-[#1B3C53] border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
                <option value="">-- Select Movie & Time --</option>
                @foreach($schedules ?? [] as $sch)
                    <option value="{{ $sch->id }}">
                        {{ $sch->movie->title }} - {{ $sch->studio->name }} ({{ \Carbon\Carbon::parse($sch->show_date)->format('d M') }} @ {{ \Carbon\Carbon::parse($sch->show_time)->format('H:i') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Status Pembayaran
            </label>
            <div class="flex gap-4 mt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="status" value="pending" checked class="accent-[#D2C1B6]">
                    <span class="text-sm text-[#D2C1B6]">Pending (Belum Bayar)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="status" value="paid" class="accent-[#D2C1B6]">
                    <span class="text-sm text-[#D2C1B6]">Paid (Lunas)</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t border-white/10">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Proceed to Seats
            </button>
            <a href="{{ route('admin.bookings') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection