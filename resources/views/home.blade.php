@extends('layouts.app')

@push('style')
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.js"
        integrity="sha256-251s88HEsEfGL2RufZmRwGohKTHDYr9T+aJAazDwlGY=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous">

    <style>
        .banner-carousel-wrapper {
            position: relative;
            max-height: 75vh;
            margin-bottom: 4rem;
        }

        .banner-carousel-wrapper .owl-carousel {
            position: relative;
            height: 100%;
        }

        .banner-carousel-wrapper .owl-theme .owl-nav {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
        }

        .banner-carousel-wrapper .owl-theme .owl-dots {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
        }

        .banner-carousel-wrapper .owl-theme .owl-dots .owl-dot span {
            background: none;
            border: 1px solid var(--bs-primary)
        }

        .banner-carousel-wrapper .owl-theme .owl-dots .owl-dot.active span {
            background: var(--bs-primary);
            border: 1px solid var(--bs-primary)
        }

        .banner-carousel-wrapper .owl-theme .owl-nav .owl-prev,
        .banner-carousel-wrapper .owl-theme .owl-nav .owl-next {
            font-size: 1.5rem;
            position: absolute;
            color: var(--bs-primary);
            padding: 4px 12px !important;
            background: none;
            border: 1px solid var(--bs-primary);
            z-index: 100;
        }

        .banner-carousel-wrapper .owl-theme .owl-nav .owl-prev:hover,
        .banner-carousel-wrapper .owl-theme .owl-nav .owl-next:hover {
            background: #fff;
        }

        .banner-carousel-wrapper .owl-theme .owl-nav .owl-prev {
            left: 1rem;
        }

        .banner-carousel-wrapper .owl-theme .owl-nav .owl-next {
            right: 1rem;
        }

    </style>
@endpush

@section('content')
    <section class="banner-carousel-wrapper">
        <div class="owl-carousel banner-carousel owl-theme">
            <div class="item">
                <a href="#"><img src="{{ asset('images/banner/banner-1.webp') }}" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="{{ asset('images/banner/banner-2.webp') }}" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="{{ asset('images/banner/banner-3.webp') }}" alt=""></a>
            </div>
        </div>

    </section>

    <x-product-carousel name="New Arrival" :products="$new_arrival">
    </x-product-carousel>

    <br>
    <x-product-carousel name="Best Seller" :products="$best_seller">
    </x-product-carousel>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".banner-carousel").owlCarousel({
                nav: true,
                dots: true,
                loop: false,
                items: 1,
                navText: [
                    '<i class="bi bi-chevron-left"></i>',
                    '<i class="bi bi-chevron-right"></i>'
                ],
            });

        });
    </script>
@endpush
