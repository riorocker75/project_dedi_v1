@extends('layouts.main_app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">List Produk Simpanan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/dashboard/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">List Produk Simpanan</li>
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
              <h3 class="card-title">List Produk Simpanan</h3>
              
              <!-- <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#kat_tambah">Tambah</button> -->
        
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a href="{{url('/admin/pengaturan/simpanan-umum')}}" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Pengaturan Simpanan Sukarela</a>
                <br>
                <br>
               <a href="{{url('/admin/pengaturan/simpanan-deposit')}}" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Pengaturan Simpanan Berjangka</a>
                  <br>
                  <br>
              <a href="{{url('/admin/pengaturan/simpanan-umroh')}}" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Pengaturan Simpanan Umroh</a>
                  <br>
                  <br>
              <a href="{{url('/admin/pengaturan/simpanan-pendidikan')}}" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Pengaturan Simpanan Pendidikan</a>
              <br>
              <br>
          </div>
       </div>
      </div>

    </div>
  </div>
</section>
</div>

@endsection
