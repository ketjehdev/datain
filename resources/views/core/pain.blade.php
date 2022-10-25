@extends('layout.app')

@section('content')
<div class="main-content">
    {{-- sidebar --}}
    @include('layout.nav')

    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
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
                 <h3>List Paket Indihome</h3>
                </div>
                <div class="col text-right">
                    <button class="btn text-white btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Paket</button>
                </div>
              </div>
            </div>
            <div class="table-responsive">

              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Harga Deposit</th>
                    <th scope="col">Harga Perbulan</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                <tbody>

                 @forelse ($paket as $item)
                    
                    <tr>
                        <td>{{ $no++ . '.' }}</td>
                        <td>{{ $item->nama_paket }}</td>
                        <td>Rp. {{ number_format($item->total_deposit, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($item->harga_bulanan, 0, ',', '.') }}</td>
                        <td>
                          <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="{{ '#delete'.$item->id }}">
                              <i class="fa fa-trash"></i>
                          </button>
                          <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="{{ '#edit'.$item->id }}">
                              <i class="fa fa-cog"></i>
                          </button>
                        </td>
                      </tr>

                  @empty
                  
                    
                  <div class="row rounded flex-column align-items-center justify-content-center" style="background: #fff;">
                    <div class="col-xl-6">
                        <h4 class="text-center text-dark">
                            Paket Belum Ada!
                        </h4>
                    </div>
                    <div class="col-xl-5 d-flex flex-column ">
                        <img src="{{ asset('img/empty.svg') }}" style="width: 100%;" alt="">
                    </div>
                  </div>

                  @endforelse

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
          <h1 class="modal-title fs-5" id="tambahLabel">Tambah Paket</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="tambahPaket" method="POST">
            @csrf

            <div class="mt-2">
                <label for="nama_paket">Nama Paket:</label>
                <input type="text" name="nama_paket" id="nama_paket" class="form-control" placeholder="Nama Paket" style="color: #000">    
            </div>

            <div class="mt-3">
                <label for="total_deposit">Harga Deposit:</label>
                <input type="text" name="total_deposit" id="total_deposit" class="form-control" style="color: #000">    
            </div>
        
            <div class="mt-3">
                <label for="harga_bulanan">Harga Bulanan:</label>
                <input type="text" name="harga_bulanan" id="harga_bulanan" class="form-control" style="color: #000">    
            </div>
        
            <div class="mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Simpan</button>    
            </div>

        </form>
        </div>
      </div>
    </div>
  </div>

  @foreach ($paket as $item)      
  <div class="modal fade" id="{{ 'delete'.$item->id }}" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteLabel">Hapus User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <form action="{{ url('deletePaket/'.$item->id) }}" method="POST">
            @csrf
            <div class="mt-2">
                <p class="text-dark">Apakah anda yakin menghapus paket <strong>{{ $item->nama_paket }} (Rp. {{ number_format($item->harga_bulanan, 0, ',', '.') }})</strong> </p>
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

  @foreach ($paket as $item)      
  <div class="modal fade" id="{{ 'edit'.$item->id }}" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="{{ url('/updatePaket/'.$item->id) }}" method="POST">
            @csrf
            
            <div class="mt-2">
                <label for="nama_paket">Nama Paket:</label>
                <input type="text" name="nama_paket" id="nama_paket" class="form-control" value="{{ $item->nama_paket }}" style="color: #000" placeholder="Nama Paket">    
            </div>

            <div class="mt-3">
                <label for="total_deposit_updt">Harga deposit:</label>
                <input type="text" name="total_deposit" id="total_deposit_updt" class="form-control" style="color: #000" placeholder="Harga Deposit" value="{{ number_format($item->total_deposit, 0, ',', '.') }}">    
            </div>
            
            <div class="mt-3">
                <label for="harga_bulanan_updt">Harga Bulanan:</label>
                <input type="text" name="harga_bulanan" id="harga_bulanan_updt" class="form-control" style="color: #000" placeholder="Harga Bulanan" value="{{ number_format($item->harga_bulanan, 0, ',', '.') }}">    
            </div>
            
            <div class="mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Update</button>    
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach

@endsection