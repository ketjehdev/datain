<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CoreController extends Controller
{
    // tampilan dashboard
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'total_user' => User::count(),
            'users' => User::all(),
            'page' => 'dash'
        ];
        return view('core.dashboard', $data);
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
}
