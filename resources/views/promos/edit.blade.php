@extends('layouts.admin')

@section('title', 'Edit Promo')

@section('content')
    <div class="max-w-2xl bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm text-white" 
     x-data="{ promoType: '{{ old('type', $promo->type) }}' }">
     
    <h3 class="mb-6 text-2xl font-bold tracking-tight text-white">
        Edit Promo: {{ $promo->title }}
    </h3>

    @if ($errors->any())
        <div class="mb-5 rounded-xl bg-red-500/10 border border-red-500/20 p-4 text-red-400 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('promos.update', $promo->id) }}" method="POST" enctype="multipart/form-data" class="m-0">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Promo Title
            </label>
            <input type="text" name="title" value="{{ old('title', $promo->title) }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Promo Type
            </label>
            <select name="type" 
                    x-model="promoType"
                    required
                    class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white text-sm focus:outline-none focus:border-[#D2C1B6] appearance-none cursor-pointer">
                <option value="discount" class="bg-[#1B3C53]">Cash Discount (Cut Total Price)</option>
                <option value="buy_1_get_1" class="bg-[#1B3C53]">Buy 1 Get 1 Free Ticket</option>
                <option value="free_item" class="bg-[#1B3C53]">Free Reward</option>
            </select>
        </div>

        <div class="mb-5" x-show="promoType === 'discount'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Discount Value (Rp)
            </label>
            <input type="number" name="value" value="{{ old('value', $promo->value ?? 0) }}" min="0" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white text-sm focus:outline-none focus:border-[#D2C1B6]">
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Description
            </label>
            <textarea name="description" rows="4" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">{{ old('description', $promo->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                    Start Date
                </label>
                <input type="date" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($promo->start_date)->format('Y-m-d')) }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">
            </div>
            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                    End Date
                </label>
                <input type="date" name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($promo->end_date)->format('Y-m-d')) }}" required class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] text-sm">
            </div>
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#D2C1B6]">
                Promo Banner Image
            </label>
            @if($promo->image)
                <div class="mb-3">
                    <p class="text-xs text-gray-400 mb-1">Current Banner:</p>
                    <img src="{{ asset('storage/' . $promo->image) }}" alt="Current Banner" class="w-32 h-20 object-cover rounded-xl border border-white/10">
                </div>
            @endif
            <input type="file" name="image" class="w-full rounded-xl bg-white/5 border border-white/10 p-3 text-white focus:outline-none focus:border-[#D2C1B6] file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#D2C1B6] file:text-[#1B3C53] hover:file:bg-white transition">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-[#D2C1B6] px-6 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
                Update Promo
            </button>
            <a href="{{ route('promos.index') }}" class="rounded-xl bg-white/5 border border-white/10 px-6 py-3 text-xs font-bold text-[#D2C1B6] transition hover:bg-white/10">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection