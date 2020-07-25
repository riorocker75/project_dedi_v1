@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Verifikasi Lanjutan Anggota</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Verifikasi Lanjutan Anggota</li>
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
                   
                 List Data
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Anggota</th>
                            <th>Kode Syarat</th>
                            <th>Keterangan</th>  
                            <th>Status</th>                 
                            <th>Opsi</th>                   
                            </tr>
                        </thead>
                        <tbody> 
                         @foreach ($data as $dt)
                         @php
                         $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                         @endphp
                             <tr>
                             
                                <td>{{$ang->anggota_nama}}
                                    <br>
                                    <small class="tgl-text">{{$ang->anggota_kode}}</small>
                                </td>
                                <td>{{$dt->kode_syarat}}
                                  <br>
                                  <small class="tgl-text">
                                    {{format_tanggal(date('Y-m-d',strtotime($ang->tgl_gabung)))}}  
                                  </small>
                                 </td>
                                
                                <td>{{$dt->ket_syarat}}</td>
                                <td><label class="badge badge-warning">Menunggu Verifikasi</label></td>
                                <td>
                                <a href="{{url('/operator/verifikasi/anggota/detail/'.$dt->id)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                                <a href="{{url('/operator/verifikasi/anggota/hapus/'.$dt->id)}}" style="padding:0 7px" onclick="return confirm('Apa anda yakin menghapus data ini ?')"> <i class="fa fa-trash"></i></a>

                                </td>
                             </tr>
                             @endforeach
                    
                        </tbody>   
                    </table>
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection