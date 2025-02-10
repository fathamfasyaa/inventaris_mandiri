@extends('layout.sidebar')

@section('content')
<div class="container mt-5">
    <h1>Tambah Jenis Barang</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jenis_barang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jns_brg_nama" class="form-label">Nama Jenis Barang</label>
            <input type="text" id="jns_brg_nama" name="jns_brg_nama" class="form-control" value="{{ old('jns_brg_nama') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jenis_barang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
