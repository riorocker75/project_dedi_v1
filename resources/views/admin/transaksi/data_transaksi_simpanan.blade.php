@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Transaksi Simpanan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi Simpanan</li>
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
                   
                  List Transaksi Simpanan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                <a href="{{url('/admin/transaksi/simpanan-umum')}}" class="btn btn-default">Transaksi Simpanan Sukarela &nbsp;<i class="fa fa-arrow-right"></i></a>
                    <br>
                    <br>
                <a href="{{url('/admin/transaksi/simpanan-berjangka')}}" class="btn btn-default">Transaksi Simpanan Berjangka &nbsp;<i class="fa fa-arrow-right"></i></a>
                    <br>
                    <br>
                <a href="{{url('/admin/transaksi/simpanan-umroh')}}" class="btn btn-default">Transaksi Simpanan Umroh &nbsp;<i class="fa fa-arrow-right"></i></a>
                    <br>
                    <br>
                <a href="{{url('/admin/transaksi/simpanan-pendidikan')}}" class="btn btn-default">Transaksi Simpanan Pendidikan &nbsp;<i class="fa fa-arrow-right"></i></a>

                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
    
@endsection