@extends('layout.sidebar')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center">Form Tambah Peminjaman</h2>

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="pb_tgl" class="form-label fw-bold">Tanggal Pinjam:</label>
                <input type="date" class="form-control" name="pb_tgl" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="pb_harus_kembali_tgl" class="form-label fw-bold">Tanggal Harus Kembali:</label>
                <input type="date" class="form-control" name="pb_harus_kembali_tgl" required>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Nama Siswa dengan Select2 -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="siswa_id" class="form-label fw-bold">Nama Siswa:</label>
                <select class="form-select form-control select2" name="siswa_id" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->siswa_id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Pilih Barang dengan Checkbox -->
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Barang:</label>
                <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                    @foreach ($barang as $b)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="barang[]" value="{{ $b->br_kode }}"
                                id="barang{{ $b->br_kode }}">
                            <label class="form-check-label" for="barang{{ $b->br_kode }}">
                                {{ $b->br_nama }} ({{ $b->jenis_barang->jns_brg_nama }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
                 <div class="col-md-7">
                <div class="mb-3">
                    <label for="pb_stat" class="form-label fw-bold">Status:</label>
                    <select class="form-control" name="pb_stat" required>
                        <option value="1">Aktif</option>
                        <option value="0">Dihapus</option>
                    </select>
                </div>
                 </div> 

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tambahkan jQuery dan Select2 -->
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Pilih Siswa",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection
