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
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                 Simpanan Sukarela
                  </h3>
                  <div class="card-tools">
                   <a data-toggle="collapse" href="#sim_umum" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                  </div>
                </div>
                <div class="card-body collapse " id="sim_umum">

                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        
                        <th>Nomor Rekening</th>
                        <th>Status</th>                   
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        @php
                            $data_umum =App\Model\Simpanan::where('anggota_id',Session::get('ang_id'))->get();
                        @endphp
                        @foreach ($data_umum as $du)
                            
                        <tr>
                            <td>{{$du->no_rekening}}</td>
                            <td>{{cek_status_simpanan($du->status)}}</td>
                        
                            <td>
                            <a href="{{url('/anggota/simpanan-umum/transaksi/'.$du->no_rekening)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
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
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Simpanan Berjangka 
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_deposit" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                   
                  </div>
                </div>
                <div class="card-body collapse" id="sim_deposit">

                  <table id="data2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nomor Rekening</th>
                        <th>Status</th>                   
                        <th>Opsi</th>            
                    
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        @php
                        $data_deposit =App\Model\Simpanan\SimpananBerjangka::where('anggota_id',Session::get('ang_id'))->get();
                       @endphp
                        @foreach ($data_deposit as $dp)
                        <tr>
                            <td>{{$dp->rekening_deposit}}</td>
                            <td>{{cek_status_simpanan($dp->status)}}</td>
                            <td>
                            <a href="{{url('/anggota/simpanan-deposit/transaksi/'.$dp->rekening_deposit)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

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
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                 Simpanan Umroh
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_umroh" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                   
                  </div>
                </div>
                <div class="card-body collapse" id="sim_umroh">

                  <table id="data3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nomor Rekening</th>
                        <th>Status</th>                   
                        <th>Opsi</th>                  
                      </tr>
                    </thead>
                    <tbody> 
                        
                       {{-- data 1 --}}
                       @php
                       $data_umroh =App\Model\Simpanan\SimpananUmroh::where('anggota_id',Session::get('ang_id'))->get();
                      @endphp
                       @foreach ($data_umroh as $dm)
                       <tr>
                           <td>{{$dm->no_rekening}}</td>
                           <td>{{cek_status_simpanan($dm->status)}}</td>
                          
                           <td>
                           <a href="{{url('/anggota/simpanan-umroh/transaksi/'.$dm->no_rekening)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                           </td>
                       </tr>
                       @endforeach

                      
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
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Simpanan Pendidikan
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_pendidikan" class="btn btn-default"> Tampilkan <i class="fa fa-eye" aria-hidden="true"></i></a>
                   
                  </div>
                </div>
                <div class="card-body collapse" id="sim_pendidikan">

                  <table id="data4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nomor Rekening</th>
                        <th>Status</th>                   
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        @php
                        $data_pendidikan =App\Model\Simpanan\SimpananPendidikan::where('anggota_id',Session::get('ang_id'))->get();
                       @endphp
                        @foreach ($data_pendidikan as $dpn)
                        <tr>
                          <td>{{$dpn->no_rekening}}</td>
                          <td>{{cek_status_simpanan($dpn->status)}}</td>
                         
                          <td>
                          <a href="{{url('/anggota/simpanan-pendidikan/transaksi/'.$dpn->no_rekening)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                          </td>
                        </tr>
                        @endforeach

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