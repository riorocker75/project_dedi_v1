@extends('layouts.main_app')

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Pengurus</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Pengurus</li>
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
              <h3 class="card-title">Tambah Data Pengurus</h3>
              <a href="{{url('/dashboard/admin/operator')}}" class="btn btn-danger btn-sm float-right">Kembali</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-warning">
                  <div class="card-body">
                    <form role="form" action="operator_act" method="post">
                      {{ csrf_field() }}
                      <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                              <!-- text input -->
                              <div class="form-group">
                                <label>Kode Pegawai</label>
                                <input type="text" class="form-control" name="kode_pagawai" required="required" placeholder="Nomor ....">
                              </div>
                            
                          
                              <!-- text input -->
                              <div class="form-group">
                                <label>Nomor Pengurus</label>
                                <input type="number" class="form-control" name="nomor_pegawai" required="required" placeholder="Nomor ....">
                              </div>
                          
                          
                              <div class="form-group">
                                <label>Nama Pengurus</label>
                                <input type="text" class="form-control" name="nama" required="required" placeholder="Nama ...">
                              </div>
                            
                          
                              <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="kelamin" required="required">
                                  <option value="">--Pilih--</option>
                                  <option value="Laki - Laki">Laki - Laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                </select>                            
                              </div>
                        
                          
                              <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required="required">                        
                              </div>

                              <div class="form-group">
                                <label>Tempat Lahir</label>
                                <textarea class="form-control" name="tempat_lahir" rows="3" required="required"></textarea>
                              </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                              <div class="form-group">
                                <label>Alamat lengkap</label>
                                <textarea class="form-control" name="alamat" rows="3" required="required"></textarea>
                              </div>

                              <div class="form-group">
                                <label>Kontak</label>
                                <input type="number" class="form-control" name="kontak" placeholder="08217xxxx" required="required">
                              </div>

                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Usename .." required="required">
                              </div>

                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                <p style="color: red">*input jika akan diganti</p>
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