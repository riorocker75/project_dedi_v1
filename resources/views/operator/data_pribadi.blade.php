@extends('layouts.main_app')

@section('content')

@foreach ($pribadi as $pr)
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Pribadi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
            <li class="breadcrumb-item active">Data Pribadi</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
     
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
               Ubah Data
              </h3>
              <div class="card-tools">
               
              </div>
            </div>
            <div class="card-body">
            <form role="form" action="/operator/data-pribadi-update/{{$pr->operator_id}}" method="post">
                    {{ csrf_field() }}

                    <div class="row">
                     <div class="col-lg-6 col-md-12 col-12">
                           <!-- text input -->
                           <div class="form-group">
                            <label>Nomor Pegawai</label>
                            {{-- <input type="hidden" class="form-control" name="id" value="{{ $pr->operator_id }}"> --}}
                            <input type="number" class="form-control" value="{{ $pr->operator_nomor_pegawai }}" disabled>
                          </div>
                     
                       
                          <!-- text input -->
                          <div class="form-group">
                            <label>NAMA</label>
                            <input type="text" class="form-control" name="nama" value="{{ $pr->operator_nama }}">
                          </div>
                          @if($errors->has('nama'))
                          <div class="text-danger">
                              {{ $errors->first('nama')}}
                          </div>
                          @endif
                       
                          <div class="form-group">
                            <label>JENIS KELAMIN</label>
                            <input type="text" class="form-control" value="{{ ucfirst($pr->operator_kelamin) }}" disabled>
                                                       
                          </div>
                    
                        
                          <div class="form-group">
                            <label>TANGGAL LAHIR</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?php if($pr->operator_tanggal_lahir == ""){echo date('Y-m-d');}else{echo $pr->operator_tanggal_lahir;}?>">                        
                          </div>
                          @if($errors->has('tanggal_lahir'))
                          <div class="text-danger">
                              {{ $errors->first('tanggal_lahir')}}
                          </div>
                          @endif
                     </div>
                    </div>
                  
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>TEMPAT LAHIR</label>
                          <textarea class="form-control" name="tempat_lahir" rows="2">{{$pr->operator_tempat_lahir}}</textarea>
                        </div>
                      </div>
                      @if($errors->has('tempat_lahir'))
                      <div class="text-danger">
                          {{ $errors->first('tempat_lahir')}}
                      </div>
                      @endif
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>KONTAK</label>
                          <input type="number" class="form-control" name="kontak" value="{{ $pr->operator_kontak }}">
                        </div>
                      </div> 
                      
                      @if($errors->has('kontak'))
                      <div class="text-danger">
                          {{ $errors->first('kontak')}}
                      </div>
                      @endif                  
                    </div> 


                      
                    <div class="row">
                        <div class="col-sm-6">
                          <!-- textarea -->
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $pr->operator_username }}">
                          </div>
                        </div>
                      </div>
                      @if($errors->has('username'))
                      <div class="text-danger">
                          {{ $errors->first('username')}}
                      </div>
                      @endif
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="new-password">
                            <span style="color:red">*kosongkan jika tidak ingin merubah password</span>
                          </div>
                        </div> 
                      </div> 
                      @if($errors->has('password'))
                      <div class="text-danger">
                          {{ $errors->first('password')}}
                      </div>
                      @endif
                    
                    
                    <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">                      
                  </form>
            </div>
          </div>
        </section>
      
      </div>
    </div>
  </section>
</div>
   @endforeach 
@endsection