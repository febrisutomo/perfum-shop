@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-spa"></i>
                        Data Barand
                    </h3>
                    <a href="{{ route('admin.brand.create') }}" class="btn btn-sm btn-primary"><i
                            class="fas fa-plus-square mr-2"></i>Tambah Data</a>
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
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive table-striped">
                    <table id="tbCategory" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $brand->name }}</td>
                                    {{-- <td class="text-wrap">{{ $brand->description }}</td> --}}
                                    <td><span
                                            class="{{ $brand->is_active ? 'text-primary' : 'text-danger' }}">{{ $brand->is_active ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.brand.edit', $brand) }}" class="btn btn-sm btn-success mb-1" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        <form id="deleteItem" class="d-none"
                                            action="{{ route('admin.brand.destroy', $brand) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button onclick="if(confirm('Anda yakin ingin menghapus data ini?'))document.getElementById('deleteItem').submit()"
                                            class="btn btn-sm btn-danger mb-1" type="button" title="Hapus"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">
                                        Tidak ada data yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#tbCategory').dataTable();
    </script>
@endpush
