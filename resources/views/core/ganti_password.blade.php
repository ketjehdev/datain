@extends('layout.app')

@section('content')
<div class="main-content">
    @include('layout.nav')
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background: blue;">
      <span class="mask bg-gradient-default opacity-8"></span>
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-10 col-md-10">
            <span class="text-light">
                <i class="fa fa-rocket"></i>
                <a href="{{ route('dashboard') }}" class="text-light">Dashboard</a> / {{ $title }}
              </span>
              
            <h1 class="display-2 text-white">Ganti Password</h1>
            <p class="text-white">Password akan diubah permanen jika telah melakukan perubahan pada password.</p>
        </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--8">
      <div class="row" id="form">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="{{ asset('img/pp/'.auth()->user()->gambar) }}" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            
            <div class="card-body pt-6 pt-md-4">
              <div class="row text-center mt-6">
                <div class="col">
                  <div class="card-profile-stats mt-md-4">
                    
                    <strong>{{ auth()->user()->name }}</strong>

                    <p class="bg-success mt-1 px-3" style="display: inline-block; color: #fff; border-radius: 25px; font-size: 13px">
                        {{ ucfirst(auth()->user()->role) }}
                    </p>
                    
                    <br>
                    
                    <button class="btn btn-primary">Ganti Foto</button>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Ganti Password</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="updatePassword" method="POST">
                @method('PUT')
                @csrf
              
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-current_password">Password Lama:</label>
                        <input type="text" name="current_password" id="input-current_password" class="form-control @error('current_password') is-invalid @enderror form-control-alternative" placeholder="Masukkan Password Lama">
                        @error('current_password')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Password Baru:</label>
                        <input type="text" name="password" class="form-control form-control-alternative" placeholder="Password Baru">
                        @error('password')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                    </div>
                    
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Konfirmasi Password Baru:</label>
                        <input type="text" name="password_confirmation" class="form-control form-control-alternative" placeholder="Konfirmasi Password Baru">
                        @error('password_confirmation')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                    </div>

                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      @include('layout.footer')

    </div>
  </div>
@endsection