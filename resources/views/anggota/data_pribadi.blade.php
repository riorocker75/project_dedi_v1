@extends('layouts.main_app')

@section('content')

@foreach ($pribadi as $pr)
<div class="content-wrapper">
<div class="content-header">
  <div class="col-lg-12">
    
   
  </div>
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Pribadi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
            <li class="breadcrumb-item active">Data Pribadi</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
      
      <?php
      if($pr->status_pinjaman == 0){
      ?>
     <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan!!</h5>
      Harap Melakukan Pembayaran Uang Pendaftaran dan Upload Peryaratan Segera!! <a href="{{url('/anggota/verifikasi/bayar')}}">&nbsp;disini</a>
      <br>
      Agar Anda Bisa melakukan Pembiayaan
    </div>
      <?php }else{?>
  
      <?php } ?>

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
            <form role="form" action="/anggota/data-pribadi-update/{{$pr->anggota_kode}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nomot Induk Kependudukan (NIK)</label>
                          {{-- <input type="hidden" class="form-control" name="id" value="{{ $pr->anggota_id }}"> --}}
                          <input type="number" class="form-control" name="nik" value="{{ $pr->anggota_nik }}">
                        </div>
                      </div>
                      @if($errors->has('nik'))
                      <div class="text-danger">
                          {{ $errors->first('nik')}}
                      </div>
                      @endif
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>NAMA</label>
                          <input type="text" class="form-control" name="nama" value="{{ $pr->anggota_nama }}">
                        </div>
                      </div>

                      @if($errors->has('nama'))
                      <div class="text-danger">
                          {{ $errors->first('nama')}}
                      </div>
                      @endif

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>JENIS KELAMIN</label>
                          <input type="text" class="form-control" value="{{ ucfirst($pr->anggota_kelamin) }}" disabled>
                                                     
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>TANGGAL LAHIR</label>
                          <input type="date" name="tanggal_lahir" class="form-control" value="<?php if($pr->anggota_tanggal_lahir == ""){echo date('Y-m-d');}else{echo date('Y-m-d', strtotime($pr->anggota_tanggal_lahir));}?>">                        
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
                          <textarea class="form-control" name="tempat_lahir" rows="2">{{$pr->anggota_tempat_lahir}}</textarea>
                        </div>
                      </div>
                      @if($errors->has('tempat_lahir'))
                      <div class="text-danger">
                          {{ $errors->first('tempat_lahir')}}
                      </div>
                      @endif
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>ALAMAT KTP</label>
                          <textarea class="form-control" name="alamat_ktp" rows="2">{{$pr->anggota_alamat_ktp}}</textarea>
                        </div>
                      </div>
                      @if($errors->has('alamat_ktp'))
                      <div class="text-danger">
                          {{ $errors->first('alamat_ktp')}}
                      </div>
                      @endif
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>KONTAK</label>
                          <input type="number" class="form-control" name="kontak" value="{{ $pr->anggota_kontak }}">
                        </div>
                      </div> 
                      @if($errors->has('kontak'))
                      <div class="text-danger">
                          {{ $errors->first('kontak')}}
                      </div>
                      @endif
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>PEKERJAAN</label>
                          <select class="form-control" name="pekerjaan" required="required">
                            @php
                            $kerja = \App\Model\Pekerjaan::all();
                            $kerjax= \App\Model\Pekerjaan::where('id',$pr->anggota_pekerjaan)->first();
                           @endphp
                          
                          <option value="{{ $pr->anggota_pekerjaan}}" selected hidden>{{$kerjax->pekerjaan}}</option>
                          @foreach ($kerja as $kj)
                             <option value="{{$kj->id}}">{{$kj->pekerjaan}}</option>
                           @endforeach
                          </select> 
                       
                         @if($errors->has('pekerjaan'))
                              <div class="text-danger">
                                  {{ $errors->first('pekerjaan')}}
                              </div>
                          @endif
                        </div>
                      </div>

                     
                    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>ALAMAT SEKARANG</label>
                          <textarea class="form-control" name="alamat_sekarang" rows="2" >{{$pr->anggota_alamat_sekarang}}</textarea>
                        </div>
                      </div> 
                      @if($errors->has('alamat_sekarang'))
                      <div class="text-danger">
                          {{ $errors->first('alamat_sekarang')}}
                      </div>
                      @endif   
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Gaji/bulan</label>
                          <input type="number" class="form-control" name="gaji" value="{{ $pr->anggota_gaji }}">
                        </div>
                        @if($errors->has('gaji'))
                        <div class="text-danger">
                            {{ $errors->first('gaji')}}
                        </div>
                        @endif  
                      </div> 

                    
                    </div>  
                    
                    
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