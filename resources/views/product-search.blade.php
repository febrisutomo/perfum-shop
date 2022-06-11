@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-white py-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hasil pencarian untuk: '{{ Request::query('search') }}'</li>
            </ol>
        </div>
    </nav>

    <div class="container mb-4">

        <div class="row">
            <div class="col-lg-2">
                <form id="filter" action="{{ route('product.search') }}" method="get">
                    <input type="hidden" name="search" value="{{ Request::query('search') }}">
                    <p class="fw-bold text-uppercase">Kategori</p>
                    @foreach ($categories as $category)
                        <div class="text-uppercase d-flex align-items-center mb-2 position-relative">
                            <input class="position-absolute" type="radio" name="category"
                                id="category{{ $category->id }}" value="{{ $category->slug }}"
                                @checked(Request::query('category') == $category->slug) hidden>
                            <label class="filter-label @if (Request::query('category') == $category->slug) text-primary @endif"
                                 style="cursor: pointer;">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    <br>
                    <p class="fw-bold text-uppercase">Brand</p>
                    @foreach ($brands as $brand)
                        <div class="text-uppercase d-flex align-items-center mb-2 position-relative">
                            <input class="position-absolute" type="radio" name="brand" id="brand{{ $brand->id }}"
                                value="{{ $brand->slug }}" @checked(Request::query('brand') == $brand->slug) hidden>
                            <label class="filter-label @if (Request::query('brand') == $brand->slug) text-primary @endif"
                                 style="cursor: pointer;">
                                {{ $brand->name }}
                            </label>
                        </div>
                    @endforeach
                </form>

            </div>
            <div class="col-lg-10 row g-4">
                @forelse ($products as $product)
                    <div class="col-6 col-md-3">
                        <x-product-card :product="$product"></x-product-card>
                    </div>
                @empty
                    <div class="p-4 text-center">
                        <p class="fs-4 fw-bold">Tidak ada data yang ditemukan!</p>
                    </div>
                @endforelse
                <div class="d-flex justify-content-end mt-3 border-top p-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>



    </div>
@endsection

@push('script')
    <script>
        const form = document.getElementById('filter')
        form.addEventListener('change', (e) => {
            e.currentTarget.submit()
        })

        const inputRadio = document.querySelectorAll('input[type="radio"]')
        const filterLabel = document.querySelectorAll('.filter-label')

        filterLabel.forEach(element => {
            element.addEventListener('click', (e) => {
                e.currentTarget.previousElementSibling.checked = !e.currentTarget.previousElementSibling.checked
                form.dispatchEvent(new Event('change'))
            })
        });
    </script>
@endpush
