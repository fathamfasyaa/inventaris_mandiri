@extends('layout.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Barang</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Tanggal Terima</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangInventaris as $barang)
            <tr>
                <td>{{ $barang->br_kode }}</td>
                <td>{{ $barang->br_nama }}</td>
                <td>{{ $barang->jenis_barang->jns_brg_nama }}</td>
                <td>{{ $barang->br_tgl_terima }}</td>
                <td>
                    <span class="badge {{ $barang->br_status == 1 ? 'bg-success' : 'bg-danger' }} fw-bold text-white">
                        {{ $barang->br_status == 1 ? 'Baik' : 'Rusak' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('barang_inventaris.edit', $barang->br_kode) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang_inventaris.destroy', $barang->br_kode) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
