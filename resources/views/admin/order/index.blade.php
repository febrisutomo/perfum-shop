@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-shopping-cart"></i>
                        Daftar Pesanan
                    </h3>
                </div>
            </div>
            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <ul class="nav nav-pills mb-3">
                    <li class="nav-item">
                        <a class="nav-link @if (!Request::query('status')) active @endif" aria-current="page"
                            href="{{ route('admin.order.index') }}">Semua Pesanan ({{ $allOrders->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::query('status') == 'pending') active @endif" href="?status=pending">Pesanan Baru ({{ $allOrders->where('status', 'pending')->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::query('status') == 'processed') active @endif"
                            href="?status=processed">Siap Dikirim ({{ $allOrders->where('status', 'processed')->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::query('status') == 'shipped') active @endif"
                            href="?status=shipped">Dalam Pengiriman ({{ $allOrders->where('status', 'shipped')->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::query('status') == 'completed') active @endif"
                            href="?status=completed">Pesanan Selesai ({{ $allOrders->where('status', 'completed')->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::query('status') == 'cancelled') active @endif"
                            href="?status=cancelled">Dibatalkan ({{ $allOrders->where('status', 'cancelled')->count() }})</a>
                    </li>
                </ul>

                @forelse ($orders as $order)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="card-text mb-3 pb-2 border-bottom">
                                @if ($order->status == 'pending')
                                    <div class="badge mr-2 bg-secondary">Pesanan Baru</div>
                                @elseif($order->status == 'processed')
                                    <div class="badge mr-2 bg-warning">Siap Dikirim</div>
                                @elseif($order->status == 'shipped')
                                    <div class="badge mr-2 bg-info">Sedang Dikirim</div>
                                @elseif($order->status == 'completed')
                                    <div class="badge mr-2 bg-success">Selesai</div>
                                @else
                                    <div class="badge mr-2 bg-danger">Dibatalkan</div>
                                @endif
                                <span class="mr-2">{{ $order->invoice }}</span>
                                <i class="fa fa-user mr-1"></i>
                                <span class="mr-2">{{ $order->user->name }}</span>
                                <i class="fa fa-clock mr-1"></i>
                                {{ $order->date }}, {{ $order->time }} WIB
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-lg-5 mb-2 mb-lg-0 border-right">
                                    @foreach ($order->items as $item)
                                        @if ($loop->first)
                                            <div class="d-flex mb-2">
                                                <a class="mr-2 mr-lg-3" href="{{ route('admin.item.edit', $item) }}">
                                                    <img class="rounded-1"
                                                        src="{{ asset('images/product/' . $item->thumbnail) }}"
                                                        style="max-width: 5rem" alt="Product">
                                                </a>
                                                <div>
                                                    <p class="product-title mb-1 font-weight-bold"><a
                                                            href="{{ route('admin.item.edit', $item) }}">{{ $item->name }}</a>
                                                    </p>
                                                    <div>
                                                        <span
                                                            class="price  mr-1">{{ rupiah($item->pivot->price) }}</span>
                                                        <span class=""> x
                                                            {{ $item->pivot->qty }}</span>
                                                    </div>

                                                    </a>
                                                    @if ($order->items->count() > 1)
                                                        <a class="mt-1" data-toggle="collapse"
                                                            href="#collapseProducts_{{ $order->id }}"
                                                            role="button" aria-expanded="false"
                                                            aria-controls="collapseProducts_{{ $order->id }}">
                                                            Lihat {{ $order->items->count() - 1 }} produk lainnya
                                                            <i class="fa fa-angle-down"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="collapse"
                                        id="collapseProducts_{{ $order->id }}">
                                        @foreach ($order->items as $item)
                                            @if ($loop->index > 0)
                                                <div class="d-flex mb-2">
                                                    <a class="mr-2 mr-lg-3"
                                                        href="{{ route('admin.item.edit', $item) }}">
                                                        <img class="rounded-1"
                                                            src="{{ asset('images/product/' . $item->thumbnail) }}"
                                                            style="max-width: 5rem" alt="Product">
                                                    </a>
                                                    <div>
                                                        <p class="product-title mb-1 font-weight-bold"><a
                                                                href="{{ route('admin.item.edit', $item) }}">{{ $item->name }}</a>
                                                        </p>
                                                        <div>
                                                            <span
                                                                class="price  mr-1">{{ rupiah($item->pivot->price) }}</span>
                                                            <span class=""> x
                                                                {{ $item->pivot->qty }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>


                                </div>
                                <div class="col-12 col-lg mb-2 mb-lg-0 border-right">
                                    <h6 class=" font-weight-bold">Alamat</h6>
                                    <div>{{ $order->shipping['name'] }} ({{ $order->shipping['phone'] }})
                                    </div>
                                    <div>{{ $order->shipping['address'] }}</div>
                                </div>
                                <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                    <h6 class=" font-weight-bold">Pengiriman</h6>
                                    <div class="text-uppercase">{{ $order->courier }}</div>
                                    <h6 class=" font-weight-bold">Pembayaran</h6>
                                    <div class="text-uppercase">{{ $order->payment }}</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between bg-light rounded px-3 py-1">
                                <div class="font-weight-bold">Total Harga ({{ $order->items->count() }} barang)
                                </div>
                                <div class="font-weight-bold">{{ rupiah($order->ammount) }}</div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="d-flex justify-content-between">
                                <div class="btn btn-light"> <i class="fa fa-receipt mr-1"></i> Detail Status</div>

                                <div>
                                    @if ($order->status == 'pending')
                                        <div class="btn btn-danger" data-toggle="modal"
                                            data-target="#modalCancel_{{ $order->id }}">Cancel
                                            Pesanan
                                        </div>
                                        <div class="btn btn-primary" data-toggle="modal"
                                            data-target="#modalTerima_{{ $order->id }}">Terima
                                            Pesanan
                                        </div>
                                    @elseif($order->status == 'processed')
                                        <div class="btn btn-primary" data-toggle="modal"
                                            data-target="#modalKirim_{{ $order->id }}">Kirim Pesanan
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalTerima_{{ $order->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Terima Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center mb-3">Pastikan semua produk tersedia!</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            @foreach ($order->items as $item)
                                                <div class="d-flex mb-2 border-bottom pb-2">
                                                    <a class="mr-2 mr-lg-3"
                                                        href="{{ route('admin.item.edit', $item) }}">
                                                        <img class="rounded-1"
                                                            src="{{ asset('images/product/' . $item->thumbnail) }}"
                                                            style="max-width: 5rem" alt="Product">
                                                    </a>
                                                    <div>
                                                        <p class="product-title mb-1 font-weight-bold"><a
                                                                href="{{ route('admin.item.edit', $item) }}">{{ $item->name }}</a>
                                                        </p>
                                                        <div>
                                                            <span
                                                                class="price  mr-1">{{ rupiah($item->pivot->price) }}</span>
                                                            <span class=""> x
                                                                {{ $item->pivot->qty }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.order.update', $order) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="processed">
                                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalKirim_{{ $order->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kirim Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.order.update', $order) }}" method="post">
                                    <div class="modal-body">
                                        <h4 class="text-center mb-3">Silahkan masukkan nomor resi!</h4>
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="shipped">
                                        <input type="text" name="resi" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalCancel_{{ $order->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Batalkan Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.order.update', $order) }}" method="post">
                                    <div class="modal-body">
                                        <h4 class="text-center mb-3">Masukkan alasan pembatalan pesanan</h3>
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <textarea class="form-control" name="cancel_reason"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <h3>Tidak ada transaksi yang ditemukan!</h3>
                    </div>
                @endforelse
                <div class="d-flex justify-content-center pt-3">
                    {{ $orders->links() }}
                </div>

                {{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="semua-pesanan-tab" data-toggle="pill" href="#semua-pesanan"
                            role="tab" aria-controls="semua-pesanan" aria-selected="true">Semua Pesanan
                            ({{ $orders->count() }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pesanan-baru-tab" data-toggle="pill" href="#pesanan-baru" role="tab"
                            aria-controls="pesanan-baru" aria-selected="false">Pesanan Baru
                            ({{ $orders->where('status', 'pending')->count() }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="siap-dikirim-tab" data-toggle="pill" href="#siap-dikirim" role="tab"
                            aria-controls="siap-dikirim" aria-selected="false">Siap Dikirim
                            ({{ $orders->where('status', 'processed')->count() }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="dalam-pengiriman-tab" data-toggle="pill" href="#dalam-pengiriman"
                            role="tab" aria-controls="dalam-pengiriman" aria-selected="false">Dalam Pengiriman
                            ({{ $orders->where('status', 'shipped')->count() }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pesanan-selesai-tab" data-toggle="pill" href="#pesanan-selesai"
                            role="tab" aria-controls="pesanan-selesai" aria-selected="false">Pesanan Selesai
                            ({{ $orders->where('status', 'completed')->count() }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="dibatalkan-tab" data-toggle="pill" href="#dibatalkan" role="tab"
                            aria-controls="dibatalkan" aria-selected="false">Dibatalkan
                            ({{ $orders->where('status', 'cancelled')->count() }})</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="semua-pesanan" role="tabpanel"
                        aria-labelledby="semua-pesanan-tab">
                        <x-order-list></x-order-list>
                    </div>
                    <div class="tab-pane fade" id="pesanan-baru" role="tabpanel" aria-labelledby="pesanan-baru-tab">
                        <x-order-list status="pending"></x-order-list>
                    </div>
                    <div class="tab-pane fade" id="siap-dikirim" role="tabpanel" aria-labelledby="siap-dikirim-tab">
                        <x-order-list status="processed"></x-order-list>
                    </div>
                    <div class="tab-pane fade" id="dalam-pengiriman" role="tabpanel"
                        aria-labelledby="dalam-pengiriman-tab">
                        <x-order-list status="shipped"></x-order-list>
                    </div>
                    <div class="tab-pane fade" id="pesanan-selesai" role="tabpanel" aria-labelledby="pesanan-selesai-tab">
                        <x-order-list status="completed"></x-order-list>
                    </div>
                    <div class="tab-pane fade" id="dibatalkan" role="tabpanel" aria-labelledby="dibatalkan-tab">
                        <x-order-list status="cancelled"></x-order-list>
                    </div>
                </div> --}}



            </div>
        </div>
    </div>
@endsection
