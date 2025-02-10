<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with(['jurusan', 'kelas'])->get();
        return view('referensi.siswa.index', compact('siswa'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('referensi.siswa.create', compact('jurusan', 'kelas'));
    }

    public function store(Request $request)
{
    // Validasi tanpa mengharuskan input siswa_id
    $request->validate([
        'nama_siswa'  => 'required|string',
        'jurusan_id'  => 'required|exists:jurusan,id',
        'kelas_id'    => 'required|exists:kelas,id',
        'nis'         => 'required|string|unique:siswa,nis',
        'no_hp_siswa' => 'required|string',
    ]);

    // Generate siswa_id baru secara otomatis
    $latestSiswa = Siswa::orderBy('siswa_id', 'desc')->first();
    if ($latestSiswa) {
        // Ambil angka dari siswa_id (misalnya dari 'SIS01', ambil '01')
        $lastNumber = (int) substr($latestSiswa->siswa_id, 3);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }
    // Format siswa_id dengan prefix "SIS" dan padding angka hingga dua digit
    $newSiswaId = 'SIS' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);

    // Gabungkan data request dengan siswa_id yang baru
    $data = $request->all();
    $data['siswa_id'] = $newSiswaId;

    Siswa::create($data);

    return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
}


    public function edit(Siswa $siswa)
    {
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('referensi.siswa.edit', compact('siswa', 'jurusan', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama_siswa' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id',
            'kelas_id' => 'required|exists:kelas,id',
            'nis' => 'required|string|exists:siswa,nis',
            'no_hp_siswa' => 'required|string',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }
}
