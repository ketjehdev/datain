
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
          <li class="nav-item" style="border-left: 2px solid #D24D60">
            <a class="nav-link" href="#">
              <i class="fa fa-rocket text-orange"></i> 
              <strong class="text-dark" style="font-weight: 500">Dashboard</strong>
            </a>
          </li>
        </ul>

        <hr class="my-2" style="border-color: #aaa">
        <h6 class="navbar-heading text-muted" style="font-size: 11px">Customers & Product</h6>
        <ul class="navbar-nav mb-md-3">
        
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-address-card text-primary"></i> 
              Calon Pelanggan 
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-home text-danger"></i> 
              Paket Indihome 
            </a>
          </li>

        </ul>

        <hr class="my-2" style="border-color: #aaa">
        <h6 class="navbar-heading text-muted" style="font-size: 11px">Management Users</h6>
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
              <i class="fa fa-users text-pink"></i> 
              Teknisi Karyawan
            </a>
          </li>
        </ul>

        <hr class="my-2" style="border-color: #aaa">
        <h6 class="navbar-heading text-muted" style="font-size: 11px">Settings</h6>
        <ul class="navbar-nav mb-md-3">
         
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="ni ni-single-02 text-success"></i> 
              Edit Profil
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-key text-yellow"></i> Ganti Password
            </a>
          </li>

        </ul>

      </div>
    </div>
  </nav>
