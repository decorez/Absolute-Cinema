@extends('layouts.admin')

@section('title', 'Promos')

@section('content')

@if(session('success'))
<div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-4 text-green-400 text-sm font-medium">
    {{ session('success') }}
</div>
@endif

<div class="flex items-center justify-between mb-6">
    <h2 class="text-3xl font-black tracking-tight text-white">
        Promo List
    </h2>

    <a href="{{ route('promos.create') }}"
        class="rounded-xl bg-[#D2C1B6] px-5 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
        Add Promo
    </a>
</div>

<div class="overflow-hidden rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
    <table class="w-full text-sm text-left text-white">
        <thead class="bg-white/5 border-b border-white/10 text-xs font-bold text-[#D2C1B6] uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4">Banner</th>
                <th class="px-6 py-4">Title</th>
                <th class="px-6 py-4">Type</th>
                <th class="px-6 py-4">Benefit Value</th>
                <th class="px-6 py-4">Period</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-white/5">
            @forelse($promos as $promo)
            <tr class="hover:bg-white/5 transition">

                <td class="px-6 py-4">
                    @if($promo->image)
                    <img src="{{ asset('storage/' . $promo->image) }}"
                        alt="{{ $promo->title }}"
                        class="w-24 h-14 object-cover rounded-xl border border-white/10">
                    @else
                    <div class="w-24 h-14 rounded-xl bg-white/5 flex items-center justify-center text-xs text-gray-400">
                        No Image
                    </div>
                    @endif
                </td>

                <td class="px-6 py-4 font-bold text-white">
                    {{ $promo->title }}
                </td>

                <td class="px-6 py-4 text-sm font-semibold tracking-wide">
                    @if($promo->type === 'discount')
                    <span class="text-blue-400">Cash Discount</span>
                    @elseif($promo->type === 'buy_1_get_1')
                    <span class="text-purple-400">Buy 1 Get 1</span>
                    @elseif($promo->type === 'free_item')
                    <span class="text-amber-400">Free Reward</span>
                    @else
                    <span class="text-gray-400">{{ ucfirst($promo->type) }}</span>
                    @endif
                </td>

                <td class="px-6 py-4 font-mono text-xs">
                    @if($promo->type === 'discount')
                    Rp {{ number_format($promo->value, 0, ',', '.') }}
                    @elseif($promo->type === 'buy_1_get_1')
                    1 Free Ticket
                    @elseif($promo->type === 'free_item')
                    1 Free Reward
                    @else
                    -
                    @endif
                </td>

                <td class="px-6 py-4 text-[#D2C1B6] text-xs">
                    {{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                </td>

                <td class="px-6 py-4">
                    @if($promo->is_active && now()->lte($promo->end_date))
                    <span class="px-2 py-1 text-[10px] font-bold uppercase bg-green-500/10 text-green-400 rounded-lg border border-green-500/20">
                        Active
                    </span>
                    @else
                    <span class="px-2 py-1 text-[10px] font-bold uppercase bg-red-500/10 text-red-400 rounded-lg border border-red-500/20">
                        Expired
                    </span>
                    @endif
                </td>

                <td class="px-6 py-4">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('promos.edit', $promo->id) }}"
                            class="rounded-xl bg-yellow-500/10 border border-yellow-500/20 px-4 py-2 text-xs font-bold text-yellow-400 hover:bg-yellow-500 hover:text-white transition">
                            Edit
                        </a>

                        <form action="{{ route('promos.destroy', $promo->id) }}"
                            method="POST"
                            class="delete-form m-0">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="rounded-xl bg-red-500/10 border border-red-500/20 px-4 py-2 text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="7" class="py-12 text-center text-sm text-[#D2C1B6]/60">
                    No promos found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Delete Promo?',
                text: 'This promo will be permanently removed.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Yes, Delete',
                background: '#1B3C53',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection