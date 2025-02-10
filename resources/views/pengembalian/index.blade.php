@extends('layout.sidebar')

@section('content')
    <div class="container">
        <h2>Pengembalian Barang</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @php
                                $barangNama = 'Barang tidak ditemukan';
                                if ($item->peminjamanBarang->isNotEmpty()) {
                                    $barang = $item->peminjamanBarang->first()->barang;
                                    if ($barang) {
                                        $barangNama = $barang->br_nama;
                                    }
                                }
                            @endphp
                            {{ $barangNama }}
                        </td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>
                            <form action="{{ route('pengembalian.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="peminjaman_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
