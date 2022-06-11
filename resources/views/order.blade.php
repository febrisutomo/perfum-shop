@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-white py-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </div>
    </nav>

    <div class="container mb-4">
        <div class="row">
            <!-- List of items-->

            <!-- Sidebar-->
            {{-- <aside class="col-lg-4">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </aside> --}}

            <section class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <x-alert></x-alert>
                        <div class="fs-5 mb-2">Daftar Transaksi</div>


                        <ul class="nav nav-pills mb-3">
                            <li class="nav-item">
                                <a class="nav-link @if(!Request::query('status')) active @endif" aria-current="page" href="{{ route('order.index') }}">Semua Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Request::query('status') == 'pending') active @endif" href="?status=pending">Menunggu Konfirmasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Request::query('status') == 'processed') active @endif" href="?status=processed">Diproses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Request::query('status') == 'shipped') active @endif" href="?status=shipped">Dalam Pengiriman</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Request::query('status') == 'completed') active @endif" href="?status=completed">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Request::query('status') == 'cancelled') active @endif" href="?status=cancelled">Dibatalkan</a>
                            </li>
                        </ul>

                        @forelse ($orders as $order)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="card-text fs-sm text-muted mb-2">
                                        @if ($order->status == 'pending')
                                            <div class="badge mr-2 bg-secondary">Menunggu Konfirmasi</div>
                                        @elseif($order->status == 'processed')
                                            <div class="badge mr-2 bg-warning">Diproses</div>
                                        @elseif($order->status == 'shipped')
                                            <div class="badge mr-2 bg-info">Sedang Dikirim</div>
                                        @elseif($order->status == 'completed')
                                            <div class="badge mr-2 bg-success">Selesai</div>
                                        @else
                                            <div class="badge mr-2 bg-danger">Dibatalkan</div>
                                        @endif
                                        <span class="me-2">{{ $order->invoice }}</span>
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $order->date }}, {{ $order->time }} WIB
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-12 col-lg d-flex mb-2 mb-lg-0">
                                            <a class="me-2 me-lg-3"
                                                href="{{ route('product.single', $order->items->first()) }}">
                                                <img class="rounded-1"
                                                    src="{{ asset('images/product/' . $order->items->first()->thumbnail) }}"
                                                    style="max-width: 5rem" alt="Product">
                                            </a>
                                            <div>
                                                <p class="product-title mb-1 fw-bold"><a
                                                        href="{{ route('product.single', $order->items->first()) }}">{{ $order->items->first()->name }}</a>
                                                </p>
                                                <div>
                                                    <span
                                                        class="price fs-md me-1">{{ rupiah($order->items->first()->pivot->price) }}</span>
                                                    <span class="fs-sm"> x
                                                        {{ $order->items->first()->pivot->qty }}</span>
                                                </div>
                                                @if ($order->items->count() > 1)
                                                    <div class="fs-sm mt-1">+{{ $order->items->count() - 1 }}
                                                        produk lainnya</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-lg-3 d-flex d-lg-block justify-content-between align-items-center text-lg-end">
                                            <div class="mb-lg-2">
                                                <div class="fs-sm">Total Belanja</div>
                                                <div class="mb-0 fw-bold">{{ rupiah($order->ammount) }}</div>
                                            </div>
                                            @if ($order->status == 'pending')
                                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#modalCancel_{{ $order->id }}">
                                                    Batalkan Pesanan
                                                </button>
                                            @elseif ($order->status == 'shipped')
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalCompleted_{{ $order->id }}">
                                                    Terima Pesanan
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalDetail_{{ $order->id }}">
                                                Lihat Detail
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Modal detail --}}
                            <div class="modal" id="modalDetail_{{ $order->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title fs-5 fw-bold">Detail Transaksi</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($order->status == 'pending')
                                                <div class="badge mr-2 bg-secondary">Menunggu Konfirmasi</div>
                                            @elseif($order->status == 'processed')
                                                <div class="badge mr-2 bg-warning">Diproses</div>
                                            @elseif($order->status == 'shipped')
                                                <div class="badge mr-2 bg-info">Sedang Dikirim</div>
                                            @elseif($order->status == 'completed')
                                                <div class="badge mr-2 bg-success">Selesai</div>
                                            @else
                                                <div class="badge mr-2 bg-danger">Dibatalkan</div>
                                            @endif
                                            <div class="fs-sm border-top mt-2 py-3">
                                                <div class="d-flex justify-content-between">
                                                    <div>Invoice</div>
                                                    <div class="text-primary">{{ $order->invoice }}</div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div>Tanggal pembelian</div>
                                                    <div>{{ $order->date }}</div>
                                                </div>
                                            </div>
                                            <div class="border-top border-5 pt-3 pb-2">
                                                <p class="fw-bold">Produk</p>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        @foreach ($order->items as $item)
                                                            <div class="row align-items-center mb-2">
                                                                <div class="col-12 col-lg d-flex mb-2 mb-lg-0">
                                                                    <a class="me-2 me-lg-3"
                                                                        href="{{ route('product.single', $item) }}">
                                                                        <img class="rounded-1"
                                                                            src="{{ asset('images/product/' . $item->thumbnail) }}"
                                                                            style="max-width: 5rem" alt="Product">
                                                                    </a>
                                                                    <div>
                                                                        <p class="product-title fw-bold mb-1">
                                                                            <a
                                                                                href="{{ route('product.single', $item) }}">{{ $item->name }}</a>
                                                                        </p>
                                                                        <div>
                                                                            <span
                                                                                class="price fs-md me-1">{{ rupiah($item->pivot->price) }}</span>
                                                                            <span class="fs-sm"> x
                                                                                {{ $item->pivot->qty }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-12 col-lg-3 d-flex d-lg-block justify-content-between align-items-center text-lg-end">
                                                                    <div class="mb-lg-2">
                                                                        <small>Subtotal</small>
                                                                        <div class="fw-bold">
                                                                            {{ rupiah($item->pivot->ammount) }}
                                                                        </div>
                                                                    </div>

                                                                    <form action="{{ route('cart.store') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="item_id"
                                                                            value="{{ $item->id }}">
                                                                        <input type="hidden" name="qty" value="1">

                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-outline-primary"
                                                                            {{ $item->is_active ? '' : 'disabled' }}>
                                                                            {{ $item->is_active ? 'Beli Lagi' : 'Stok Habis' }}
                                                                        </button>

                                                                    </form>

                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-top border-5 pt-3">
                                                <p class="fw-bold">Info Pengiriman</p>
                                                <table class="table table-borderless table-shipment">
                                                    <tr>
                                                        <td>Kurir</td>
                                                        <td>:</td>
                                                        <td class="text-uppercase">{{ $order->courier }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td>
                                                            <div class="fw-bold">{{ $order->shipping['name'] }}
                                                            </div>
                                                            {{ $order->shipping['phone'] }}<br>
                                                            {{ $order->shipping['address'] }}<br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Catatan</td>
                                                        <td>:</td>
                                                        <td>{{ $order->notes ?? '-' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="border-top border-5 pt-3 fs-sm">
                                                <p class="fw-bold">Detail Pembayaran</p>
                                                <div class="d-flex justify-content-between border-bottom mb-2 pb-2">
                                                    <div>Metode Pembayaran</div>
                                                    <div class="text-uppercase">{{ $order->payment }}</div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div>Total Harga ({{ $order->items->count() }} barang)</div>
                                                    <div>{{ rupiah($order->ammount) }}</div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div>Total Ongkir</div>
                                                    <div>{{ rupiah(0) }}</div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div>Total Diskon</div>
                                                    <div>-{{ rupiah(0) }}</div>
                                                </div>
                                                <div class="d-flex justify-content-between fw-bold border-top mt-2 pt-2">
                                                    <div>Total Bayar</div>
                                                    <div>{{ rupiah($order->ammount) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            @if ($order->status == 'pending')
                                                <button class="btn btn-sm btn-secondary">
                                                    Batalkan Pesanan
                                                </button>
                                            @elseif($order->status == 'shipped')
                                                <button class="btn btn-sm btn-success">
                                                    Terima Pesanan
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end modal detail --}}

                            <div class="modal fade" id="modalCompleted_{{ $order->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title fw-bold">Terima Pesanan</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('order.update', $order) }}" method="post">
                                            <div class="modal-body">
                                                <p class="text-center mb-3 fs-4 fw-bold">Anda yakin sudah menerima pesanan?
                                                    </h3>
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalCancel_{{ $order->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title fw-bold">Terima Pesanan</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('order.update', $order) }}" method="post">
                                            <div class="modal-body">
                                                <p class="text-center mb-3 fs-5 fw-bold">Anda yakin ingin membatalkan
                                                    pesanan ini?</h3>
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <div class="fs-4 fw-bold">Tidak ada transaksi yang ditemukan!</div>
                            </div>
                        @endforelse
                        <div class="d-flex justify-content-center pt-3">
                            {{ $orders->links() }}
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
