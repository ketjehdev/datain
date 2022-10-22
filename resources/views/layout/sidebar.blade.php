
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
        aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand p-0" href="{{ route('dashboard') }}">
        <img src="{{ asset('img/logo1.png') }}" style="width: 100%; object-fit: contain" alt="">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ asset('img/pp/'.auth()->user()->gambar) }}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Halo!</h6>
            </div>
            <a href="#" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Profilku</span>
            </a>

            <div class="dropdown-divider"></div>
            <form action="#" method="POST">
              @csrf
              <button class="btn dropdown-item">
                <i class="ni ni-user-run"></i>
              <span>Logout</span>
              </button>
            </form>
          </div>

        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="#">
                <h4>Terpel.</h4>
              </a>
            </div>

            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item" @if($page == 'dash') style="border-left: 2px solid #D24D60" @endif>
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="fa fa-rocket text-orange"></i> 
              <span @if($page == 'dash') class="text-dark"  style="font-weight: 500" @endif>Dashboard</span>
            </a>
          </li>
        </ul>

        <hr class="my-2" style="border-color: #aaa">
        <h6 class="navbar-heading text-muted" style="font-size: 11px">Customers @if(auth()->user()->role == 'admin') & Products @endif</h6>
        <ul class="navbar-nav mb-md-3">
        
          <li class="nav-item" @if($page == 'cp') style="border-left: 2px solid #D24D60" @endif>
            <a class="nav-link" href="{{ route('capel') }}">
              <i class="fa fa-address-card text-primary"></i> 
              <span @if($page == 'cp')  class="text-dark" style="font-weight: 500" @endif>@if(auth()->user()->role == 'admin') Validasi Pelanggan @else Calon Pelanggan @endif</span>
            </a>
          </li>

          @if (auth()->user()->role == 'teknisi')
          
          <li class="nav-item" @if($page == 'ip') style="border-left: 2px solid #D24D60" @endif>
            <a class="nav-link" href="{{ route('inpel') }}">
              <i class="fa fa-user-plus text-dark"></i> 
              <span @if($page == 'ip')  class="text-dark" style="font-weight: 500" @endif>
                Input Pelanggan
              </span>
            </a>
          </li>
          
          @endif

          @if (auth()->user()->role == 'admin')
              
          <li class="nav-item" @if($page == 'pi') style="border-left: 2px solid #D24D60" @endif>
            <a class="nav-link" href="{{ route('pain') }}">
              <i class="fa fa-home text-danger"></i> 
              <span @if($page == 'pi')  class="text-dark" style="font-weight: 500" @endif>
                Paket Indihome
              </span>
            </a>
          </li>

          @endif

        </ul>

        @if (auth()->user()->role == 'admin')
          
          <hr class="my-2" style="border-color: #aaa">
          <h6 class="navbar-heading text-muted" style="font-size: 11px">Management Users</h6>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item" @if($page == 'tk') style="border-left: 2px solid #D24D60" @endif>
              <a class="nav-link" href="{{ route('teknisiKaryawan') }}">
                <i class="fa fa-users text-pink"></i> 
                <span @if($page == 'tk')  class="text-dark" style="font-weight: 500" @endif>Teknisi Karyawan</span>
              </a>
            </li>
          </ul>
        @endif

        <hr class="my-2" style="border-color: #aaa">
        <h6 class="navbar-heading text-muted" style="font-size: 11px">Settings</h6>
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item" @if($page == 'ep') style="border-left: 2px solid #D24D60" @endif>
            <a class="nav-link" href="{{ route('editProfil') }}">
              <i class="ni ni-single-02 text-success"></i> 
              <span @if($page == 'ep')  class="text-dark" style="font-weight: 500" @endif>Edit Profil</span>
            </a>
          </li>

            <li class="nav-item" @if($page == 'gp') style="border-left: 2px solid #D24D60" @endif>
              <a class="nav-link" href="{{ route('gantiPassword') }}">
                <i class="fa fa-key text-yellow"></i> 
                <span @if($page == 'gp') class="text-dark"  style="font-weight: 500" @endif>Ganti Password</span>
              </a>
            </li>
        </ul>

      </div>
    </div>
  </nav>
