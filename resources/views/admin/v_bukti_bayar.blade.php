@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Bukti Bayar</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Bukti Bayar</li>
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
                   
                  Data Bukti Bayar
                  </h3>
                  <div class="card-tools">
                    <div class="float-right">
                        {{-- <a class="btn btn-default" data-toggle="collapse" href="#simpanan">
                            <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                        </a> --}}
                    </div>
                  </div>
                </div>
                <div class="card-body ">
                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Kode Transaksi</th>
                            <th>Nomor Rekening</th>  
                            <th>Nominal Transfer</th>
                            <th>Keterangan</th> 
                            <th>Status</th>                 


                            <th>Opsi</th>                   
                            </tr>
                        </thead>
                        <tbody> 
                           @foreach ($data as $dt)
                               
                             <tr>
                                <td>{{$dt->kode_transaksi}}
                                    <br>
                                    <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($dt->tgl_upload)))}}</small>
                                </td>
                                
                                <td>{{$dt->no_rekening}}</td>
                                <td>Rp.{{number_format($dt->nominal)}}</td>

                              <td>{{$dt->ket_upload}}</td>
                              <td><label class="badge badge-warning">menunggu konfirmasi</label></td>

                                <td>
                                    {{ link_bukti_bayar($dt->jenis_upload, $dt->no_rekening)}}
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