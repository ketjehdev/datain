<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <h5 class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">{{ $title }}</h5>

      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="profil picture" src="{{ asset('img/pp/'.auth()->user()->gambar) }}">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>

            <a href="{{ route('editProfil') }}" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Edit Profil</span>
            </a>

            <a href="{{ route('gantiPassword') }}" class="dropdown-item">
              <i class="fa fa-key"></i>
              <span>Ganti Password</span>
            </a>

            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="btn dropdown-item">
                <i class="ni ni-user-run"></i>
              <span>Logout</span>
              </button>
            </form>
          </div>

        </li>
      </ul>
    </div>
  </nav>
