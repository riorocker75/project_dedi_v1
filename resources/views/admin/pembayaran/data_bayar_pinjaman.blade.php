@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pembayaran Pembiayaan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pembayaran Pembiayaan</li>
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
                   
                        List Tagihan Bayaran Pembiayaan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Kode Pembiayaan</th>
                            <th>Nama</th>
                            <th>Tanggal Pembiayaan</th>  
                            <th>Jenis Pembiayaan</th>
                             <th>status</th>             
                            <th>Opsi</th>                   
                            </tr>
                        </thead>
                        <tbody> 
                           @foreach ($data as $dt)
                               @php
                                $ang= App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                                @endphp
                           <tr>
                               <td>{{$dt->pinjaman_kode}}</td>
                            <td>{{$ang->anggota_nama}}
                            <br><small class="tgl-text">NIK: {{$ang->anggota_nik}}</small>
                            </td>
                            <td>{{date('d-M-Y' , strtotime($dt->pinjaman_tgl))}}</td>
                           @php
                               $jpj=App\Model\Cat_Pinjaman::where('kategori_id' , $dt->kategori_id)->first();
                           @endphp
                            <td> {{$jpj->kategori_jenis}}
                               <br>
                            <small>Rp.&nbsp;{{number_format($dt->pinjaman_skema_angsuran)}}/minggu</small>   
                            </td>
                            <td>{{status_bayar_pinjaman($dt->status_bayar)}}</td>
                            
                           <td>
                                <a href="{{url('/admin/pembayaran/pinjaman/detail/'.$dt->pinjaman_kode.'')}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
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