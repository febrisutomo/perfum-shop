@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-dolly"></i>
                        Data Barang
                    </h3>
                    <a href="{{ route('admin.item.create') }}" class="btn btn-sm btn-primary"><i
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
                <div class="table-responsive table-striped">
                    <table id="tbItems" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Brand</th>
                                <th>Kategori</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    {{-- <td>IT-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td> --}}
                                    <td><img src="{{ asset('images/product/'.$item->images[0]['path'])}}" alt="" width="100px"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->brand->name }}</td>
                                    <td>
                                            <div class="badge bg-primary">
                                                {{ $item->category->name }}
                                            </div>
                                    </td>
                                    <td>{{ rupiah($item->price) }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td><span
                                            class="{{ $item->is_active ? 'text-primary' : 'text-danger' }}">{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.item.edit', $item) }}" class="btn btn-sm btn-success mb-1" title="Edit"><i
                                                class="fas fa-edit"></i></a>
                                        <form id="deleteItem" class="d-none"
                                            action="{{ route('admin.item.destroy', $item) }}" method="post">
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
        $('#tbItems').dataTable();
    </script>
@endpush
