<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika otentikasi berhasil, periksa status pengguna
            $user = Auth::user();
            if ($user->status == 1) {
                // Set session jika status pengguna adalah 1
                $request->session()->regenerate();

                // Tentukan role_id pengguna sesuai kebutuhan aplikasi Anda
                $roleId = $user->role_id;

                // Set session role_id
                $request->session()->put('role_id', $roleId);

                return redirect()->intended('/');
            } else {
                // Jika status pengguna bukan 1, logout dan kembalikan ke halaman login dengan pesan error
                Auth::logout();
                return back()->withErrors(['status' => 'Akun Anda tidak aktif.'])->withInput($request->only('email'));
            }
        }

        // Jika otentikasi gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus semua data sesi yang ada
        $request->session()->invalidate();

        // Mungkin Anda juga ingin menghapus sesi yang spesifik, seperti role_id
        $request->session()->forget('role_id');

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
