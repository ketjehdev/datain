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

    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
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
                          <span class="mb-0 text-sm px-3 bg-primary text-white font-weight-bold" style="border-radius: 25px">{{ ucfirst(auth()->user()->role) }}</span>
                        </div>
                      </div>
                    
                      <div class="mt-3">
                        <a href="{{ route('editProfil') }}" class="btn text-white btn-info">Profilku</a>
                        <a href="{{ route('gantiPassword') }}" class="btn text-white btn-primary">Ganti Password</a>                        
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
                        <span class="h2 font-weight-bold mb-0">{{ $total_user }}</span>
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
                        <h5 class="card-title text-uppercase text-muted mb-0">Pelanggan</h5>
                        <span class="h2 font-weight-bold mb-0">2</span>
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

    @if (auth()->user()->role == 'admin')
        
    <div class="container-fluid mt--8">
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">List Teknisi</h3>
                </div>
                <div class="col text-right">
                  <a href="#" class="btn btn-sm btn-primary">Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Role</th>
                  </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                <tbody>
                  @foreach ($users as $item)
                  <tr>
                    <td>{{ $no++ . '.' }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->name }}</td>

                    <td>    
                        @if ($item->role == 'admin')
                          <span class="px-3 bg-success text-white" style="border-radius: 25px">{{ ucfirst($item->role) }}</span>
                        @else
                          <span class="px-3 bg-primary text-white" style="border-radius: 25px">{{ ucfirst($item->role) }}</span>
                        @endif
                    </td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      @include('layout.footer')
    </div>
    
    @endif
  </div>
@endsection