<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\Auth;

class BarangInventarisController extends Controller
{
    public function index()
    {
        $barangInventaris = BarangInventaris::with('jenis_barang')->get();
        return view('barang_inventaris.index', compact('barangInventaris'));
    }

    public function create()
    {
        $jenisBarang = JenisBarang::all();
        return view('barang_inventaris.create', compact('jenisBarang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jns_brg_kode' => 'required',
            'br_nama' => 'required',
            'br_tgl_terima' => 'required|date',
            'br_status' => 'required',
        ]);

        $lastBarang = BarangInventaris::latest('br_kode')->first();
        $nextKode = $lastBarang ? 'BRG' . str_pad((int)substr($lastBarang->br_kode, 3) + 1, 3, '0', STR_PAD_LEFT) : 'BRG001';

        // dd(Auth::check());

        BarangInventaris::create([
            'br_kode' => $nextKode,
            'jns_brg_kode' => $request->jns_brg_kode,
            'user_id' => Auth::user()->user_id,
            'br_nama' => $request->br_nama,
            'br_tgl_terima' => $request->br_tgl_terima,
            'br_tgl_entry' => now(),
            'br_status' => $request->br_status,
        ]);

        return redirect()->route('barang_inventaris.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = BarangInventaris::findOrFail($id);
        $jenisBarang = JenisBarang::all();
        return view('barang_inventaris.edit', compact('barang', 'jenisBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jns_brg_kode' => 'required',
            'br_nama' => 'required',
            'br_tgl_terima' => 'required|date',
            'br_status' => 'required',
        ]);

        $barang = BarangInventaris::findOrFail($id);
        $barang->update([
            'jns_brg_kode' => $request->jns_brg_kode,
            'br_nama' => $request->br_nama,
            'br_tgl_terima' => $request->br_tgl_terima,
            'br_status' => $request->br_status,
        ]);

        return redirect()->route('barang_inventaris.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        BarangInventaris::findOrFail($id)->delete();
        return redirect()->route('barang_inventaris.index')->with('success', 'Barang berhasil dihapus!');
    }
}
