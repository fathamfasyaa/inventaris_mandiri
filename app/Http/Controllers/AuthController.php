<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_nama' => 'required', // Sesuaikan dengan field ID pengguna di form
            'user_pass' => 'required', // Sesuaikan dengan field password di form
        ]);

        // Ambil kredensial dari input request
        $credentials = $request->only('user_nama', 'user_pass');

        // Cari pengguna berdasarkan ID
        $user = User::where('user_nama', $credentials['user_nama'])->first();

        if ($user && Hash::check($credentials['user_pass'], $user->user_pass)) {
            // Jika validasi berhasil, autentikasi pengguna
            Auth::login($user);
            // dd(Auth::user());

            // Redirect ke halaman home atau dashboard
            return redirect('home')->with('success', 'Login berhasil!');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors(['user_nama' => 'ID pengguna atau password salah.']);
    }

    /**
     * Logout pengguna.
     */
    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman login
        return redirect('/login')->with('success', 'Logout berhasil.');
    }
}
