@extends('layout.sidebar')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Barang Inventaris</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang_inventaris.update', $barang->br_kode) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="jns_brg_kode" class="form-label">Jenis Barang</label>
                <select name="jns_brg_kode" class="form-control" required>
                    @foreach ($jenisBarang as $jenis)
                        <option value="{{ $jenis->jns_brg_kode }}"
                            {{ $barang->jns_brg_kode == $jenis->jns_brg_kode ? 'selected' : '' }}>
                            {{ $jenis->jns_brg_nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="br_nama" class="form-label">Nama Barang</label>
                <input type="text" name="br_nama" class="form-control" value="{{ $barang->br_nama }}" required>
            </div>

            <div class="mb-3">
                <label for="br_tgl_terima" class="form-label">Tanggal Terima</label>
                <input type="date" name="br_tgl_terima" class="form-control" value="{{ $barang->br_tgl_terima }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="br_status" class="form-label">Status</label>
                <select name="br_status" class="form-control" required>
                    <option value="1" {{ $barang->br_status == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="0" {{ $barang->br_status == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('barang_inventaris.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
