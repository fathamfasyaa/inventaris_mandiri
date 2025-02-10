<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tm_peminjaman';
    protected $primaryKey = 'pb_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pb_id',
        'pb_tgl',
        'pb_harus_kembali_tgl',
        'user_id',
        'siswa_id',
        'pb_stat',
    ];

    protected $with = ['peminjamanBarang', 'user', 'siswa'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }

    public function peminjamanBarang()
    {
        return $this->hasMany(PeminjamanBarang::class, 'pb_id', 'pb_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'pb_id', 'pb_id');
    }

    public function scopeWithPengembalianStatus($query)
    {
        return $query->withExists('pengembalian');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'pb_id', 'pb_id');
    }

    public function barang()
    {
        return $this->belongsTo(BarangInventaris::class, 'br_kode', 'br_kode');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->pb_id) {
                $model->pb_id = 'PJ-' . Str::uuid();
            }
        });
    }
}
