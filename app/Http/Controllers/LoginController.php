<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi data yang dimasukkan oleh pengguna
        $credentials = $request->only('email', 'password');

        // Memvalidasi input pengguna
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Jika login berhasil
        if (Auth::attempt($credentials)) {
            // Redirect ke halaman pasien setelah login
            return redirect("/patients");
        } else {
            // Jika login gagal, kirimkan error dan kembali ke halaman login
            return back()->with('error', 'Email atau Password salah.');
        }
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();  // Menglogout pengguna
        return redirect()->route('login');  // Mengarahkan ke halaman login setelah logout
    }
}
