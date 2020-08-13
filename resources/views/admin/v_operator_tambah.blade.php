@extends('layouts.main_app')

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Pegawai</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">    
      <div class="row">

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Data Pegawai</h3>
              <a href="{{url('/dashboard/admin/operator')}}" class="btn btn-danger btn-sm float-right">Kembali</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-warning">
                  <div class="card-body">
                    <form role="form" action="{{url('/dashboard/admin/operator_act')}}" method="post">
                      {{ csrf_field() }}
                      <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                              <!-- text input -->
                              
                            <!-- text input -->
                              <div class="form-group">
                                <label>Nomor Pegawai</label>
                                <input type="text" class="form-control" name="nomor_pegawai" required="required" placeholder="PG-5213">
                                @if($errors->has('nomor_pegawai'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('nomor_pegawai')}}
                                    </small>
                                @endif
                              </div>
                          
                          
                              <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" required="required">

                                @if($errors->has('nama'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('nama')}}
                                    </small>
                                @endif
                              </div>
                            
                              <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control" name="jabatan" required="required">
                                  <option value="">--Pilih--</option>
                                  <option value="1">Manager</option>
                                  <option value="2">Asisten Manager</option>
                                  <option value="3">Pengurus</option>
                                  <option value="4">Staf Lapangan</option>

                                </select>  
                                @if($errors->has('jabatan'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('jabatan')}}
                                    </small>
                                @endif                          
                              </div>

                              <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="kelamin" required="required">
                                  <option value="">--Pilih--</option>
                                  <option value="Laki - Laki">Laki - Laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                </select>  
                                @if($errors->has('kelamin'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('kelamin')}}
                                    </small>
                                @endif                          
                              </div>
                        
                          
                              <div class="form-group">
                                <label>Tanggal Lahir</label>
                              <input type="date" name="tanggal_lahir" class="form-control" required="required" value="{{date('Y-m-d')}}">                        
                              @if($errors->has('tanggal_lahir'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('tanggal_lahir')}}
                                    </small>
                                @endif 
                            </div>

                              <div class="form-group">
                                <label>Tempat Lahir</label>
                                <textarea class="form-control" name="tempat_lahir" rows="3" required="required"></textarea>
                                @if($errors->has('tempat_lahir'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('tempat_lahir')}}
                                    </small>
                                @endif
                              </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                              <div class="form-group">
                                <label>Alamat lengkap</label>
                                <textarea class="form-control" name="alamat" rows="3" required="required"></textarea>
                                @if($errors->has('alamat'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('alamat')}}
                                    </small>
                                @endif
                              </div>

                              <div class="form-group">
                                <label>Kontak</label>
                                <input type="number" class="form-control" name="kontak" placeholder="08217xxxx" required="required">
                                @if($errors->has('kontak'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('kontak')}}
                                    </small>
                                @endif
                              </div>

                              {{-- <div class="form-group">
                                <label>Hak Akses</label>
                                <select class="form-control" name="akses" required="required">
                                  <option value="">--Pilih--</option>
                                  <option value="4">Manager</option>
                                  <option value="1">Admin (Asisten Manager)</option>
                                  <option value="2">Pengurus</option>
                                </select>  
                                @if($errors->has('akses'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('akses')}}
                                    </small>
                                @endif                          
                              </div> --}}

                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Usename .." required="required">
                                @if($errors->has('username'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('username')}}
                                    </small>
                                @endif
                              </div>

                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                @if($errors->has('password'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('password')}}
                                    </small>
                                @endif
                              </div>

                            </div>
                        </div>
                         
                            <div class="float-right">
                              
                              <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">                      
                            </div>                                             
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
@endsection