@extends('layouts.main_app')

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Operator</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Operator</li>
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
              <h3 class="card-title">Edit Data Operator</h3>
              <a href="operator" class="btn btn-danger btn-sm float-right">Kembali</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-warning">
                  <div class="card-body">
                    @foreach($operator as $o)
                    <form action="{{url('/dashboard/admin/operator_update/'.$o->operator_id)}}" method="post">
                    {{-- <form action="operator_update/{{$o->operator_id}}" method="post"> --}}
                      {{ csrf_field() }}
                      <div class="row">
                      
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Nomor Pengurus</label>
                            <input type="number" class="form-control" name="nomor_pegawai" value="{{ $o->operator_nomor_pegawai }}" required>
                            @if($errors->has('nomor_pegawai'))
                            <small class="text-muted text-danger">
                                {{ $errors->first('nomor_pegawai')}}
                                </small>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Nama Operator</label>
                            <input type="text" class="form-control" name="nama" value="{{ $o->operator_nama }}" required>
                            @if($errors->has('nama'))
                            <small class="text-muted text-danger">
                                {{ $errors->first('nama')}}
                                </small>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="kelamin" required="required">
                            <option value="{{$o->operator_kelamin}}" selected hidden>{{$o->operator_kelamin}}</option>
                              <option value="Laki - Laki">Laki - Laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>                            
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Tanggal lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{date('Y-m-d',strtotime($o->operator_tanggal_lahir))}}" required>                        
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <!-- textarea -->
                          <div class="form-group">
                            <label>Tempat Lahir</label>
                            <textarea class="form-control" name="tempat_lahir" rows="3" required>{{$o->operator_tempat_lahir}}</textarea>
                          </div>
                        </div>
                         <div class="col-sm-6">
                          <!-- textarea -->
                          <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="3" required>{{$o->operator_alamat}}</textarea>
                          </div>
                        </div>                        
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Kontak</label>
                            <input type="number" class="form-control" name="kontak" value="{{ $o->operator_kontak }}" required>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $o->operator_username }}" required>
                            @if($errors->has('username'))
                            <small class="text-muted text-danger">
                                {{ $errors->first('username')}}
                                </small>
                            @endif
                          </div>
                        </div> 
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                            <p style="color: red">*input jika akan diganti</p>
                            @if($errors->has('password'))
                            <small class="text-muted text-danger">
                                {{ $errors->first('password')}}
                                </small>
                            @endif
                          </div>
                        </div>
                      </div>                                                          
                        <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">                      
                    </form>
                    @endforeach
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