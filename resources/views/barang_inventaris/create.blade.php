@extends('layout.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Barang Inventaris</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang_inventaris.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="jns_brg_kode" class="form-label">Jenis Barang</label>
            <select name="jns_brg_kode" class="form-control" required>
                <option value="">Pilih Jenis Barang</option>
                @foreach($jenisBarang as $jenis)
                    <option value="{{ $jenis->jns_brg_kode }}">{{ $jenis->jns_brg_nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="br_nama" class="form-label">Nama Barang</label>
            <input type="text" name="br_nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="br_tgl_terima" class="form-label">Tanggal Terima</label>
            <input type="date" name="br_tgl_terima" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="br_status" class="form-label">Status</label>
            <select name="br_status" class="form-control" required>
                <option value="1">Baik</option>
                <option value="0">Rusak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('barang_inventaris.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
