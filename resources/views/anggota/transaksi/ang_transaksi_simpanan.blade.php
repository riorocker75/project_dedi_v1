@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Transaksi Simpanan </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi Simpanan </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         @php
             $ang=App\Model\Anggota::where('anggota_id',Session::get('ang_id'))->first();

         @endphp

          <div class="row">
            @if ($ang->status_simpanan == 1)
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Transaksi Simpanan Sukarela
                  </h3>
                  <div class="card-tools">
                   <a data-toggle="collapse" href="#sim_umum" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                  </div>
                </div>
                <div class="card-body collapse " id="sim_umum">

                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Transaksi</th>
                        <th>Nomor Rekening</th>
                        <th>Jenis Transaksi</th>  
                        <th>Nominal Transaksi</th>                   
                        {{-- <th>Opsi</th>--}}
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        @foreach ($data_umum as $du)
                            
                        <tr>
                            <td>{{$du->kode_transaksi}}
                              <br>
                              <small class="tgl-text">{{$du->tgl_transaksi}}</small>
                            </td>
                          <td>{{$du->no_rekening}}</td>
                            <td>{{$du->$jenis_transaksi}}</td>
                            <td>Rp{{number_format($du->nominal_transaksi)}}</td>
                            {{-- <td>
                            <a href="{{}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td> --}}
                        </tr>
                        @endforeach

                      
                    </tbody>   
                </table> 
                </div>
              </div>
            </section>
            @else
            <div class="col-lg-12 balok">
              Belum ada pengajuan <b>Simpanan Sukarela</b>, ajukan ke Koperasi langsung atau klik&nbsp;<a href="{{url('/anggota/ajukan/simpanan-umum')}}">di sini</a> &nbsp;
            </div>
             <br>
            @endif

            {{-- bagian simpanan deposit Transaksi --}}
            @if ($ang->status_deposit == 1)
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Transaksi Simpanan Berjangka 
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_deposit" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                   
                  </div>
                </div>
                <div class="card-body collapse" id="sim_deposit">

                  <table id="data2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Transaksi</th>
                        <th>Nomor Rekening</th>
                        <th>Jenis Transaksi</th>  
                        <th>Nominal Deposit</th>                   
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>TRSU-6555
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>886539</td>
                            <td>Simpanan Sukarela</td>
                            <td>Rp.200.000</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>


                    </tbody>   
                </table> 
                </div>
              </div>
            </section>
            @else
            <div class="col-lg-12 balok">
              Belum ada pengajuan <b>Simpanan Berjangka</b>, ajukan ke Koperasi langsung atau klik&nbsp;<a href="{{url('/anggota/ajukan/simpanan-deposit')}}">di sini</a> &nbsp;
            </div>
             <br>
            @endif


            {{-- bagian simpanan umroh transaksi --}}

            @if ($ang->status_umroh == 1)
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Transaksi Simpanan Umroh
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_umroh" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                   
                  </div>
                </div>
                <div class="card-body collapse" id="sim_umroh">

                  <table id="data3" class="table table-bordered table-striped">
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
                        <tr>
                            <td>TRSU-6555
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>886539</td>
                            <td>Simpanan Sukarela</td>
                            <td>Rp.200.000</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                      
                    </tbody>   
                </table> 
                </div>
              </div>
            </section>
            @else
            <div class="col-lg-12 balok">
              Belum ada pengajuan <b>Simpanan Umroh</b>, ajukan ke Koperasi langsung atau klik&nbsp;<a href="{{url('/anggota/ajukan/simpanan-umroh')}}">di sini</a> &nbsp;
            </div>
             <br>
            @endif
            

            {{-- bagian simpanan pendidikan transaksi --}}

            @if ($ang->status_pendidikan == 1)
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Transaksi Simpanan Pendidikan
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_pendidikan" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                   
                  </div>
                </div>
                <div class="card-body collapse" id="sim_pendidikan">

                  <table id="data4" class="table table-bordered table-striped">
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
                        <tr>
                            <td>TRSU-6555
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>886539</td>
                            <td>Simpanan Pendidikan</td>
                            <td>Rp.200.000</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                    </tbody>   
                </table> 
                </div>
              </div>
            </section>
            @else
            <div class="col-lg-12 balok">
              Belum ada pengajuan <b>Simpanan Pendidikan</b>, ajukan ke Koperasi langsung atau klik&nbsp;<a href="{{url('/anggota/ajukan/simpanan-pendidikan')}}">di sini</a> &nbsp;
            </div>
             <br>
            @endif

            {{-- end transaksi --}}
          </div>
        </div>
      </section>
    </div>
    
    
@endsection