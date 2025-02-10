@extends('layout.sidebar')

@section('content')
    <div class="container">
        <h1>Daftar Siswa</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Siswa</th>
                    <th>Nama Siswa</th>
                    {{-- <th>Jurusan</th> --}}
                    <th>Kelas</th>
                    <th>NIS</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $data)
                    <tr>
                        <td>{{ $data->siswa_id }}</td>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->kelas->nama_kelas . ' ' . $data->jurusan->nama_jurusan }}</td>
                        {{-- <td>{{ $data->kelas->nama_kelas ?? '-' }}</td> --}}
                        <td>{{ $data->nis }}</td>
                        <td>{{ $data->no_hp_siswa }}</td>
                        <td>
                            <a href="{{ route('siswa.edit', $data->siswa_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('siswa.destroy', $data->siswa_id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Tidak ada data siswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
