@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-white py-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengiriman</li>
            </ol>
        </div>
    </nav>

    <div class="container mb-4">
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-8">
                <form id="order" action="{{ route('order.store') }}" method="post">
                    @csrf
                    <div class="card mb-2">
                        <div class="card-body">
                            <p class="fw-bold">Alamat Pengiriman</p>
                            <div class="mb-3">
                                <label class="form-label required" for="name">Nama Penerima</label>
                                <input type="text" name="shipping[name]" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ Auth::user()->name }}"></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required" for="phone">Nomor HP</label>
                                <input type="text" name="shipping[phone]" id="phone"
                                    class="form-control @error('phone') is-invalid @enderror"></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required" for="address">Alamat</label>
                                <textarea name="shipping[address]" id="address" class="form-control @error('address') is-invalid @enderror"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="card my-2">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required" for="courier">Pilih Kurir</label>
                                <select class="form-select @error('courier') is-invalid @enderror" id="courier" name="courier">
                                    <option value="">-- Pilih Kurir --</option>
                                    <option value="jne">JNE</option>
                                    <option value="j&t">J&T</option>
                                    <option value="sicepat">Si Cepat</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required" for="payment">Pilih Pembayaran</label>
                                <select class="form-select @error('payment') is-invalid @enderror" id="payment" name="payment">
                                    <option value="">-- Pilih Pembayaran --</option>
                                    <option value="gopay">Gopay</option>
                                    <option value="dana">Dana</option>
                                    <option value="ovo">OVO</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </form>

            </section>

            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="fw-bold">Produk</div>
                        @foreach ($carts as $cart)
                            <!-- Item-->
                            <div class="row align-items-center mt-2">
                                <div class="col-12 col-lg d-flex">
                                    <a class="me-2 me-lg-3" href="{{ route('product.single', $cart->item) }}">
                                        <img class="rounded-1"
                                            src="{{ asset('images/product/' . $cart->item->thumbnail) }}"
                                            style="max-width: 4rem" alt="Product">
                                    </a>
                                    <div>
                                        <p class="product-name mb-1" style="font-size: .9rem; font-weight: 400"><a
                                                href="{{ route('product.single', $cart->item) }}">{{ $cart->item->name }}</a>
                                        </p>
                                        <div>
                                            <span class="price text-accent">{{ rupiah($cart->item->price) }}</span>
                                            <small> x {{ $cart->qty }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>Subtotal</div>
                            <div id="subtotal">{{ rupiah($carts->sum('ammount')) }}</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>Ongkos Kirim</div>
                            <div id="subtotal">Rp 0</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>Diskon</div>
                            <div id="subtotal">Rp 0</div>
                        </div>
                        <div class="d-flex justify-content-between fs-5 fw-bold mt-2">
                            <p>Total</p>
                            <p id="subtotal">{{ rupiah($carts->sum('ammount')) }}</p>
                        </div>
                        <button class="btn btn-primary btn-shadow d-block w-100 mt-2" onclick="document.getElementById('order').submit()">
                            Bayar</span>
                        </button>
                        <div class="result"></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
