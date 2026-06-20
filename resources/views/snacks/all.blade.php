@extends('layouts.app')

@section('content')
<div class="min-h-screen text-white bg-gradient-to-br from-[#1B3C53] via-[#234C6A] to-[#456882]">

    <header class="max-w-6xl mx-auto pt-12 pb-6 px-6">

        <a href="{{ url('/') }}" class="text-xs text-[#D2C1B6] hover:text-white flex items-center gap-1 mb-2 transition">
            ← Back to Home
        </a>

        <div class="text-center">
            <h1 class="text-3xl font-extrabold mb-2">Concession & Snacks</h1>
            <p class="text-sm text-[#D2C1B6]">Select your snacks</p>
        </div>

    </header>


    <section class="max-w-6xl mx-auto px-6 mb-10">
        <div class="flex justify-center items-center gap-3 overflow-x-auto pb-3 scrollbar-none">
            <button
                class="category-btn px-5 py-2 rounded-full text-xs font-bold bg-[#D2C1B6] text-[#1B3C53]"
                data-category="all">
                All Items
            </button>

            <button
                class="category-btn px-5 py-2 rounded-full text-xs font-semibold bg-white/5 border border-white/10 text-white/80"
                data-category="Popcorn">
                🍿 Popcorn
            </button>

            <button
                class="category-btn px-5 py-2 rounded-full text-xs font-semibold bg-white/5 border border-white/10 text-white/80"
                data-category="Beverage">
                🥤 Beverages
            </button>

            <button
                class="category-btn px-5 py-2 rounded-full text-xs font-semibold bg-white/5 border border-white/10 text-white/80"
                data-category="Sides">
                🍟 Sides
            </button>
        </div>
    </section>

    <main class="max-w-6xl mx-auto px-6 pb-32">

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($snacks as $snack)
            <div
                class="snack-card rounded-2xl bg-[#234C6A]/60 p-4 border border-white/10"
                data-category="{{ $snack->category }}">

                <div class="aspect-square bg-[#1B3C53] rounded-xl flex items-center justify-center mb-3 overflow-hidden">
                    @if($snack->image)
                    <img src="{{ $snack->image }}" alt="{{ $snack->name }}" class="w-full h-full object-cover">
                    @else
                    🍿
                    @endif
                </div>

                <div class="mb-3">
                    <h3 class="font-bold text-sm">{{ $snack->name }}</h3>
                    <p class="text-xs text-white/60">Rp {{ number_format($snack->price) }}</p>
                    <p class="text-xs mt-1">
                        @if($snack->stock > 0)
                            Stock: {{ $snack->stock }}
                        @else
                            <span class="text-red-400 font-bold">
                                Sold Out
                            </span>
                        @endif
                    </p>
                </div>

                <div class="flex items-center justify-between">

                    <button
                        onclick="minusSnack({{ $snack->id }})"
                        class="w-8 h-8 bg-white/10 rounded text-white">
                        -
                    </button>

                    <span id="qty-{{ $snack->id }}" class="text-sm font-bold">0</span>

                    <button
                        id="plus-{{ $snack->id }}"
                        data-stock="{{ $snack->stock }}"
                        {{ $snack->stock <= 0 ? 'disabled' : '' }}
                        onclick="plusSnack(
                                {{ $snack->id }},
                                '{{ $snack->name }}',
                                {{ $snack->price }},
                                {{ $snack->stock }}
                            )"
                        class="w-8 h-8 bg-[#D2C1B6] text-[#1B3C53] font-bold rounded">
                        +
                    </button>

                </div>

            </div>
            @endforeach

        </div>

    </main>

    <div class="fixed bottom-0 left-0 w-full bg-[#1B3C53]/95 border-t border-white/10 p-4 flex justify-between items-center">

        <div>
            <p class="text-xs text-white/60">
                <span id="item-count">0</span> item selected
            </p>

            <p class="text-sm font-bold">
                Total: <span id="total">Rp 0</span>
            </p>
        </div>

        <button onclick="checkout()" class="bg-[#D2C1B6] text-[#1B3C53] px-6 py-3 rounded-xl font-bold hover:scale-105 transition">
            Checkout
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</div>

