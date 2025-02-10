<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use App\Models\Siswa;
use App\Models\BarangInventaris;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('siswa')->orderBy('pb_tgl', 'desc')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Tampilkan form tambah peminjaman
     */
    public function create()
    {
        $siswa = Siswa::all(); // Mengambil semua data siswa
        $barang = BarangInventaris::with('jenis_barang')->get(); // Mengambil data barang dengan relasi jenis barang

        return view('peminjaman.create', compact('siswa', 'barang'));
    }

    /**
     * Simpan data peminjaman
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pb_tgl' => 'required|date',
            'pb_harus_kembali_tgl' => 'required|date',
            'siswa_id' => 'required|exists:siswa,siswa_id',
            'pb_stat' => 'required|in:0,1',
            'barang' => 'required|array',
            'barang.*' => 'exists:tm_barang_inventaris,br_kode',
        ]);

        // Buat pb_id yang unik untuk menghindari duplikasi
        do {
            $lastId = Peminjaman::whereYear('pb_tgl', now()->year)
                ->whereMonth('pb_tgl', now()->month)
                ->count() + 1;
            $pb_id = 'PJ' . now()->format('Ym') . str_pad($lastId, 3, '0', STR_PAD_LEFT);
        } while (Peminjaman::where('pb_id', $pb_id)->exists());

        // Simpan data peminjaman
        $peminjaman = Peminjaman::create([
            'pb_id' => $pb_id,
            'pb_tgl' => $validated['pb_tgl'],
            'pb_harus_kembali_tgl' => $validated['pb_harus_kembali_tgl'],
            'user_id' => Auth::user()->user_id,
            'siswa_id' => $validated['siswa_id'],
            'pb_stat' => $validated['pb_stat'],
        ]);

        // Simpan barang yang dipinjam
        foreach ($validated['barang'] as $barangKode) {
            $pbd_id = $pb_id . str_pad(PeminjamanBarang::count() + 1, 3, '0', STR_PAD_LEFT);

            PeminjamanBarang::create([
                'pbd_id' => $pbd_id,
                'pb_id' => $peminjaman->pb_id,
                'br_kode' => $barangKode,
                'pdb_tgl' => now(),
                'pdb_sts' => 1,
                'siswa_id' => $validated['siswa_id'],
            ]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Tampilkan detail peminjaman
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with('barang')->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Tampilkan form edit peminjaman
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $siswa = Siswa::all();
        $barang = BarangInventaris::with('jenis_barang')->get();

        return view('peminjaman.edit', compact('peminjaman', 'siswa', 'barang'));
    }

    /**
     * Update data peminjaman
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pb_harus_kembali_tgl' => 'required|date',
            'pb_stat' => 'required|in:0,1',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'pb_harus_kembali_tgl' => $validated['pb_harus_kembali_tgl'],
            'pb_stat' => $validated['pb_stat'],
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui');
    }

    /**
     * Hapus data peminjaman
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus');
    }
}
