@extends('layout.app')

@php
    date_default_timezone_set('Asia/Jakarta');
    $time = date('H');
    $date = date('Y', strtotime('now'))
@endphp

@section('content-auth')
<div class="container-fluid" style="background-image: radial-gradient(circle at 12% 55%,rgba(33,150,243,.15),hsla(0,0%,100%,0) 25%),radial-gradient(circle at 85% 33%,rgba(225,46,33,.175),hsla(0,0%,100%,0)   25%)">
    <div class="row" style="height: 100vh;">
        <div class="col-xl-6 d-xl-flex d-none p-5">
            @auth
            <img src="{{ asset('img/ils2.svg') }}" style="width: 100%;" alt="ilustration1">
            @else
            <img src="{{ asset('img/ils1.png') }}" style="width: 100%;" alt="ilustration1">
            @endauth
        </div>

        <div class="col-12 col-xl-6 d-flex justify-content-center align-items-center">
            <div class="col-12 col-xl-8 d-flex flex-column align-items-center p-4" style="border-top: 3.5px solid red; border-radius: 10px; background: #fff; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="col-xl-2 col-4 d-flex justify-content-center align-items-center mb-xl-3 mb-2">
                    <img src="{{ asset('img/logo1.png') }}" style="width: 130%" alt="logo1">
                </div>

                <div class="col-xl-10 text-center">
                    @auth
                        <h4 class="mb-3">Anda Sudah Login!</h4>
                        <p>
                            Anda sudah login! Logout terlebih dahulu untuk melakukan login kembali.
                        </p>
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Kembali Ke Dashboard</a>                    
                        
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-1 border-0 btn text-danger">Logout</button>                    
                        </form>
                    @else    
                    <h4>
                        Selamat
                        @if ($time >= 00 && $time <= 11)
                            Pagi
                        @elseif ($time >= 12 && $time <= 14)
                            Siang
                        @elseif ($time >= 15 && $time <= 18)
                            Sore
                        @elseif ($time >= 19 && $time <= 23)
                            Malam
                        @endif
                    </h4>
                    <h6>
                            
                    - Silakan Login -
                    
                    </h6>

                    @endauth
                </div>

                <div class="col-12 col-xl-11">
                    
                @if(auth()->user() == false)
                    <form action="{{ route('login_handle') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="nip">NIP :</label>
                            <input type="text" value="{{ old('nip') }}" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" placeholder="Nomor Identitas Pegawai" autofocus>    
                            @error('nip')<p class="mb-0 text-danger" style="font-size: 14px">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password">Password :</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan Password">    
                            @error('password')<p class="mb-0 text-danger" style="font-size: 14px">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="mt-3">  
                            <button class="btn btn-danger" style="width: 100%;">Masuk</button>
                        </div>
                    </form>
                @endif 

                    <hr>
                
                    <div class="text-secondary text-center" style="font-size: 13px">
                        <p class="mb-0">Copyright &copy; {{ $date }}, <strong>Datain</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 