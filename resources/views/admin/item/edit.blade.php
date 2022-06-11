@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-dolly"></i>
                        Ubah Data Barang
                    </h3>
                    <a href="{{ route('admin.item.index') }}" class="btn btn-sm btn-primary"><i
                            class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form id="formCreate" action="{{ route('admin.item.update', $item) }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="name">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama"
                                value="{{ old('name', $item->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="brand">Brand</label>
                        <div class="col-sm-10">
                            <select class="select2 @error('brand_id') is-invalid @enderror" data-placeholder="Pilih Brand"
                                name="brand_id" id="brand" style="width: 100%">
                                <option></option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id', $item->brand->id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="category">Kategori</label
                            class="col-sm-2 col-form-label">
                        <div class="col-sm-10">
                            <select class="select2 @error('category_id') is-invalid @enderror"
                                data-placeholder="Pilih Kategori" data-allow-clear="true" name="category_id" id="category"
                                style="width: 100%">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $item->categories) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="summary">Ringkasan</label
                            class="col-sm-2 col-form-label">
                        <div class="col-sm-10">
                            <textarea class="form-control @error('summary') is-invalid @enderror" name="summary" id="summary"
                                placeholder="Masukkan deskripsi" cols="30" rows="4"
                                required>{{ old('summary', $item->summary) }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="description">Deskripsi</label
                            class="col-sm-2 col-form-label">
                        <div class="col-sm-10">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                placeholder="Masukkan deskripsi" cols="30" rows="6"
                                required>{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="ingredients">Bahan</label
                            class="col-sm-2 col-form-label">
                        <div class="col-sm-10">
                            <textarea class="form-control @error('ingredients') is-invalid @enderror" name="ingredients" id="ingredients"
                                placeholder="Masukkan deskripsi" cols="30" rows="6"
                                required>{{ old('ingredients', $item->ingredients) }}</textarea>
                            @error('ingredients')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="costPrice">Harga Modal</label
                            class="col-sm-2 col-form-label">
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="cost_price" id="costPrice"
                                    class="form-control  @error('cost_price') is-invalid @enderror"
                                    placeholder="Masukkan harga modal" value="{{ old('cost_price', $item->cost_price) }}"
                                    required>
                            </div>
                            @error('cost_price')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="price">Harga Jual</label
                            class="col-sm-2 col-form-label">
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Masukkan harga jual" value="{{ old('price', $item->price) }}" required>
                            </div>
                            @error('price')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="stock">Stok</label>
                        <div class="col-sm-10">
                            <input type="number" name="stock" id="stock"
                                class="form-control @error('stock') is-invalid @enderror" placeholder="Masukkan stok"
                                value="{{ old('stock', $item->stock) }}" required>
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="isActive">Status</label>
                        <div class="col-sm-10">
                            <select class="select2" name="is_active" id="isActive" data-placeholder="Pilih Status"
                                style="width: 100%">
                                <option value="1" {{ old('is_active', $item->is_active) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('is_active', $item->is_active) == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('is_active')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Foto Produk</label>
                        <div class="col-sm-10">

                            <div class="img-box-wrapper d-flex flex-wrap mb-1" data-index="{{ count($item->images) }}">
                                @foreach ($item->images as $image)
                                    <div class="img-box mr-2 mb-2">
                                        <input type="hidden" name="images[{{ $loop->index }}][uuid]"
                                            value="{{ $image['uuid'] }}">
                                        <input name="images[{{ $loop->index }}][path]" type="file"
                                            class="input-image d-none" accept="image/*" hidden>
                                        <div class="btn-add" hidden>
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="btn-remove">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <img class="img-preview"
                                            src="{{ asset('images/product/' . $image['path']) }}">
                                    </div>
                                @endforeach

                            </div>
                            <small class="d-block text-muted"> *Ukuran foto maksimal 2MB. Ekstensi yang
                                diperbolehkan jpg/jpeg/png.</small>
                            @foreach ($errors->all() as $error)
                                @if (strpos($error, 'images') !== false)
                                    <small class="text-danger"> {{ $error }}</small>
                                @endif
                            @endforeach

                        </div>
                    </div>

                </form>

            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="reset" class="btn btn-secondary mr-2"
                    onclick="document.getElementById('formCreate').reset()">Reset</button>
                <button name="submit" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .img-box {
            position: relative;
            width: 200px;
            height: 200px;
            border: 1px dashed gray;
            border-radius: .5rem;
            overflow: hidden;
        }

        .btn-remove {
            display: flex;
            position: absolute;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #000000;
            opacity: .5;
            color: #fff;
            right: 6px;
            top: 6px;
            cursor: pointer;
            justify-content: center;
            align-items: center;
        }

        .btn-remove:hover {
            background-color: #940000;
        }

        .btn-add {
            position: absolute;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #000000;
            opacity: .5;
            color: #fff;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-add:hover {
            background-color: #007bff;
            opacity: 1;
        }

        .btn-add i {
            font-size: 1.5rem;
        }

        .img-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

    </style>
@endpush

@push('script')
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })

        CKEDITOR.replace('description');
        CKEDITOR.replace('ingredients');

        function generateUUID() {
            let d = new Date().getTime();
            let uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                let r = (d + Math.random() * 16) % 16 | 0;
                d = Math.floor(d / 16);
                return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
            return uuid;
        };

        const max = 4;
        let index = $('.img-box-wrapper').data('index');

        let id = index;
        const renderImage = () => {
            const uuid = generateUUID();
            const img = ` <div class="img-box mr-2 mb-2">
                                <input type="hidden" name="images[${id}][uuid]" value="${uuid}">
                                <input name="images[${id}][path]"  type="file" class="input-image d-none"
                                        accept="image/*" class="d-none">
                                    <div class="btn-add">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                   
                                    <div class="btn-remove" hidden>
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <img class="img-preview" src="" hidden>
                                </div>`
            $('.img-box-wrapper').append(img);
            id++;
        }

        if (index < 4) {
            renderImage()
        }

        $('.img-box-wrapper').on('change', '.input-image', (e) => {
            const input = $(e.target);
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    input.siblings('.img-preview').attr('src', e.target.result);
                    input.siblings('.img-preview').attr('hidden', false);
                };
                reader.readAsDataURL(e.target.files[0]);

                input.siblings('.btn-remove').attr('hidden', false);
                input.siblings('.btn-add').attr('hidden', true);

                index++;
                if (index < max) {
                    renderImage()
                }
                console.log(index);
            }

        })

        $('.img-box-wrapper').on('click', '.btn-add', function() {
            $(this).siblings('.input-image').click()
        })

        $('.img-box-wrapper').on('click', '.btn-remove', function() {
            $(this).parent('.img-box').remove()
            if (index == max) {
                renderImage()
            }
            index--
        });

        $('button[name=submit]').on('click', () => {
            if (index < 4) {
                $('.img-box-wrapper .img-box').last().remove();
            }
            $('#formCreate').submit();
        })
    </script>
@endpush
