<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['peminjamanBarang.barang'])->whereDoesntHave('pengembalian')->get();

        return view('pengembalian.index', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
        ]);

        // Ambil data peminjaman
        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // Cek apakah sudah dikembalikan
        if ($peminjaman->pengembalian) {
            return redirect()->back()->with('error', 'Barang ini sudah dikembalikan.');
        }

        // Simpan data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => now(),
        ]);

        return redirect()->route('pengembalian.index')->with('success', 'Barang berhasil dikembalikan.');
    }
}
