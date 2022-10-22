@extends('layout.app')

@section('content')
<div class="main-content">
    {{-- sidebar --}}
    @include('layout.nav')

    <div class="header bg-gradient-dark pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">          
        </div>
      </div>
    </div>

    <div class="container-fluid mt--8">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-10 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3>Input Calon Pelanggan</h3>
                </div>
                @if (auth()->user()->role == 'admin')
                <div class="col text-right">
                    <button class="btn text-white btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah User</button>
                </div>
                @endif
                
              </div>
              
            </div>

            
                <div class="mx-4 mb-3 mt-0">
                
                    <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
        
                    <div class="mt-2">
                        
                        <label for="nama" style="font-size: 14px">Nama Pelanggan</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Pelanggan" style="color: #000">
                        
                    </div>

                    <div class="mt-2">
                        
                        <label for="email" style="font-size: 14px">Email Pelanggan</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="email Pelanggan" style="color: #000">
                        
                    </div>
                    

                    <div class="mt-2">
                        
                        <label for="paket" style="font-size: 14px">Paket Indihome</label>
                        <select name="paket" id="paket" class="form-control">
                            <option value="">-Pilih Paket Indihome-</option>
                            @foreach ($paket as $item)
                            <option value="{{ $item->nama_paket }}">{{ $item->nama_paket }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="mt-2">
                        
                        <label for="kode_pelanggan" style="font-size: 14px">Kode Pelanggan</label>
                        <input type="number" min="0" name="kode_pelanggan" id="kode_pelanggan" class="form-control" placeholder="Kode Pelanggan" style="color: #000">
                        
                    </div>

                    <div class="mt-2">
                        
                        <label for="alamat" style="font-size: 14px">Alamat Pelanggan</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Pelanggan" style="color: #000">
                        
                    </div>

                    <div class="mt-2">
                        
                        <label for="cp" style="font-size: 14px">Kontak Pelanggan</label>
                        <input type="number" name="cp" id="cp" class="form-control" placeholder="Kontak Pelanggan" min="0" style="color: #000">
                        
                    </div>

                    <div class="mt-2">
                        
                        <label for="foto_selfie" style="font-size: 14px">Foto Selfie</label>
                        <input type="file" accept=".jpg,.png,.jpeg" name="foto_selfie" id="foto_selfie" class="form-control" style="color: #000">
                        
                    </div>

                    <div class="mt-2">
                        
                        <label for="foto_ktp" style="font-size: 14px">Foto KTP</label>
                        <input type="file" accept=".jpg,.png,.jpeg" name="foto_ktp" id="foto_ktp" class="form-control" style="color: #000">
                        
                    </div>

                    <div class="mt-2">
                        
                        <label for="foto_rumah" style="font-size: 14px">Foto Rumah</label>
                        <input type="file" accept=".jpg,.png,.jpeg" name="foto_rumah" id="foto_rumah" class="form-control" style="color: #000">
                        
                    </div>

                    <div class="mt-4" style="width: 100%">
                        
                        <button type="submit" class="btn btn-dark">Submit</button>

                        <button data-bs-toggle="modal" data-bs-target="#reset" type="reset" class="btn text-warning">Reset</button>
        
                        <div class="modal fade" id="reset" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="deleteLabel">Reset Data</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        
                                <div class="modal-body">
                                    <div class="mt-2">
                                        Inputan anda akan direset! apakah anda yakin?
                                    </div>

                                    <div class="mt-4">
                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
                                        <a href="{{ route('inpel') }}" class="btn btn-danger">Yakin</a>    
                                    </div>

                                </div>
                              </div>
                            </div>

                    </div>

                    </form>
    
                </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  
@endsection