<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    /**
     * Menampilkan Halaman Login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Memproses Autentikasi User
     */
    public function authenticate(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
        ]);

        try {
            // 2. Coba Login (Menggunakan username dan password)

            if (Auth::attempt($credentials)) {

                // 3. Regenerasi Session (Security best practice)
                $request->session()->regenerate();

                // 4. Ambil User yang login
                $user = Auth::user();

                // 5. Redirection Berdasarkan Role (Disesuaikan dengan Route Anda)
                switch ($user->role) {
                    case 1: // Admin
                        return redirect()->intended('/dashboard');

                    case 2: // Guru
                        return redirect()->intended('/teacher/monitoring');

                    case 3: // Instansi
                        return redirect()->intended('/company/monitoring');

                    case 4: // Siswa
                        return redirect()->intended('/student/submissions');

                    default:
                        Auth::logout();
                        return redirect()->route('login')->with('error', 'Role tidak dikenali.');
                }
            }

            // Jika Gagal Login
            return back()->with('error', 'Username atau password salah.')->withInput();
        } catch (Throwable $th) {
            // Menangani Error Sistem (Gagal Controller)
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $th->getMessage());
        }
    }

    /**
     * Proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}
