@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pengajuan Menjadi Anggota</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pengajuan</li>
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
                   
                  List data pengajuan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <?php $no=1;?>
                    @if (count($data_mohon) > 0)
                   
                            
                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
    
                            <th>NIK</th>
                            <th>Alamat</th>                   
                            <th>Kontak</th>                   
                            <th>Pekerjaan</th>
                            <th>Status</th>
                            <th>Opsi</th>                   
                          </tr>
                        </thead>
                        <tbody> 
                          @foreach ($data_mohon as $dm)
                            <tr>
    
                            <td>{{$no++}}</td>
                          
                            <td>{{$dm->anggota_nama}} </td>
                            <td>
                                {{$dm->anggota_nik}}
                            </td>
                             <td>{{$dm->anggota_alamat_ktp}}</td>
                             <td>{{$dm->anggota_kontak}}</td>
                             @php
                                 $kerja=App\Model\Pekerjaan::where('id', $dm->anggota_pekerjaan)->first();
                             @endphp
                             <td>{{$kerja->pekerjaan}}</td>

                            <td><label class="badge badge-primary">{{status_anggota($dm->status)}}</label></td>
                            <td>
                            <a href="{{url('/admin/detail/anggota-mohon/'.$dm->anggota_id.'')}}"> <i class="fa fa-eye" aria-hidden="true" ></i></a>
                            </td>
    
                            </tr>
                       @endforeach

                        </tbody>   
                    </table>
                   
                    @else
                        Belum ada anggota baru mendaftar ....
                    @endif
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection