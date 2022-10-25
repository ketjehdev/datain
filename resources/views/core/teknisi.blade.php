@extends('layout.app')

@section('content')
<div class="main-content">
    {{-- sidebar --}}
    @include('layout.nav')

    <div class="header bg-gradient-pink pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">          
        </div>
      </div>
    </div>

    <div class="container-fluid mt--8">
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Daftar teknisi</h3>
                </div>
                <div class="col text-right">
                    <button class="btn text-white btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Teknisi</button>
                </div>
              </div>
            </div>
            <div class="table-responsive">

              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr class="text-center" style="white-space: nowrap;">
                    <th scope="col">No.</th>
                    <th scope="col">Teknisi</th>
                    <th scope="col">Kontak</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                <tbody>
                  @foreach ($teknisi as $item)
                    <tr class="text-center" style="white-space: nowrap;">
                      <td>{{ $no++ . '.' }}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          
                        <a href="{{ asset('/img/pp/'.$item->gambar) }}" target="_blank">
                          <img src="{{ asset('img/pp/'.$item->gambar) }}" width="60" height="60" style="border-radius: 100%" alt="">
                        </a>
                        
                        <div class="d-flex ms-3 flex-column">
                          <span style="font-weight: bold">{{ $item->name }}</span>
                          <span class="text-left text-primary">{{ Str::ucfirst($item->nip) }}</span>                      
                        </div>

                       </div>
                      </td>

                      <td>
                        {{ $item->cp }}
                      </td>

                      <td>
                        {{ $item->alamat }}
                      </td>

                      <td>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="{{ '#delete'.$item->id }}">
                          <i class="fa fa-trash"></i>
                        </button>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="{{ '#edit'.$item->id }}">
                            <i class="fa fa-cog"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahLabel">Tambah Teknisi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="tambahTeknisi" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mt-2">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap Teknisi">    
            </div>

            <div class="mt-3">
                <label for="nip">NIP</label>
                <input type="number" min="0" name="nip" id="nip" class="form-control" placeholder="NIP Teknisi">    
            </div>

            <div class="mt-3">
                <label for="gambar">Foto Teknisi</label>
                <input type="file" accept=".jpg,.png,.jpeg" name="gambar" id="gambar" class="form-control">    
            </div>

            <div class="mt-3">
                <label for="cp">Kontak Teknisi</label>
                <input type="number" min="0" name="cp" id="cp" placeholder="Kontak Teknisi" class="form-control">    
            </div>

            <div class="mt-3">
                <label for="alamat">Alamat Teknisi</label>
                <input type="text" name="alamat" id="alamat" placeholder="Alamat Teknisi" class="form-control">    
            </div>

            <div class="mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="simpan btn btn-primary">Simpan</button>    
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  @foreach ($teknisi as $item)      
  <div class="modal fade" id="{{ 'delete'.$item->id }}" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteLabel">Hapus User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="{{ url('/hapusTeknisi/'.$item->id) }}" method="POST">
            @csrf
            <div class="mt-2">
                <p>Apakah anda yakin menghapus teknisi dengan NIP <strong>{{ $item->nip }}</strong> dengan nama <strong>{{ $item->name }}</strong>?</p>
            </div>
            <div class="mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>    
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  @foreach ($teknisi as $item)      
  <div class="modal fade" id="{{ 'edit'.$item->id }}" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="{{ url('/updateTeknisi/'.$item->id) }}" method="POST">
            @csrf
          <div class="mt-2">
              <label for="name">Nama Lengkap</label>
              <input type="text" name="name" value="{{ $item->name }}" class="form-control" placeholder="Nama Lengkap Teknisi">    
          </div>

          <div class="mt-3">
              <label for="nip">NIP</label>
              <input type="number" min="0" value="{{ $item->nip }}" name="nip" id="nip" class="form-control" placeholder="NIP Teknisi">    
          </div>

          <div class="mt-3">
              <label for="gambar">Foto Teknisi</label>
              <input type="file" accept=".jpg,.png,.jpeg" name="gambar" id="gambar" class="form-control">    
          </div>

          <div class="mt-3">
              <label for="cp">Kontak Teknisi</label>
              <input type="number" min="0" name="cp" value="{{ $item->cp }}" id="cp" placeholder="Kontak Teknisi" class="form-control">    
          </div>

          <div class="mt-3">
              <label for="alamat">Alamat Teknisi</label>
              <input type="text" name="alamat" id="alamat" value="{{ $item->alamat }}" placeholder="Alamat Teknisi" class="form-control">    
          </div>

          <div class="mt-4">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="simpan btn btn-primary">Simpan</button>    
          </div>

        </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach

@endsection