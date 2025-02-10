<!-- resources/views/peminjaman/index.blade.php -->
@extends('layout.sidebar')

@section('content')
    <h2>Data Peminjaman</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a class="btn btn-primary mb-3" href="{{ route('peminjaman.create') }}">Tambah Peminjaman</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID Peminjaman</th>
                <th>Nama Barang</th>
                <th>Siswa peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $pinjam)
                <tr>
                    <td>{{ $pinjam->pb_id }}</td>
                    <td>
                        @foreach ($pinjam->peminjamanBarang as $barang)
                            {{ $barang->barang->br_nama }} <br>
                        @endforeach
                    </td>
                    <td>
                        {{ $pinjam->siswa->nama_siswa ?? 'Tidak ada siswa' }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->pb_tgl)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->pb_harus_kembali_tgl)->format('Y-m-d') }}</td>
                    <td>{{ $pinjam->pb_stat == 1 ? 'Dipinjam' : 'Dikembalikan' }}</td>
                </tr>
            @endforeach
        </tbody>


    </table>
@endsection
