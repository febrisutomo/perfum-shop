<div>
    <div class="card product-card border-0">
        <a class="square-img-wrapper" href="{{ route('product.single', $product) }}">
            <img src="{{ asset('images/product/' . $product->images[0]['path']) }}">
        </a>
        <div class="card-body">
            <div class="product-card-brand fw-bold text-uppercase">{{ $product->brand->name }}</div>
            <div class="product-card-name">{{ $product->name }}</div>
            <div class="product-card-price fw-bold text-primary">{{ rupiah($product->price) }}
            </div>
        </div>
    </div>
</div>

@push('style')
    <style>

        .product-card .product-card-brand {
            font-size: .8rem;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            line-height: 1rem;
            height: 1rem;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            margin-bottom: 4px;
        }

        .product-card .product-card-name {
            font-size: .8rem;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            line-height: 1rem;
            height: 2rem;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .product-card .card-body {
            padding: 12px;
        }

    </style>
@endpush
