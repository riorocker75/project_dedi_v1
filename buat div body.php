<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Pribadi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
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
              
            </div>
          </div>
        </section>
      
      </div>
    </div>
  </section>
</div>


<!-- buat eror -->
@if($errors->has('lama_angsur'))
<small class="text-muted text-danger">
    {{ $errors->first('lama_angsur')}}
    </small>
@endif

<div class="bingkai">
    <div class="judul-bingkai">Pengaturan Akun</div>
</div>                               
<!-- buat rupiah show -->
<input type="number" class="form-control" name="" id="format_rupiah" >
<div class="show_rupiah"></div>

->with('alert-warning','Penolakan berhasil');

<!-- buat cetak laporan -->

@extends('layouts.cetak_app')
@section('content')
<div class="cetak_laporan">

</div>
@endsection

<!-- end cetak laporan -->