<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">

    <style>
        .navbar a.nav-link {
            font-weight: 400;
            color: #313131 !important;
        }

        .navbar a.nav-link:hover {
            color: var(--bs-danger) !important
        }


        .square-img-wrapper {
            position: relative;
            overflow: hidden;
            padding-bottom: 100%;
        }

        .square-img-wrapper img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }


        .search-action {
            cursor: pointer;
        }

        .dropdown-toggle.dropdown-cart::after {
            display: none !important;
        }

    </style>
    @stack('style')

</head>

<body>
    <div id="app">

        <x-navbar></x-navbar>
        <div class="collapse" id="searchBox">
            <div class="card p-3 border-0 rounded-0 shadow-sm position-fixed w-100" style="z-index: 999">
                <div class="container">
                    <form class="input-group" method="GET" action="{{ route('product.search') }}">
                        <input class="form-control" type="text" name="search" placeholder="Cari produk"
                            value="{{ Request::query('search') }}" required>
                        <button class="btn btn-outline-secondary" type="submit"><i
                                class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <main id="main">
            @yield('content')
        </main>

        <div class="loader loader-page">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
        <div class="loader loader-ajax" hidden>
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>


        <footer class="footer pt-5">
            <div class="container pt-2 pb-3">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-4">
                        <a class="h1" href="#">
                            Perfume Shop</a>
                        <p class="pb-1">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis
                            voluptates corrupti voluptate itaque excepturi atque exercitationem esse saepe distinctio
                            incidunt.</p>
                        <div class="fs-5 fw-bold mb-1">Sosial Media</div>
                        <div class="d-flex fs-1 justify-content-center justify-content-md-start">
                            <a href="#"><i class="bi bi-instagram me-3"></i></a>
                            <a href="#"><i class="bi bi-facebook me-3"></i></a>
                            <a href="#"><i class="bi bi-tiktok me-3"></i></a>
                        </div>


                    </div>

                    <div class="col-md-3 col-sm-5 mb-4 footer-menu">
                        <div class="fs-5 fw-bold mb-1 ">Akun Saya</div>
                        <ul class=" list-unstyled lh-lg">
                            <li><a class="menu-link" href="#">Belanja</a>
                            </li>
                            <li><a class="menu-link" href="#">Fragrance</a>
                            </li>
                            <li><a class="menu-link" href="#">Tentang Kami</a>
                            </li>
                            <li><a class="menu-link" href="#">Blog</a>
                            </li>
                            <li><a class="menu-link" href="#">Hubungi Kami</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="fs-5 fw-bold mb-1 ">Bantuan</div>
                        <ul class="list-unstyled lh-lg">
                            <li><a class="menu-link" href="#">FAQ</a>
                            </li>
                            <li><a class="menu-link" href="#">Syarat dan Ketentuan</a>
                            </li>
                            <li><a class="menu-link" href="#">Kebijakan Privasi</a>
                            </li>
                            <li><a class="menu-link" href="#">Syarat dan Ketentuan</a>
                            </li>
                        </ul>
                        <div class="fs-5 fw-bold mb-1 ">Info Kontak</div>
                        <ul class="list-unstyled lh-lg">
                            <li><a class="menu-link" href="#">Email: perfume@shop.com</a>
                            </li>
                            <li><a class="menu-link" href="#">Whatsapp: 0812-3000-4000</a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="d-md-flex justify-content-center">
                        <span class="me-1">©2022 All rights reserved.
                            Made by</span>
                        <a href="#" target="_blank" rel="noopener">Perfum Team</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}

    <script>
        const rupiah = (number) => {
            return 'Rp ' + new Intl.NumberFormat(['ban', 'id']).format(number);
        };

        $(window).on('load', function() {
            $(".loader-page").fadeOut('fast');
        })

        // let bsCollapse = new bootstrap.Collapse(document.getElementById('searchBox'), {
        //     toggle: false
        // })

        // document.getElementById('main').addEventListener('click', () => {
        //     bsCollapse.hide()
        // })
        // document.getElementById('navbar').addEventListener('click', () => {
        //     bsCollapse.hide()
        // })
    </script>
    @stack('script')

    <style>
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: rgba(255, 255, 255, 0);
        }

        .loader-page {
            background-color: #fff;
        }

        .spinner,
        .dual-ring {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner>div {
            width: 18px;
            height: 18px;
            background-color: #fe696a;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {

            0%,
            80%,
            100% {
                -webkit-transform: scale(0)
            }

            40% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bouncedelay {

            0%,
            80%,
            100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            40% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
            }
        }

        .dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid var(--bs-danger);
            border-color: var(--bs-danger) transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .required:after {
            content: " *";
            color: var(--bs-danger);
        }

    </style>
</body>

</html>
