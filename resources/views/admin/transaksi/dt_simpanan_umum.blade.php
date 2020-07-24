@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Transaksi Simpanan Sukarela</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi Simpanan Sukarela</li>
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
                   
                  Transaksi Simpanan Sukarela
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">

                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Transaksi</th>
                        <th>Nomor Rekening</th>
                        <th>Jenis Transaksi</th>  
                        <th>Nominal Transaksi</th>                   
                                        
                                      
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        @foreach ($data as $dt)

                        @php
                        $rv=App\Model\SimpananTransaksi::where('id',$dt->id)->first();
                         @endphp
                        <tr>
                            <td>{{$rv->kode_transaksi}}
                              <br>
                              <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($rv->tgl_transaksi)))}}</small>
                            </td>
                            <td>{{$dt->no_rekening}}</td>
                          <td>{{$rv->jenis_transaksi}}</td>
                            <td>Rp.{{number_format($rv->nominal_transaksi)}}</td>
                            <td>
                            <a href="{{url('/admin/transaksi/simpanan-umum/detail/'.$rv->kode_transaksi)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
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