<script>
    let snacks = [];

    document.addEventListener('DOMContentLoaded', () => {

        const filterButtons = document.querySelectorAll('.category-btn');
        const snackCards = document.querySelectorAll('.snack-card');

        filterButtons.forEach(button => {

            button.addEventListener('click', () => {

                const category = button.dataset.category;

                filterButtons.forEach(btn => {

                    btn.classList.remove(
                        'bg-[#D2C1B6]',
                        'text-[#1B3C53]'
                    );

                    btn.classList.add(
                        'bg-white/5',
                        'border',
                        'border-white/10',
                        'text-white/80'
                    );

                });

                button.classList.remove(
                    'bg-white/5',
                    'border',
                    'border-white/10',
                    'text-white/80'
                );

                button.classList.add(
                    'bg-[#D2C1B6]',
                    'text-[#1B3C53]'
                );

                snackCards.forEach(card => {

                    if (
                        category === 'all' ||
                        card.dataset.category === category
                    ) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }

                });

            });

        });

    });

    function plusSnack(id, name, price, stock) {
        let item = snacks.find(s => s.id === id);

        if (item) {

            if (item.qty >= stock) {
                alert(`Only ${stock} ${name} left in stock.`);
                return;
            }

            item.qty++;

        } else {

            if (stock <= 0) {
                alert(`${name} is out of stock.`);
                return;
            }

            snacks.push({
                id,
                name,
                price,
                qty: 1
            });
        }

        updateUI(id);
        updateTotal();
    }

    function minusSnack(id) {
        let item = snacks.find(s => s.id === id);

        if (!item) return;

        item.qty--;

        if (item.qty <= 0) {
            snacks = snacks.filter(s => s.id !== id);
        }

        updateUI(id);
        updateTotal();
    }

    function updateUI(id) {
        let item = snacks.find(s => s.id === id);

        document.getElementById(`qty-${id}`).innerText =
            item ? item.qty : 0;

        const plusBtn = document.getElementById(`plus-${id}`);

        if (plusBtn) {
            const stock = parseInt(plusBtn.dataset.stock);

            if (item && item.qty >= stock) {
                plusBtn.disabled = true;
                plusBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                plusBtn.disabled = false;
                plusBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    function updateTotal() {
        let total = snacks.reduce(
            (sum, s) => sum + (s.price * s.qty),
            0
        );

        let count = snacks.reduce(
            (sum, s) => sum + s.qty,
            0
        );

        document.getElementById('total').innerText =
            'Rp ' + total.toLocaleString('id-ID');

        document.getElementById('item-count').innerText =
            count;
    }


    function checkout() {
        if (snacks.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Snack Selected',
                text: 'Please select at least one snack.',
                background: '#1B3C53',
                color: '#fff',
                confirmButtonColor: '#D2C1B6'
            });
            return;
        }

        fetch('{{ route("snacks.checkout") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .content
                },
                body: JSON.stringify({
                    snacks: snacks
                })
            })
            .then(async res => {

                if (res.status === 401) {
                    window.location.href = '{{ route("login") }}';
                    return;
                }

                const data = await res.json();

                if (res.ok && data.redirect) {
                    window.location.href = data.redirect;
                } else if (data.error) {
                    alert(data.error);
                } else if (data.errors) {
                    const messages =
                        Object.values(data.errors)
                        .flat()
                        .join('\n');

                    alert(messages);
                } else {
                    alert('Checkout failed. Please try again.');
                }
            })
            .catch(() => {
                alert(
                    'Network error. Please check your connection and try again.'
                );
            });
    }
</script>

@endsection