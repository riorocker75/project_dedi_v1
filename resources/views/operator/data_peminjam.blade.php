@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pengaju Pembiayaan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pembiayaan</li>
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
                   
                  List data pengaju
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                  @if (count($data_aju) > 0)

                    
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
                          @foreach ($data_aju as $cp)
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
                            <td>Rp.{{number_format($cp->pinjaman_skema_angsuran)}}/minggu</td>
                            <td>{{$cp->pinjaman_angsuran_lama}} bulan</td>
                            <td><label class="badge badge-primary">{{status_pinjaman($cp->pinjaman_status)}}</label></td>
                            <td>
                            <a href="{{url('/operator/review-pinjaman/'.$cp->id.'')}}"> <i class="fa fa-eye" aria-hidden="true" ></i></a>
                            </td>

                            </tr>
                    @endforeach

                        </tbody>   
                    </table> 
                 @else
                  Belum ada anggota yang mengajukan pembiayaan ....
                      
                 @endif
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
@endsection