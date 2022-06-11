@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-spa"></i>
                        Tambah Data Brand
                    </h3>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary"><i
                            class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form id="formCreate" action="{{ route('admin.category.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="name">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama"
                                value="{{ old('name') }}" required>
                            @error('name')
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
                                required>{{ old('description')}}</textarea>
                            @error('description')
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
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('is_active')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    

                </form>

            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="reset" class="btn btn-secondary mr-2"
                    onclick="document.getElementById('formCreate').reset()">Reset</button>
                <button name="submit" type="submit" class="btn btn-primary" onclick="document.getElementById('formCreate').submit()">Simpan</button>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush
