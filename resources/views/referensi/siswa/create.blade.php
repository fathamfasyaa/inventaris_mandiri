@extends('layout.sidebar')

@section('content')
<div class="container">
    <h1>Tambah Siswa</h1>

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf

        <!-- Field siswa_id dihilangkan karena akan digenerate otomatis -->

        <div class="form-group">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa') }}">
            @error('nama_siswa')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="jurusan_id">Jurusan</label>
            <select name="jurusan_id" class="form-control">
                <option value="">Pilih Jurusan</option>
                @foreach($jurusan as $j)
                    <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
            @error('jurusan_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" class="form-control">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" name="nis" class="form-control" value="{{ old('nis') }}">
            @error('nis')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="no_hp_siswa">No HP Siswa</label>
            <input type="text" name="no_hp_siswa" class="form-control" value="{{ old('no_hp_siswa') }}">
            @error('no_hp_siswa')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection
