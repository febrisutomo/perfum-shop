@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous">

    <style>
        .gallery-carousel-wrapper .owl-carousel {
            position: relative;
            height: 100%;
        }

        .gallery-carousel {
            padding: 1rem 6rem;
        }

        .gallery-carousel-wrapper .owl-theme .owl-nav {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
        }

        .gallery-carousel-wrapper .owl-theme .owl-nav .owl-prev,
        .gallery-carousel-wrapper .owl-theme .owl-nav .owl-next {
            font-size: 1.5rem;
            position: absolute;
            color: var(--bs-primary);
            padding: 2px 8px !important;
            background: none;
            border: 1px solid var(--bs-primary);
            z-index: 100;
        }

        .gallery-carousel-wrapper .owl-theme .owl-nav .owl-prev:hover,
        .gallery-carousel-wrapper .owl-theme .owl-nav .owl-next:hover {
            background: #fff;
        }

        .gallery-carousel-wrapper .owl-theme .owl-nav .owl-prev {
            left: 0;
        }

        .gallery-carousel-wrapper .owl-theme .owl-nav .owl-next {
            right: 0;
        }

        .thumbnail-carousel .item {
            cursor: pointer;
            border-radius: 4px;
            border: 1.2px solid var(--bs-gray-500);
        }

        .thumbnail-carousel .synced .item {
            border: 1.2px solid var(--bs-primary)
        }


        .nav-tabs .nav-link {
            padding: 1.5rem 3rem;
            font-weight: 700;
        }

        .nav-tabs .nav-link.active {
            color: var(--bs-primary) !important;
        }

        .tab-content {
            padding: 3rem;
        }

        .product-name {
            font-size: 1.2rem;
        }

    </style>
@endpush

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-white py-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="gallery-carousel-wrapper mb-3">
                    <div class="owl-carousel gallery-carousel owl-theme">
                        @foreach ($product->images as $image)
                            <div class="item square-img-wrapper">
                                <img src="{{ asset('images/product/' . $image['path']) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="thumbnail-carousel-wrapper mb-3" {{ count($product->images) > 1 ? '' : 'hidden' }}>
                    <div class="owl-carousel thumbnail-carousel owl-theme">
                        @foreach ($product->images as $image)
                            <div class="item square-img-wrapper">
                                <img src="{{ asset('images/product/' . $image['path']) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
            <div class="col-lg-6">
                <div class="product-info">
                    <div class="product-brand fs-4 fw-bold text-uppercase">{{ $product->brand->name }}</div>

                    <div class="product-name mb-3">{{ $product->name }}</div>

                    <div class="product-price text-primary fs-4 fw-bold mb-3"> {{ rupiah($product->price) }} </div>

                    <p class="product-description mb-3">{{ $product->summary }}</p>

                    <form action="{{ route('cart.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $product->id }}">
                        <div class="mb-2">Kuantitas</div>
                        <div class="input-group mb-4">
                            <button type="button" class="btn btn-outline-secondary btn-number" disabled="disabled"
                                data-type="minus" data-field="qty">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="text" name="qty" name="qty" class="form-control input-number text-center" value="1"
                                min="1" max="{{ $product->stock }}" style="max-width: 4rem">
                            <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus"
                                data-field="qty">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>


                        <div class="d-flex">
                            <button class="btn btn-primary me-3" type="submit"><i class="bi bi-cart-plus me-2"></i>Tambah
                                Keranjang</button>
                            <button class="btn btn-outline-primary"><i class="bi bi-heart me-2"></i>Tambah Whislist</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>

        <div class="mb-4">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-uppercase" id="description-tab" data-bs-toggle="tab" href="#description"
                        role="tab" aria-controls="description" aria-selected="true">Deskripsi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-uppercase" id="ingredients-tab" data-bs-toggle="tab" href="#ingredients"
                        role="tab" aria-controls="ingredients" aria-selected="false">Bahan</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-uppercase" id="brand-tab" data-bs-toggle="tab" href="#brand" role="tab"
                        aria-controls="brand" aria-selected="false">Brand</a>
                </li>
            </ul>
            <div class="tab-content border-bottom border-start border-end rounded" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    {!! $product->description !!}
                </div>
                <div class="tab-pane fade" id="ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
                    {!! $product->ingredients !!}
                </div>
                <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                    <div class="text-uppercase font-weight-bold mb-3">{{ $product->brand->name }}</div>
                    {!! $product->brand->description !!}
                </div>
            </div>
        </div>

        <x-product-carousel name="Kamu Mungkin Juga Suka" :products="$relateds"></x-product-carousel>


    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.js"
        integrity="sha256-251s88HEsEfGL2RufZmRwGohKTHDYr9T+aJAazDwlGY=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            const sync1 = $(".gallery-carousel");
            const sync2 = $(".thumbnail-carousel");

            var thumbnailItemClass = '.owl-item';

            sync1.owlCarousel({
                items: 1,
                nav: true,
                dots: false,
                navText: [
                    '<i class="bi bi-chevron-left"></i>',
                    '<i class="bi bi-chevron-right"></i>'
                ],
            })

            sync1.on('changed.owl.carousel', syncPosition);

            function syncPosition(el) {
                $owl_slider = $(this).data('owl.carousel');
                var loop = $owl_slider.options.loop;

                if (loop) {
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);
                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }
                } else {
                    var current = el.item.index;
                }

                var owl_thumbnail = sync2.data('owl.carousel');
                var itemClass = "." + owl_thumbnail.options.itemClass;

                var thumbnailCurrentItem = sync2
                    .find(itemClass)
                    .removeClass("synced")
                    .eq(current);

                thumbnailCurrentItem.addClass('synced');

                if (!thumbnailCurrentItem.hasClass('active')) {
                    sync2.trigger('to.owl.carousel', current);
                }
            }

            sync2.owlCarousel({
                items: 4,
                loop: false,
                margin: 15,
                nav: false,
                dots: false,
                onInitialized: function(e) {
                    var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
                    thumbnailCurrentItem.addClass('synced');
                },
            });

            sync2.on('click', thumbnailItemClass, function(e) {
                e.preventDefault();
                var duration = 300;
                var itemIndex = $(e.target).parents(thumbnailItemClass).index();
                sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
            }).on("changed.owl.carousel", function(el) {
                var number = el.item.index;
                $owl_slider = sync1.data('owl.carousel');
                $owl_slider.to(number, 100, true);
            });

            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    $(this).val(1);
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    $(this).val(maxValue);
                }
            });

            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
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
    </script>
@endpush
