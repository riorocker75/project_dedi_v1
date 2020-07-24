@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">List Pembayaran Simpanan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">List Pembayaran Simpanan</li>
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
                   
                  List Simpanan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <a href="{{url('/admin/pembayaran/simpanan-umum')}}" class="btn btn-default">Simpanan Sukarela &nbsp;<i class="fa fa-arrow-right"></i></a>
                    <br>
                    <br>
                <a href="{{url('/admin/pembayaran/simpanan-deposit')}}" class="btn btn-default">Simpanan Berjangka &nbsp;<i class="fa fa-arrow-right"></i></a>
                    <br>
                    <br>
                <a href="{{url('/admin/pembayaran/simpanan-umroh')}}" class="btn btn-default">Simpanan Umroh &nbsp;<i class="fa fa-arrow-right"></i></a>
                    <br>
                    <br>
                <a href="{{url('/admin/pembayaran/simpanan-pendidikan')}}" class="btn btn-default">Simpanan Pendidikan &nbsp;<i class="fa fa-arrow-right"></i></a>

                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
    
@endsection