@extends('layout.sidebar')

@push('style')
<style>
    .btn-primary {
        background-color: #4e73df;
        border: none;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #375a7f;
        box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
    }
    .table-striped tbody tr:hover {
        background-color: #f8f9fc;
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    <h1>Jenis Barang</h1>
    <a href="{{ route('jenis_barang.create') }}" class="btn btn-primary mb-3">Tambah Jenis Barang</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisBarang as $barang)
                <tr>
                    <td>{{ $barang->jns_brg_kode }}</td>
                    <td>{{ $barang->jns_brg_nama }}</td>
                    <td>
                        <a href="{{ route('jenis_barang.edit', $barang->jns_brg_kode) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jenis_barang.destroy', $barang->jns_brg_kode) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus {{ $barang->jns_brg_nama }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
