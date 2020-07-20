@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Permohonan Peminjam</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Permohonan Peminjam</li>
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
                   
                   Cek data 
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    @foreach ($mohon as $cp)
                    <table id="data1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Pinjaman</th>
                          <th>Nama Peminjam</th>
  
                          <th>Jumlah Pinjaman</th>
                          <th>Skema Angsuran</th>                   
                          <th>Lama Angsuran</th>                   
                          <th>Status </th>                   
                          <th>Opsi</th>                   
                        </tr>
                      </thead>
                      <tbody> 
                          <tr>
  
                          <td>{{$cp->pinjaman_kode}}</td>
                          @php
                              $anggota= App\Model\Anggota::where('anggota_id', $cp->anggota_id)->first();
                          @endphp
                          <td>
                            {{$anggota->anggota_nama}}
                            <br>
                            NIK: {{$anggota->anggota_nik}}
                          </td>
                          
  
                          <td>Rp.{{number_format($cp->pinjaman_jumlah)}}</td>
                          <td>Rp.{{number_format($cp->pinjaman_skema_angsuran)}}/bulan</td>
                          <td>{{$cp->pinjaman_angsuran_lama}} bulan</td>
                          <td><label class="badge badge-primary">{{status_pinjaman($cp->pinjaman_status)}}</label></td>
                          <td>
                          <a href="{{url('/admin/cek-mohon/'.$cp->id.'')}}"> <i class="fa fa-eye" aria-hidden="true" ></i></a>
                          </td>
  
                          </tr>
                      </tbody>   
                  </table> 
                   @endforeach
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection