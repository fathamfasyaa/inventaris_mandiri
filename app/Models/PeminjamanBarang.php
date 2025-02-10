<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;

    protected $table = 'td_peminjaman_barang';
    protected $primaryKey = 'pbd_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pbd_id',
        'pb_id',
        'br_kode',
        'pdb_tgl',
        'pdb_sts',
        'siswa_id',
    ];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'pb_id', 'pb_id');
    }

    // Relasi ke BarangInventaris (ubah dari barangInventaris ke barang)
    public function barang()
    {
        return $this->belongsTo(BarangInventaris::class, 'br_kode', 'br_kode');
    }

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }
}
