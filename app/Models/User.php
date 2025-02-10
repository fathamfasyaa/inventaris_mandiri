<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'tm_user';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function barangInventaris()
    {
        return $this->hasMany(barangInventaris::class, 'user_id', 'user_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'user_id', 'user_id');
    }

    public function pengembalian()
    {
        return $this->hasMany(pengembalian::class, 'user_id', 'user_id');
    }
}