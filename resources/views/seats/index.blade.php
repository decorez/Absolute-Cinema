@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="mb-4 rounded-xl bg-green-500/10 border border-green-500/20 p-4 text-green-400 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-black tracking-tight text-white">Seat List</h1>
    <a href="{{ route('seats.create') }}" class="rounded-xl bg-[#D2C1B6] px-5 py-3 text-xs font-bold text-[#1B3C53] transition hover:scale-105">
        + Generate Seats
    </a>
</div>

@foreach($seats->groupBy('studio_id') as $studioSeats)
    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm mb-6">
        <div class="flex items-center justify-between pb-4 border-b border-white/10">
            <h2 class="text-xl font-bold text-white">
                {{ $studioSeats->first()->studio->name }}
            </h2>

            <form action="{{ route('seats.destroyByStudio', $studioSeats->first()->studio->id) }}" method="POST" class="delete-studio-seats m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-xl bg-red-500/10 border border-red-500/20 px-4 py-2 text-xs font-bold text-red-400 hover:bg-red-500 hover:text-white transition">
                    Delete All Seats
                </button>
            </form>
        </div>  

        <div class="grid grid-cols-2 sm:grid-cols-5 md:grid-cols-10 gap-2 mt-4">
            @foreach($studioSeats as $seat)
                <div class="rounded-lg bg-white/10 border border-white/5 text-white p-2.5 text-center text-xs font-medium">
                    {{ $seat->seat_number }}
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-studio-seats').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Delete Seats?',
                text: 'All seats in this studio will be removed.',
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