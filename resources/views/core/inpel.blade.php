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
                
                    <form action="/tambahPelanggan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2">
                      <label for="kode_pelanggan" style="font-size: 14px">Kode Pelanggan</label>
                      <input type="text" readonly value="{{ $kode_pelanggan }}" name="kode_pelanggan" id="kode_pelanggan" class="form-control @error('kode_pelanggan') is-invalid @enderror" placeholder="Kode Pelanggan" style="color: #000">
                      @error('kode_pelanggan')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="mt-2">
                        <label for="nama" style="font-size: 14px">Nama Pelanggan</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Pelanggan" style="color: #000">
                        @error('nama')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-2">
                        <label for="paket_indihome" style="font-size: 14px">Paket Indihome</label>
                        <select name="paket_indihome" id="paket_indihome" class="form-control @error('paket_indihome') is-invalid @enderror">
                            <option value="">-Pilih Paket Indihome-</option>
                            @foreach ($paket as $item)
                            <option value="{{ $item->nama_paket }}">{{ $item->nama_paket }}</option>
                            @endforeach
                        </select>
                        @error('paket_indihome')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label for="alamat" style="font-size: 14px">Alamat Pelanggan</label>
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Pelanggan" style="color: #000">
                        @error('alamat')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror  
                    </div>

                    <div class="mt-2">
                        
                        <label for="cp_pelanggan" style="font-size: 14px">Kontak Pelanggan</label>
                        <input type="number" name="cp_pelanggan" id="cp_pelanggan" class="form-control @error('cp_pelanggan') is-invalid @enderror" placeholder="Kontak Pelanggan" min="0" style="color: #000">
                        @error('cp_pelanggan')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label for="foto_selfie" style="font-size: 14px">Foto Selfie</label>
                        <input type="file" accept=".jpg,.png,.jpeg" name="foto_selfie" id="foto_selfie" class="form-control" style="color: #000">
                        @error('foto_selfie')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror  
                    </div>

                    <div class="mt-2">
                        <label for="foto_ktp" style="font-size: 14px">Foto KTP</label>
                        <input type="file" accept=".jpg,.png,.jpeg" name="foto_ktp" id="foto_ktp" class="form-control" style="color: #000">
                        @error('foto_ktp')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror  
                    </div>

                    <div class="mt-2">
                        <label for="foto_rumah" style="font-size: 14px">Foto Rumah</label>
                        <input type="file" accept=".jpg,.png,.jpeg" name="foto_rumah" id="foto_rumah" class="form-control" style="color: #000">
                        @error('foto_rumah')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror  
                    </div>

                    <div class="mt-2">
                        <label for="keterangan_wo" style="font-size: 14px">Keterangan WO</label>
                        <input type="text" placeholder="Keterangan WO" name="keterangan_wo" id="keterangan_wo" class="form-control" style="color: #000">
                        @error('keterangan_wo')
                          <p class="mb-0 text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror  
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