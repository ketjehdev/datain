<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CoreController extends Controller
{
    // tampilan dashboard
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'capel' => User::count(),
            'teknisi' => User::where('role', '=', 'teknisi')->get(),
            'page' => 'dash'
        ];
        return view('core.dashboard', $data);
    }

    public function vapel()
    {
        $data = [
            'title' => 'Calon Pelanggan',
            'page' => 'cp',
            'pelanggan' => Pelanggan::all(),
        ];
        return view('core.vapel', $data);
    }

    public function teknisiKaryawan()
    {
        $data = [
            'title' => 'Teknisi Karyawan',
            'page' => 'tk',
            'teknisi' => User::where('role', '=', 'teknisi')->get(),
        ];
        return view('core.teknisi', $data);
    }

    public function myProfil()
    {
        $data = [
            'title' => 'Edit Profil',
            'page' => 'ep',
        ];
        return view('core.edit_profil', $data);
    }

    public function updateProfil(Request $request)
    {
        if ($request->name == true) {
            if ($request->name != auth()->user()->name) {
                Auth::user()->update(['name' => $request->name]);
                return back()->with('sukses', 'Profil berhasil di update');
            }
        } else {
            throw ValidationException::withMessages([
                'name' => 'Nama tidak boleh kosong!'
            ])->redirectTo('/editProfil#form');
        }

        throw ValidationException::withMessages([
            'name' => 'Nama belum diubah!'
        ])->redirectTo('/editProfil#form');
    }

    public function gantiPassword()
    {
        $data = [
            'title' => 'Ganti Password',
            'page' => 'gp',
        ];
        return view('core.ganti_password', $data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:4', 'confirmed']
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {
            Auth::user()->update(['password' => Hash::make($request->password)]);
            return redirect(route('dashboard'))->with('sukses', 'Password berhasil diubah');
        }

        throw ValidationException::withMessages([
            'current_password' => 'Your password does not match with our record'
        ]);
    }
}
