<?php
namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function jnsindex()
    {
        $jenisBarang = JenisBarang::all();
        return view('referensi.jbarang', compact('jenisBarang'));
    }

    private function jnsgenerateKode()
    {
        $lastBarang = JenisBarang::orderBy('jns_brg_kode', 'desc')->first();

        if (!$lastBarang) {
            return 'JNS01';
        }

        $lastKode = intval(substr($lastBarang->jns_brg_kode, 3));
        $newKode = 'JNS' . str_pad($lastKode + 1, 2, '0', STR_PAD_LEFT);
        return $newKode;
    }

    public function jnscreate()
    {
        return view('referensi.jbarangcreate');
    } 

    public function jnsstore(Request $request)
    {
        $request->validate([
            'jns_brg_nama' => 'required|string|max:255|unique:tr_jenis_barang,jns_brg_nama',
        ]);

        JenisBarang::create([
            'jns_brg_kode' => $this->jnsgenerateKode(),
            'jns_brg_nama' => $request->jns_brg_nama,
        ]);

        return redirect()->route('jenis_barang.index')->with('success', 'Jenis barang berhasil ditambahkan.');
    }

    public function jnsedit($jns_brg_kode)
    {
        $barang = JenisBarang::findOrFail($jns_brg_kode);
        return view('referensi.jbarangedit', compact('barang'));
    }

    public function jnsupdate(Request $request, $jns_brg_kode)
    {
        $request->validate([
            'jns_brg_nama' => 'required|string|max:255|unique:tr_jenis_barang,jns_brg_nama,' . $jns_brg_kode . ',jns_brg_kode'
        ]);

        $barang = JenisBarang::findOrFail($jns_brg_kode);
        $barang->update([
            'jns_brg_nama' => $request->jns_brg_nama,
        ]);

        return redirect()->route('jenis_barang.index')->with('success', 'Jenis barang berhasil diperbarui.');
    }

    public function jnsdestroy($jns_brg_kode)
    {
        $barang = JenisBarang::findOrFail($jns_brg_kode);
        $barang->delete();

        return redirect()->route('jenis_barang.index')->with('success', 'Jenis barang berhasil dihapus.');
    }
}
