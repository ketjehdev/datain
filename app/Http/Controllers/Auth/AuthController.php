<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // tampilan login
    public function login()
    {
        $data = [
            'title' => 'Sistem Informasi Pendataan Pelanggan Baru Indihome',
            'page' => 'login',
        ];

        return view('auth.login', $data);
    }

    // login handle
    public function login_handle(Request $request)
    {
        $credentials = $this->validate(
            $request,
            [
                'nip' => ['required', 'numeric'],
                'password' => 'required',
            ],
            [
                'nip.required' => 'Kolom NIP tidak boleh kosong!',
                'nip.numeric' => 'Inputan harus berupa angka',
                'password.required' => 'Kolom password tidak boleh kosong!',
            ],
        );

        $remember_token = $request->input('remember');

        if (Auth::attempt($credentials, $remember_token)) {

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->with('gagal', 'Maaf, akun tidak ditemukan!');
    }

    // tampilan register
    public function register()
    {
        $data = [
            'title' => 'Daftarkan Diri Bersama Datain',
            'page' => 'register',
        ];

        return view('auth.register', $data);
    }

    // logout handle
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}