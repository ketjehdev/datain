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
                  @if (auth()->user()->role == 'admin')
                      
                  <h3 class="mb-0">Daftar teknisi</h3>
                  
                  @else
                  <h3 class="mb-0">Teman Sekelas</h3>
                  @endif
                </div>
                @if (auth()->user()->role == 'admin')
                <div class="col text-right">
                    <button class="btn text-white btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah User</button>
                </div>
                @endif
              </div>
            </div>
            <div class="table-responsive">

              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>

                    @if (auth()->user()->role == 'admin')
                    <th scope="col">Handle</th>
                    @endif
                  </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                <tbody>
                  @foreach ($teknisi as $item)
                    {{-- @if (auth()->user()->nis != $item->nis) --}}
                    <tr>
                      <td>{{ $no++ . '.' }}</td>
                      <td>{{ $item->nis }}</td>
                      <td>{{ $item->username }}</td>
                      <td>
                        @if ($item->role == 'admin')
                          <span class="px-3 bg-success text-white" style="border-radius: 25px">{{ ucfirst($item->role) }}</span>
                        @else
                          <span class="px-3 bg-primary text-white" style="border-radius: 25px">{{ ucfirst($item->role) }}</span>
                        @endif
                      </td>

                      @if (auth()->user()->role == 'admin')
                        <td>
                          @if ($item->id != auth()->user()->id)
                            @if ($item->role == 'admin')
                              <span>
                                <em>
                                  <strong class="text-primary">Administrator</strong>
                                </em>
                              </span>
                            @else
                              <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="{{ '#delete'.$item->id }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                              </button>
    
                              <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="{{ '#edit'.$item->id }}">
                                  <i class="fa fa-cog" aria-hidden="true"></i>
                              </button>
                            @endif  
                          @else
                            <span>
                              <em>
                                <strong class="text-success">Your account</strong>
                              </em>
                            </span>
                          @endif
                        </td>     
                      @endif
                    </tr>
                    {{-- @endif --}}
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
          <h1 class="modal-title fs-5" id="tambahLabel">Tambah User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/terpel/addUser" method="POST">
            @csrf

            <div class="mt-2">
                <label for="nis">NIS:</label>
                <input type="text" name="nis" id="nis" class="form-control" placeholder="Masukan NIS">    
            </div>

            <div class="mt-3">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username">    
            </div>

            <div class="mt-3">
                <label for="role">Username:</label>
                <select name="role" id="role" class="form-control">
                    <option value="">- Pilih Role -</option>
                    <option value="siswa">Siswa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        
            <div class="mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>    
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
          <form action="{{ url('/terpel/deleteUser/'.$item->id) }}" method="POST">
            @csrf
            <div class="mt-2">
                <p>Apakah anda yakin menghapus akun dengan NIS <strong>{{ $item->nis }}</strong> dengan username <strong>{{ $item->username }}</strong></p>
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
          <form action="{{ url('/terpel/editUser/'.$item->id) }}" method="POST">
            @csrf
            
            <div class="mt-2">
                <label for="nis">NIS:</label>
                <input type="text" name="nis" id="nis" class="form-control" value="{{ $item->nis }}" placeholder="Masukan NIS">    
            </div>

            <div class="mt-3">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username" value="{{ $item->username }}">    
            </div>

            <div class="mt-3">
                <label for="role">Username:</label>
                <select name="role" id="role" class="form-control">
                    @if ($item->role == 'admin')
                    <option value="admin">Admin</option>
                    <option value="siswa">Siswa</option>
                    @else
                    <option value="siswa">Siswa</option>
                    <option value="admin">Admin</option>                   
                    @endif
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

@endsection