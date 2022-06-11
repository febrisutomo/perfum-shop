<div>
    <div class="container {{ $var }} mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>{{ $name }}</h1>
            <div>
                <button class="btn btn-outline-primary {{$var}}-prev"><i class="bi bi-chevron-left"></i></button>
                <button class="btn btn-outline-primary {{$var}}-next"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

        <section class="{{ $var }}-carousel-wrapper">
            <div class="owl-carousel {{ $var }}-carousel owl-theme mb-3">
                @foreach ($products as $p)
                    <div class="item">
                        <x-product-card :product="$p">
                        </x-product-card>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('product.all')}}" class="btn btn-outline-primary">Lihat Produk</a>
            </div>
        </section>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            
            let {{ $var }} = $(".{{ $var }}-carousel");
            {{ $var }}.owlCarousel({
                nav: false,
                dots: false,
                margin: 10,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });

            $(".{{ $var }}-next").on('click', function() {
                {{ $var }}.trigger('next.owl.carousel');
            });

            $(".{{ $var }}-prev").on('click', function() {
                {{ $var }}.trigger('prev.owl.carousel');
            });
        })
    </script>
@endpush
