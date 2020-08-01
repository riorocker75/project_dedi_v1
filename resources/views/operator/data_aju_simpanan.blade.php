@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pengaju Simpanan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pengaju</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
             {{--
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   @php
                       $tot_umum = App\Model\Simpanan::where('status', 0)->get();
                   @endphp
                    Simpanan Sukarela <label class="badge badge-success">{{count($tot_umum)}}</label>
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_umum" class="btn btn-default"> Selengkapnya <i class="fa fa-chevron-circle-down"></i></a>
                 
                  </div>
                </div>
                <div class="card-body collapse" id="sim_umum">
                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Nama & NIK</th>

                        <th>Nominal Pengajuan</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                       
                        @php
                            $sim_umum =App\Model\Simpanan::where('status', 0)->get();
                        @endphp

                        @foreach ($sim_umum as $su)
                        <tr>
                          @php
                            $ang_umum = App\Model\Anggota::where('anggota_id',$su->anggota_id)->first();
                          @endphp
                          <td>{{$ang_umum->anggota_kode}}
                            <br>
                          <small class="tgl-text">Pengajuan: {{format_tanggal(date('Y-m-d', strtotime($su->tgl_buka_rek)))}}</small>
                          </td>
                          <td>
                            {{$ang_umum->anggota_nama}}
                            <br>
                            NIK: {{$ang_umum->anggota_nik}}
                          </td>
                          <td>Rp.{{number_format($su->total_simpanan)}}</td>
                          <td><label class="badge badge-warning">menuggu konfirmasi</label></td>
                          <td>
                          <a href="{{url('/operator/detail/aju/simpanan-umum/'.$su->no_rekening)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                          </td>
                        </tr>
                        @endforeach


                    </tbody>   
                </table>
                </div>
              </div>
            </section> --}}

            {{-- end simpanan sukarela --}}

            {{-- start simpanan berjangka --}}
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    @php
                    $tot_depo = App\Model\Simpanan\SimpananBerjangka::where('status', 0)->get();
                   @endphp
                  Simpanan Berjangka <label class="badge badge-success">{{count($tot_depo)}}</label>
                   
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_depo" class="btn btn-default"> Selengkapnya <i class="fa fa-chevron-circle-down"></i></a>
                  </div>
                </div>
                <div class="card-body collapse" id="sim_depo">
                  <table id="data2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Nominal Simpanan</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}

                        @php
                        $sim_deposit =App\Model\Simpanan\SimpananBerjangka::where('status', 0)->get();
                         @endphp
                             
                         @foreach ($sim_deposit as $sd)
                         @php
                         $ang_depo = App\Model\Anggota::where('anggota_id',$sd->anggota_id)->first();
                         @endphp
                        <tr>
                            <td>{{ $ang_depo->anggota_kode}}
                              <br>
                              <small class="tgl-text">{{format_tanggal(date('Y-m-d',strtotime($sd->tgl_deposit)))}}</small>
                            </td>
                            <td>Rp.{{number_format($sd->nilai_deposit)}}</td>
                            <td><label class="badge badge-warning">menuggu konfirmasi</label></td>

                            <td>
                            <a href="{{url('/operator/detail/aju/simpanan-deposit/'.$sd->rekening_deposit)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>   
                </table>
                </div>
              </div>
            </section>
            {{-- end simpanan berjangka --}}


            {{-- start simpanan umroh --}}
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    @php
                    $tot_umroh = App\Model\Simpanan\SimpananUmroh::where('status', 0)->get();
                   @endphp
                  Simpanan Umroh <label class="badge badge-success">{{count($tot_umroh)}}</label>
                   
                    
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_umroh" class="btn btn-default"> Selengkapnya <i class="fa fa-chevron-circle-down"></i></a>
                  
                  </div>
                </div>
                <div class="card-body collapse" id="sim_umroh">
                  <table id="data3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Jenis Simpanan</th> 
                        <th>Setoran perbulan</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        @php
                         $sim_umroh =App\Model\Simpanan\SimpananUmroh::where('status', 0)->get();
                         @endphp
                             
                         @foreach ($sim_umroh as $sh)
                         @php
                         $ang_umroh = App\Model\Anggota::where('anggota_id',$sh->anggota_id)->first();
                         $ops_umroh=App\Model\Simpanan\OpsiSimpananLain::where('id',$sh->opsi_simpanan_lain_id)->first();
                         @endphp
                            
                        <tr>
                          <td>{{$ang_umroh->anggota_kode}}
                            <br>
                            <small class="tgl-text">{{format_tanggal(date('Y-m-d',strtotime($sh->tgl_mulai)))}}</small>
                          </td>
                        <td>{{$ops_umroh->jenis_simpanan}} 
                          <br>
                          <small class="tgl-text">Tenor:{{$sh->jangka_umroh}} tahun</small> 
                        </td>
                          <td>Rp.{{number_format($sh->angsuran_umroh)}}</td>
                          <td><label class="badge badge-warning">menuggu konfirmasi</label></td>
                          <td>
                            <a href="{{url('/operator/detail/aju/simpanan-umroh/'.$sh->no_rekening)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>   
                </table>
                </div>
              </div>
            </section>
            {{-- end simpanan umroh  --}}

            {{-- start simpanan pendidikan --}}
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    @php
                    $tot_pend = App\Model\Simpanan\SimpananPendidikan::where('status', 0)->get();
                   @endphp
                   Simpanan Pendidikan <label class="badge badge-success">{{count($tot_pend)}}</label>
                   
                   
                  </h3>
                  <div class="card-tools">
                    <a data-toggle="collapse" href="#sim_pend" class="btn btn-default"> Selengkapnya <i class="fa fa-chevron-circle-down"></i></a>
                 
                  </div>
                </div>
                <div class="card-body collapse" id="sim_pend">
                  <table id="data4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Jenis Simpanan Pendidikan</th> 
                        <th>Setoran perbulan</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                      @php
                      $sim_pend =App\Model\Simpanan\SimpananPendidikan::where('status', 0)->get();
                      @endphp
                          
                      @foreach ($sim_pend as $sp)
                      @php
                      $ang_pend = App\Model\Anggota::where('anggota_id',$sp->anggota_id)->first();
                      $ops_pend=App\Model\Simpanan\OpsiSimpananLain::where('id',$sp->opsi_simpanan_lain_id)->first();
                      @endphp
                        {{-- data 1 --}}
                        <tr>
                          <td>{{$ang_pend->anggota_kode}}
                            <br>
                            <small class="tgl-text">{{format_tanggal(date('Y-m-d',strtotime($sp->tgl_mulai)))}}</small>
                          </td>
                        <td>{{$ops_pend->jenis_simpanan}} 
                          <br>
                          <small class="tgl-text">Tenor:{{$sp->jangka_pend}} tahun</small> 
                        </td>
                          <td>Rp.{{number_format($sp->angsuran_pend)}}</td>
                          <td><label class="badge badge-warning">menuggu konfirmasi</label></td>
                          <td>
                            <a href="{{url('/operator/detail/aju/simpanan-pendidikan/'.$sp->no_rekening)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                          </td>
                        </tr>
                       @endforeach 
                    </tbody>   
                </table>
                </div>
              </div>
            </section>

            {{-- end simpanan pendidikan --}}
          </div>
        </div>
      </section>
    </div>
    
@endsection