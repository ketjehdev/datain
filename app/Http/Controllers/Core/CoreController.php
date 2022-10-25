<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\PaketIndihome;
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
            'page' => 'dash',
            'capel' => User::count(),
            'pelak' => Pelanggan::where('myir', '!=', null)->where('myir', '!=', 'ditolak')->count(),
            'teknisi' => User::where('role', '=', 'teknisi')->get(),
            'paket' => PaketIndihome::all(),
            'pelanggan' => Pelanggan::all(),
        ];
        return view('core.dashboard', $data);
    }

    public function capel()
    {
        $data = [
            'title' => 'Calon Pelanggan',
            'page' => 'cp',
            'pelanggan' => Pelanggan::all(),
            'paket' => PaketIndihome::all(),
        ];
        return view('core.capel', $data);
    }

    public function inpel()
    {
        $pelanggan = Pelanggan::count() + 1;
        $data = [
            'title' => 'Input Pelanggan',
            'page' => 'ip',
            'paket' => PaketIndihome::all(),
            'pelanggan' => Pelanggan::all(),
            'kode_pelanggan' => 'DA' . 0 . $pelanggan,
        ];

        return view('core.inpel', $data);
    }

    public function tambahPelanggan(Request $request)
    {
        $this->validate(
            $request,
            [
                'kode_pelanggan' => ['required'],
                'nama' => ['required'],
                'paket_indihome' => ['required'],
                'alamat' => ['required'],
                'cp_pelanggan' => ['required', 'numeric'],
                'foto_selfie' => ['required', 'max:500000'],
                'foto_ktp' => ['required', 'max:500000'],
                'foto_rumah' => ['required', 'max:500000'],
                'keterangan_wo' => ['required'],
            ],
            [
                'kode_pelanggan.required' => 'Kode Pelanggan tidak boleh kosong',
                'nama.required' => 'Nama tidak boleh kosong',
                'paket_indihome.pelanggan' => 'Paket indihome tidak boleh kosong',
                'alamat.pelanggan' => 'Alamat tidak boleh kosong',
                'cp_pelanggan.pelanggan' => 'Kolom kontak pelanggan tidak boleh kosong',
                'foto_selfie.pelanggan' => 'Foto selfie tidak boleh kosong',
                'foto_ktp.pelanggan' => 'Foto KTP tidak boleh kosong',
                'foto_rumah.pelanggan' => 'Foto rumah pelanggan tidak boleh kosong',
                'keterangan_wo.pelanggan' => 'Keterangan WO pelanggan tidak boleh kosong',
            ]
        );

        $pelanggan = new Pelanggan();

        $pelanggan->kode_pelanggan = $request->kode_pelanggan;
        $pelanggan->nama = $request->nama;
        $pelanggan->paket_indihome = $request->paket_indihome;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->cp_pelanggan = $request->cp_pelanggan;

        if ($request->hasFile('foto_selfie')) {
            $request->file('foto_selfie')->move('img/pp/', $request->file('foto_selfie')->getClientOriginalName());
            $pelanggan->foto_selfie = $request->file('foto_selfie')->getClientOriginalName();
        }

        if ($request->hasFile('foto_ktp')) {
            $request->file('foto_ktp')->move('img/ktp/', $request->file('foto_ktp')->getClientOriginalName());
            $pelanggan->foto_ktp = $request->file('foto_ktp')->getClientOriginalName();
        }

        if ($request->hasFile('foto_rumah')) {
            $request->file('foto_rumah')->move('img/rumah/', $request->file('foto_rumah')->getClientOriginalName());
            $pelanggan->foto_rumah = $request->file('foto_rumah')->getClientOriginalName();
        }

        $pelanggan->keterangan_wo = $request->keterangan_wo;

        $pelanggan->save();

        return redirect()->route('capel')->with('sukses', 'Pelanggan Berhasil ditambahkan! <br> Menunggu Validasi...');
    }

    public function validasi($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Ymd', strtotime('now'));

        $pelanggan = Pelanggan::find($id);

        $pelanggan->myir = 'MYIR-' . $today . $id;

        $pelanggan->save();

        return back()->with('sukses', 'Calon Pelanggan berhasil divalidasi');
    }

    public function tolak($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->myir = 'ditolak';

        $pelanggan->save();

        return back()->with('warning', 'Calon Pelanggan ditolak');
    }

    public function deletePelanggan($id)
    {
        $data = Pelanggan::find($id);
        $data->delete();

        return back()->with('warning', 'Perhatian! satu pelanggan dihapus!');
    }

    public function updatePelanggan(Request $request, $id)
    {
        $paket = Pelanggan::find($id);

        $paket->nama = $request->nama;
        $paket->paket_indihome = $request->paket_indihome;
        $paket->alamat = $request->alamat;
        $paket->cp_pelanggan = $request->cp_pelanggan;

        if ($request->hasFile('foto_selfie')) {
            $request->file('foto_selfie')->move('img/pp/', $request->file('foto_selfie')->getClientOriginalName());
            $paket->foto_selfie = $request->file('foto_selfie')->getClientOriginalName();
        }

        if ($request->hasFile('foto_ktp')) {
            $request->file('foto_ktp')->move('img/ktp/', $request->file('foto_ktp')->getClientOriginalName());
            $paket->foto_ktp = $request->file('foto_ktp')->getClientOriginalName();
        }

        if ($request->hasFile('foto_rumah')) {
            $request->file('foto_rumah')->move('img/rumah/', $request->file('foto_rumah')->getClientOriginalName());
            $paket->foto_rumah = $request->file('foto_rumah')->getClientOriginalName();
        }

        $paket->keterangan_wo = $request->keterangan_wo;

        $paket->save();
        return back()->with('sukses', 'Data Pelanggan berhasil di update');
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

            if ($request->total_deposit == "Rp.") {
                $paket->total_deposit = 0;
            } else {
                $paket->total_deposit = str_replace(array('Rp.', '.'), array('', ''), $request->total_deposit);
            }

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

        if ($request->nama_paket == true) {
            $paket->nama_paket = $request->nama_paket;
        } else {
            return back()->with('gagal', 'Field nama paket tidak boleh kosong!');
        }

        if ($request->total_deposit == "Rp.") {
            $paket->total_deposit = 0;
        } else {
            $paket->total_deposit = str_replace(array('Rp.', '.'), array('', ''), $request->total_deposit);
        }

        if ($request->harga_bulanan == "Rp.") {
            $paket->harga_bulanan = 0;
        } else {
            $paket->harga_bulanan = str_replace(array('Rp.', '.'), array('', ''), $request->harga_bulanan);
        }

        $paket->save();
        return back()->with('sukses', 'Berhasil di update');
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

                if ($request->hasFile('gambar')) {
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

    public function updateTeknisi(Request $request, $id)
    {
        $paket = User::find($id);

        $paket->name = $request->name;
        $paket->nip = $request->nip;
        $paket->role = $request->role;
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('img/pp/', $request->file('gambar')->getClientOriginalName());
            $paket->gambar = $request->file('gambar')->getClientOriginalName();
        }

        $paket->cp = $request->cp;
        $paket->alamat = $request->alamat;
        $paket->role = 'teknisi';

        $paket->save();
        return back()->with('sukses', 'Data Teknisi berhasil di update');
    }
}
