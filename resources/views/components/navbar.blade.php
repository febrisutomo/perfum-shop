    <nav id="navbar" class="navbar navbar-expand-md navbar-light bg-white sticky-lg-top shadow-sm">
        <div class="container">
            <a class="text-danger h1 me-3" href="{{ url('/') }}">
                Perfume
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-uppercase" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Brand</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Top Pick</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sale</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto text-capitalize">
                    <!-- Authentication Links -->
                    <li class="nav-item my-auto">
                        <a href="#searchBox" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="searchBox" class="text-danger search-action p-1 me-3"><i class="bi bi-search"></i></a>

                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item my-auto">
                                <a class="btn btn-outline-danger me-3 text-uppercase"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item my-auto">
                                <a class="btn btn-danger me-3 text-uppercase"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown my-auto">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle me-3 text-uppercase" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i>Akun Saya
                                </a>
                                @if (Auth::user()->role == 'admin')
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-shield-check me-2"></i>Admin Panel
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('order.index') }}">
                                    <i class="bi bi-bag me-2"></i>Transaksi
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="cartDropdown" class="nav-link dropdown-toggle dropdown-cart me-3 position-relative"
                                href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>
                                <i class="bi bi-cart fs-4"></i>
                                @if ($carts->count() > 0)
                                    <span
                                        class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $carts->count() }}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cartDropdown">
                                <div class="p-2" style="width: 20rem">
                                    <div style="max-height: 20rem; overflow-y:scroll">

                                        @forelse ($carts as $cart)
                                            <div class="cart-item border-bottom pb-2 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <a class="d-block flex-shrink-0"
                                                        href="{{ route('product.single', $cart->item) }}">
                                                        <img src="{{ asset('images/product/' . $cart->item->thumbnail) }}"
                                                            width="64" alt="Product"></a>
                                                    <div class="ps-2">
                                                        <div class="cart-product-title"
                                                            style="font-size: .9rem; font-weight: 400">
                                                            <a
                                                                href="{{ route('product.single', $cart->item) }}">{{ $cart->item->name }}</a>
                                                        </div>
                                                        <div class="card-product-meta">
                                                            <span
                                                                class="me-2">{{ rupiah($cart->item->price) }}</span>
                                                            <span style="font-size: .8rem">x {{ $cart->qty }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center text-capitalize">Belum ada barang yang dimasukkan!</p>
                                            <div class="text-center">
                                                <a href="{{ route('product.all') }}"
                                                    class="btn btn-outline-primary flex-fill me-2">Belanja Sekarang
                                                </a>
                                            </div>
                                        @endforelse

                                    </div>
                                    @if ($carts->count() > 0)
                                        <div class="d-flex justify-content-between pt-2 bg-white">
                                            <a href="{{ route('cart.index') }}"
                                                class="btn btn-outline-primary flex-fill me-2">Lihat
                                                Keranjang
                                            </a>
                                            <a href="{{ route('cart.checkout') }}"
                                                class="btn btn-primary flex-fill ">Checkout</a>

                                        </div>
                                    @endif

                                </div>
                            </div>
                        </li>
                    @endguest
                    {{-- <li class="nav-item my-auto">
                        <div class="nav-icon cart-icon"><i class="bi bi-bag"></i></div>
                    </li> --}}
                </ul>
            </div>
        </div>
        <!-- Search collapse-->
        
    </nav>
