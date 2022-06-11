@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-white py-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
            </ol>
        </div>
    </nav>

    <div class="container mb-4">

        <div class="row">
            <!-- List of items-->
            <section class="{{ $carts->count() > 0 ? 'col-lg-8' : 'col-lg-12' }}">
               
                <x-alert></x-alert>

                <div class="card mb-2">

                    <div class="card-body">
                        <div class="fs-5">Produk ({{ $carts->count() }})</div>
                        @forelse ($carts as $cart)
                            <!-- Item-->
                            <div class="row align-items-center mt-3">
                                <div class="col-12 col-lg d-flex">
                                    <a class="me-2 me-lg-3" href="{{ route('product.single', $cart->item) }}">
                                        <img class="rounded-1"
                                            src="{{ asset('images/product/' . $cart->item->images[0]['path']) }}"
                                            style="max-width: 5rem" alt="Product">
                                    </a>
                                    <div>
                                        <p class="product-name fw-bold mb-1"><a
                                                href="{{ route('product.single', $cart->item) }}">{{ $cart->item->name }}</a>
                                        </p>
                                        <div>
                                            <span class="price text-accent">{{ rupiah($cart->item->price) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 d-block d-lg-flex justify-content-end">
                                    <div class="d-flex d-lg-block justify-content-between align-items-center">
                                        <form id="decrement{{ $cart->id }}"
                                            action="{{ route('cart.update', ['cart' => $cart, 'type' => 'decrement']) }}"
                                            method="post" hidden>
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <form id="increment{{ $cart->id }}"
                                            action="{{ route('cart.update', ['cart' => $cart, 'type' => 'increment']) }}"
                                            method="post" hidden>
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <div class="input-group mb-2">
                                            <button type="button" class="btn btn-sm btn-outline-secondary btn-qty"
                                                data-type="minus"
                                                onclick="document.getElementById('decrement{{ $cart->id }}').submit()"
                                                {{ $cart->qty == 1 ? 'disabled' : '' }}>
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="text" name="qty[]"
                                                class="form-control form-control-sm input-qty text-center"
                                                value="{{ $cart->qty }}" min="1" max="{{ $cart->item->stock }}"
                                                style="max-width: 3rem" autocomplete="off">
                                            <button type="button" class="btn btn-sm btn-outline-secondary btn-qty"
                                                data-type="plus"
                                                onclick="document.getElementById('increment{{ $cart->id }}').submit()">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                        <form id="cartDelete{{ $cart->id }}"
                                            action="{{ route('cart.destroy', $cart) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button class="btn btn-link px-0 text-danger remove-cart"
                                            onclick="document.getElementById('cartDelete{{ $cart->id }}').submit()">
                                            <i class="bi bi-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <p class="fs-3 fw-bold">Wah, keranjang belanjamu kosong!</p>
                                <p>Yuk, isi keranjang belanjamu!</p>
                                <a href="{{ route('product.all') }}" class="btn btn-primary">Mulai Belanja</a>
                            </div>
                        @endforelse


                    </div>
                </div>


            </section>

            @if ($carts->count() > 0)
                <!-- Sidebar-->
                <aside class="col-lg-4 pt-4 pt-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <p class="fs-5">Subtotal</p>
                                <p class="fs-5" id="subtotal">{{ rupiah($carts->sum('ammount')) }}</p>
                            </div>
                            <a href="{{ route('cart.checkout') }}"
                                class="btn btn-primary btn-shadow d-block w-100 mt-2 btn-checkout">
                                Checkout</span>
                            </a>
                            <div class="result"></div>
                        </div>
                    </div>
                </aside>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script>
        const btnQty = document.querySelectorAll('.btn-qty')
        const inputQty = document.querySelectorAll('.input-qty')

        btnQty.forEach(item => {
            item.addEventListener('click', (e) => {
                const btn = e.currentTarget;
                const type = btn.dataset.type

                e.currentTarget.value = 12

                if (type == "minus") {
                    const inputQty = btn.nextElementSibling
                    const value = parseInt(inputQty.value)
                    const min = parseInt(inputQty.min)
                    if (value > min) {
                        inputQty.value = value - 1
                    }
                    if (value == min) {
                        btn.setAttribute('disabled', true)
                    }
                    inputQty.dispatchEvent(new Event('change'))

                } else {
                    const inputQty = btn.previousElementSibling
                    const value = parseInt(inputQty.value)
                    const max = parseInt(inputQty.max)
                    if (value < max) {
                        inputQty.value = value + 1
                    }
                    if (value == max) {
                        btn.setAttribute('disabled', true)
                    }
                    inputQty.dispatchEvent(new Event('change'))
                }
            })

        });

        inputQty.forEach(input => {
            input.addEventListener('change', (e) => {
                const value = parseInt(e.target.value)

                const id = e.target.dataset.id
                const checkItem = document.querySelector(`.check-item[data-id='${id}']`)

                if (!isNaN(value)) {
                    const min = parseInt(e.target.min)
                    const max = parseInt(e.target.max)
                    const btnMin = e.target.previousElementSibling
                    const btnMax = e.target.nextElementSibling

                    if (value > min && value < max) {
                        btnMin.removeAttribute('disabled')
                        btnMax.removeAttribute('disabled')
                    }
                    if (value == 0) {
                        e.target.value = 1
                    }
                    if (value > max) {
                        e.target.value = max
                    }

                } else {
                    e.target.value = 1
                }

                let subtotal = parseInt(e.target.value) * parseInt(e.target.dataset.price)

                checkItem.dataset.subtotal = subtotal
                checkItem.value = e.target.value
                console.log('subtotal: ' + checkItem.dataset.subtotal)
                console.log('total: ' + total)
                console.log('value: ' + e.target.value)

                checkItem.dispatchEvent(new Event('change'))

            })

            input.addEventListener('keydown', (e) => {
                // Allow: backspace, delete, tab, escape, enter and .
                if ([46, 8, 9, 27, 13, 190].includes(e.keyCode) ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                        105)) {
                    e.preventDefault();
                }
            });
        })


        function startLoading() {
            $('.loader-ajax').attr('hidden', false)
        }

        function stopLoading() {
            $('.loader-ajax').attr('hidden', true)
        }
    </script>
@endpush
