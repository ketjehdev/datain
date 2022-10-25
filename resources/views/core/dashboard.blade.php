@extends('layout.app')

@php
    date_default_timezone_set('Asia/Jakarta');
    $time = date('H');
    $date = date('Y', strtotime('now'))
@endphp

@section('content')
<div class="main-content">
    {{-- sidebar --}}
    @include('layout.nav')

    <div class="header @if(auth()->user()->role == 'admin') bg-gradient-success @else bg-gradient-danger @endif  pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <h2>
                      Selamat
                      @if ($time >= 00 && $time <= 11)
                          Pagi!
                      @elseif ($time >= 12 && $time <= 14)
                          Siang!
                      @elseif ($time >= 15 && $time <= 18)
                          Sore!
                      @elseif ($time >= 19 && $time <= 23)
                          Malam!
                      @endif
                    </h2>

                    <div class="col">
                      <div class="media align-items-center">
                        <span class="avatar avatar-lg rounded-circle">
                          <img alt="profil" src="{{ asset('img/pp/'.auth()->user()->gambar) }}">
                        </span>
                        
                        <div class="media-body ml-2">
                          <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->name }}</span>
                          <br>
                          <span class="mb-0 text-sm px-3 @if(auth()->user()->role == 'admin') bg-success @else bg-danger @endif text-white font-weight-bold" 
                            style="border-radius: 25px">
                            {{ ucfirst(auth()->user()->role) }}
                          </span>
                        </div>
                      </div>
                    
                      <div class="mt-3">
                        <a href="{{ route('capel') }}" class="btn text-white btn-primary">
                          <i class="fa fa-address-card"></i> 
                          @if (auth()->user()->role == 'admin')  
                          <span>Validasi Pelanggan</span>  
                          @else
                          <span>Manage Pelanggan</span>  
                          @endif
                        </a>  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-6 p-0 col-lg-6">
              <div class="col-xl-12 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Calon Pelanggan</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $capel }}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>

              <div class="col-xl-12 col-lg-6 mt-3">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Pelanggan aktif</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $pelak }}</span>
                      </div>
  
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fa fa-users"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                  <h3>Calon Pelanggan</h3>
                </div>
                
                <div class="col text-right">
                    <a href="{{ route('capel') }}" class="btn text-white btn-sm btn-primary">
                      Manage >
                    </a>
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
                  </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                <tbody>
                  @foreach ($pelanggan as $item)
                    @if ($item->myir == null)
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

    
    @if (auth()->user()->role == 'admin')        
    <div class="container-fluid my-5">
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">List Teknisi</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ route('teknisiKaryawan') }}" class="btn btn-sm btn-primary">Selengkapnya ></a>
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

                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
    
    @endif

    <div class="container-fluid my-5">
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                 <h3>List Paket Indihome</h3>
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
                        <td>Rp. {{ number_format($item->harga_deposit, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($item->harga_bulanan, 0, ',', '.') }}</td>
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
      @include('layout.footer')
    </div>

  </div>

  

  @endsection