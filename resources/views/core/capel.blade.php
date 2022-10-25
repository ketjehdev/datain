@extends('layout.app')

@section('content')
<div class="main-content">
    {{-- sidebar --}}
    @include('layout.nav')

    <div class="header @if(auth()->user()->role == 'admin') bg-success @else bg-gradient-info @endif pb-8 pt-5 pt-md-8">
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
                  @if (auth()->user()->role == 'admin')
                      
                  <h3 class="mb-0">Validasi pelanggan</h3>
                  
                  @else
                  <h3 class="mb-0">Calon Pelanggan</h3>
                  @endif
                </div>
                
                <div class="col text-right">
                    <button class="btn text-white btn-sm btn-success" type="button" data-bs-toggle="modal" data-bs-target="#tervalidasi">
                      <i class="fa fa-check"></i> Tervalidasi
                    </button>
                    <button class="btn text-white btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#ditolak">
                      <i class="fa fa-ban"></i> Ditolak
                    </button>
                </div>

              </div>
            </div>
            <div class="table-responsive">

              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr class="text-center" style="white-space: nowrap;">
                    <th scope="col">No.</th>
                    <th scope="col">Pelanggan</th>
                    <th scope="col">Kode Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Foto KTP</th>
                    <th scope="col">Foto Rumah</th>
                    <th scope="col">Keterangan WO</th>
                    <th scope="col">MYIR</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                <tbody>
                  @foreach ($pelanggan as $item)
                    @if ($item->myir != 'ditolak' && $item->myir == null)
                    <tr class="text-center" style="white-space: nowrap;">
                      <td>{{ $no++ . '.' }}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          
                        <a href="{{ asset('/img/pp/'.$item->foto_selfie) }}" target="_blank">
                          <img src="{{ asset('img/pp/'.$item->foto_selfie) }}" width="60" height="60" style="border-radius: 100%" alt="">
                        </a>
                        
                        <div class="d-flex ms-3 flex-column">
                          <span style="font-weight: bold">{{ $item->nama }}</span>
                          <span class="text-left text-primary">{{ $item->cp_pelanggan }}</span>                      
                        </div>

                       </div>
                      </td>

                      <td>{{ $item->kode_pelanggan }}</td>
                      <td>{{ $item->alamat }}</td>
                      <td>
                        <a href="{{ url('img/ktp/'.$item->ktp) }}">
                          <img src="{{ asset('img/ktp/'.$item->foto_ktp) }}" width="90" class="rounded" alt="">
                        </a>
                      </td>
                      <td>
                        <a href="{{ url('img/rumah/'.$item->rumah) }}">
                          <img src="{{ asset('img/rumah/'.$item->foto_rumah) }}" width="90" class="rounded" alt="">
                        </a>
                      </td>
                      <td>{{ $item->keterangan_wo }}</td>
                      
                      @if ($item->myir == null)
                        <td>
                          <em class="text-warning">Belum divalidasi</em>
                        </td>
                      @else
                        <td>{{ $item->myir }}</td>
                      @endif

                      <td>
                        @if (auth()->user()->role == 'admin')
                            
                        @if ($item->myir == null)
                            
                          <form action="{{ url('/validasi/'.$item->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            <button class="btn btn-success" type="submit">
                              <i class="fa fa-check"></i>
                            </button>
                          </form>
                              
                        @endif

                          <form action="{{ url('/tolak/'.$item->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger" type="submit">
                              <i class="fa fa-ban"></i>
                            </button>
                          </form>
                        @else
                        
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="{{ '#hapus'.$item->id }}">
                          <i class="fa fa-trash"></i>
                        </button>

                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="{{ '#edit'.$item->id }}">
                          <i class="fa fa-cog"></i>
                        </button>
                        @endif
                      </td>
                      
                    </tr>
                    @endif

                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tervalidasi" tabindex="-1" aria-labelledby="tervalidasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tervalidasiLabel">Pelanggan Tervalidasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr class="text-center" style="white-space: nowrap;">
                  <th scope="col">No.</th>
                  <th scope="col">Pelanggan</th>
                  <th scope="col">Kode Pelanggan</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Foto KTP</th>
                  <th scope="col">Foto Rumah</th>
                  <th scope="col">Keterangan WO</th>
                  <th scope="col">MYIR</th>
                </tr>
              </thead>

              @php
                  $no = 1;
              @endphp
              <tbody>
                @foreach ($pelanggan as $item)
                 @if ($item->myir != null && $item->myir != 'ditolak')
                  <tr class="text-center" style="white-space: nowrap;">
                    <td>{{ $no++ . '.' }}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        
                      <a href="{{ asset('/img/pp/'.$item->foto_selfie) }}" target="_blank">
                        <img src="{{ asset('img/pp/'.$item->foto_selfie) }}" width="60" height="60" style="border-radius: 100%" alt="">
                      </a>
                      
                      <div class="d-flex ms-3 flex-column">
                        <span style="font-weight: bold">{{ $item->nama }}</span>
                        <span class="text-left text-primary">{{ $item->cp_pelanggan }}</span>                      
                      </div>

                     </div>
                    </td>

                    <td>{{ $item->kode_pelanggan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                      <a href="{{ url('img/ktp/'.$item->ktp) }}">
                        <img src="{{ asset('img/ktp/'.$item->foto_ktp) }}" width="90" class="rounded" alt="">
                      </a>
                    </td>
                    <td>
                      <a href="{{ url('img/rumah/'.$item->rumah) }}">
                        <img src="{{ asset('img/rumah/'.$item->foto_rumah) }}" width="90" class="rounded" alt="">
                      </a>
                    </td>
                    <td>{{ $item->keterangan_wo }}</td>
                    <td>{{ $item->myir }}</td>
                  </tr>             
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <div class="modal fade" id="ditolak" tabindex="-1" aria-labelledby="ditolakLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ditolakLabel">Pelanggan Ditolak</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr class="text-center" style="white-space: nowrap;">
                  <th scope="col">No.</th>
                  <th scope="col">Pelanggan</th>
                  <th scope="col">Kode Pelanggan</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Foto KTP</th>
                  <th scope="col">Foto Rumah</th>
                  <th scope="col">Keterangan WO</th>
                  <th scope="col">MYIR</th>
                </tr>
              </thead>

              @php
                  $no = 1;
              @endphp
              <tbody>
                @foreach ($pelanggan as $item)
                 @if ($item->myir == 'ditolak')
                  <tr class="text-center" style="white-space: nowrap;">
                    <td>{{ $no++ . '.' }}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        
                      <a href="{{ asset('/img/pp/'.$item->foto_selfie) }}" target="_blank">
                        <img src="{{ asset('img/pp/'.$item->foto_selfie) }}" width="60" height="60" style="border-radius: 100%" alt="">
                      </a>
                      
                      <div class="d-flex ms-3 flex-column">
                        <span style="font-weight: bold">{{ $item->nama }}</span>
                        <span class="text-left text-primary">{{ $item->cp_pelanggan }}</span>                      
                      </div>

                     </div>
                    </td>

                    <td>{{ $item->kode_pelanggan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                      <a href="{{ url('img/ktp/'.$item->ktp) }}">
                        <img src="{{ asset('img/ktp/'.$item->foto_ktp) }}" width="90" class="rounded" alt="">
                      </a>
                    </td>
                    <td>
                      <a href="{{ url('img/rumah/'.$item->rumah) }}">
                        <img src="{{ asset('img/rumah/'.$item->foto_rumah) }}" width="90" class="rounded" alt="">
                      </a>
                    </td>
                    <td>{{ $item->keterangan_wo }}</td>
                    <td class="text-danger">{{ $item->myir }}</td>
                  </tr>             
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @foreach ($pelanggan as $item)      
  <div class="modal fade" id="{{ 'edit'.$item->id }}" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="{{ url('/updatePelanggan/'.$item->id) }}" method="POST">
            @csrf
            
            <div class="mt-2">
              <label for="kode_pelanggan" style="font-size: 14px">Kode Pelanggan</label>
              <input type="text" readonly value="{{ $item->kode_pelanggan }}" name="kode_pelanggan" id="kode_pelanggan" class="form-control" placeholder="Kode Pelanggan" style="color: #000">
            </div>

            <div class="mt-2">
                <label for="nama" style="font-size: 14px">Nama Pelanggan</label>
                <input type="text" name="nama" id="nama" value="{{ $item->nama }}" class="form-control" placeholder="Namsa Pelanggan" style="color: #000">
            </div>

            <div class="mt-2">
                <label for="alamat" style="font-size: 14px">Alamat Pelanggan</label>
                <input type="text" name="alamat" id="alamat" value="{{ $item->alamat }}" class="form-control" placeholder="Alamat Pelanggan" style="color: #000">
            </div>

            <div class="mt-2">
                <label for="cp_pelanggan" style="font-size: 14px">Kontak Pelanggan</label>
                <input type="number" name="cp_pelanggan" id="cp_pelanggan" value="{{ $item->cp_pelanggan }}" class="form-control" placeholder="Kontak Pelanggan" min="0" style="color: #000">
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

            <div class="mt-2">
                <label for="keterangan_wo" style="font-size: 14px">Keterangan WO</label>
                <input type="text" placeholder="Keterangan WO" name="keterangan_wo" id="keterangan_wo" class="form-control" style="color: #000" value="{{ $item->keterangan_wo }}">
            </div>

            
            <div class="mt-2">
                <label for="paket_indihome" style="font-size: 14px">Paket Indihome</label>
                <select name="paket_indihome" id="paket_indihome" class="form-control">
                    <option value="{{ $item->paket_indihome }}">{{ $item->paket_indihome }}</option>
                    @foreach ($paket as $item)
                    <option value="{{ $item->nama_paket }}">{{ $item->nama_paket }}</option>
                    @endforeach
                </select>
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


  @foreach ($pelanggan as $item)      
  <div class="modal fade" id="{{ 'hapus'.$item->id }}" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="hapusLabel">Hapus Pelanggan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <form action="{{ url('/deletePelanggan/'.$item->id) }}" method="POST">
            @csrf
            <div class="mt-2">
                <p class="text-dark">Apakah anda yakin menghapus pelanggan <strong>{{ $item->nama }}</strong> dengan kode pelanggan <strong>{{ $item->kode_pelanggan }}</strong> </p>
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

@endsection