<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\PaketIndihome;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    public function capel()
    {
        $data = [
            'title' => 'Calon Pelanggan',
            'page' => 'cp',
            'pelanggan' => Pelanggan::all(),
        ];
        return view('core.capel', $data);
    }

    public function inpel()
    {
        $data = [
            'title' => 'Input Pelanggan',
            'page' => 'ip',
            'paket' => PaketIndihome::all(),
        ];

        return view('core.inpel', $data);
    }

    public function pain()
    {

        $data = [
            'title' => 'Paket Indihome',
            'page' => 'pi',
            'paket' => PaketIndihome::all(),
        ];
        return view('core.pain', $data);
    }

    public function tambahPaket(Request $request)
    {

        $paket = new PaketIndihome();

        if ($request == true && $request->harga_bulanan != 'Rp.') {
            $paket->nama_paket = $request->nama_paket;

            if ($request->harga_bulanan == "Rp.") {
                $paket->harga_bulanan = 0;
            } else {
                $paket->harga_bulanan = str_replace(array('Rp.', '.'), array('', ''), $request->harga_bulanan);
            }

            $paket->save();

            return back()->with('sukses', 'Paket berhasil ditambahkan');
        }

        return back()->with('gagal', 'Inputan tidak boleh kosong!');
    }

    public function deletePaket($id)
    {
        $data = PaketIndihome::find($id);
        $data->delete();

        return back()->with('warning', 'Perhatian! satu paket dihapus!');
    }

    public function updatePaket(Request $request, $id)
    {
        $paket = PaketIndihome::find($id);

        if ($request == true) {
            if ($paket->nama_paket != $request->nama_paket && $paket->harga_bulanan != $request->harga_bulanan) {
                $paket->nama_paket = $request->nama_paket;
                if ($request->harga_bulanan == "Rp.") {
                    $paket->harga_bulanan = 0;
                } else {
                    $paket->harga_bulanan = str_replace(array('Rp.', '.'), array('', ''), $request->harga_bulanan);
                }

                $paket->save();

                return back()->with('sukses', 'Satu paket berhasil diupdate');
            } else {
                return back()->with('info', 'Tidak data yang di update! Data masih seperti semula');
            }
        }
        return back()->with('gagal', 'Inputan tidak boleh kosong!');
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

    public function tambahTeknisi(Request $request)
    {
        $paket = new User();
        $nip = User::where('nip', '=', $request->nip)->first();

        if ($request->name == true && $request->nip == true && $request->gambar == true && $request->cp == true && $request->alamat == true) {
            if ($nip === null) {
                $paket->name = $request->name;
                $paket->nip = $request->nip;
                $paket->password = Hash::make($request->nip);
                $paket->role = 'teknisi';

                if ($request->gambar == true) {
                    $request->file('gambar')->move('img/pp/', $request->file('gambar')->getClientOriginalName());
                    $paket->gambar = $request->file('gambar')->getClientOriginalName();
                }

                $paket->cp = $request->cp;
                $paket->alamat = $request->alamat;

                $paket->save();

                return back()->with('sukses', 'Teknisi berhasil ditambahkan!');
            } else {
                return back()->with('gagal', 'NIP sudah digunakan sebelumnya!');
            }
        }

        return back()->with('gagal', 'Inputan tidak boleh kosong!');
    }

    public function hapusTeknisi($id)
    {
        $paket = User::find($id);

        $paket->delete();

        return back()->with('warning', 'Satu teknisi dihapus!');
    }

    public function updateTeknisi()
    {
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
