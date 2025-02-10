<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jenis_barang extends Controller
{
    public function index(){
        return view ('referensi.jbarang');
    }
}
