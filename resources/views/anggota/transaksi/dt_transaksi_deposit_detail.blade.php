@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Detail Simpanan Berjangka </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Simpanan Berjangka</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">


            
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                @foreach ($data_sim as $ds)
                    
                <div class="card-header">
                  <h3 class="card-title">
                   
                   Detail Simpanan <b>{{$ds->rekening_deposit}}</b> 
                  </h3>
                  <div class="card-tools">
                    <div class="float-right">
                      <a href="{{url('/anggota/simpanan-deposit/tarik/'.$ds->rekening_deposit)}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Tarik Dana</a>

                     </div>
                  </div>
                </div>

                @php
                    $ops=App\Model\Simpanan\OpsiSimpananBerjangka::where('id',$ds->opsi_deposit_id)->first();
                     $tempo= date('Y-m-d', strtotime("+$ds->jangka_deposit  months", strtotime($ds->tgl_deposit)));

                   
                @endphp
                <div class="card-body">
                    <div class="form-group">
                      <label for="">Nomor Rekening</label>
                    <input type="text" class="form-control" value="{{$ds->rekening_deposit}}" disabled>
                    </div>

                    <div class="form-group">
                      <label for="">Tanggal Memulai Simpanan</label>
                    <input type="text" class="form-control" value="{{format_tanggal(date('Y-m-d', strtotime($ds->tgl_deposit)))}}" disabled>
                    </div>

                

                    <div class="form-group">
                      <label for="">Jangka Simpanan</label>
                    <input type="text" class="form-control" value="{{$ds->jangka_deposit}} bulan" disabled>
                    </div>

                    <div class="form-group">
                      <label for=""> Nisbah {{$ds->jangka_deposit}}bulan (%)</label></label>
                    <input type="text" class="form-control" value="{{$ops->bunga_deposit}}%" disabled>
                    </div>

                    <div class="form-group">
                    <label for="">Bagi Hasil Perbulan</label>
                    <input type="text" class="form-control" value="Rp.{{number_format($ops->nisbah_bulan)}}" disabled>
                    </div>

                    <div class="form-group">
                      <label for="">Jatuh Tempo Pada</label>
                    <input type="text" class="form-control" value="{{format_tanggal(date('Y-m-d', strtotime($tempo)))}}" disabled>
                    </div>


                </div>
                @endforeach

              </div>
            </section>

          <div class="col-lg-6 col-md-12 col-12">
              <div class="row">
                <div class="col-lg-12 col-6">
                  <div class="small-box bg-success">
                    <div class="inner">
                      @php
                          $tot_sim= $ds->nilai_deposit + $ds->total_nisbah;
                      @endphp
                        <h3>
                          Rp. {{number_format($tot_sim)}}
                        </h3>
                        <p>
                          Total Saldo Simpanan + Nisbah
                        </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-dollar-sign"></i>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                  
                      <h3>
                        Rp. {{number_format($ds->total_nisbah)}}
                      </h3>
                      <p>
                        Nisbah Yang Telah Dibagi
                      </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-credit-card"></i>
                  </div>
                </div>
              </div>

              </div>

              </div>
          </div>  
        
          


            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                   History Transaksi <b>{{$ds->rekening_deposit}}</b> 
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                   {{-- start cetak transaksi --}}
                   @if(count($data) > 0)
                   <form action="{{url('/cetak/transaksi/simpanan/deposit/filter/'.$ds->rekening_deposit)}}" method="post" target="__blank">
                     @csrf
                     <div class="row">
                         <div class="col-lg-3 col-md-6 col-12">
                             <div class="form-group">
                                 <label for="">Dari Tanggal</label>
                                <input type="date" class="form-control" name="dari" id="dari" value="{{date('Y-m-d', strtotime('first day of january this year'))}}">
                               </div> 
                         </div>
                         <div class="col-lg-3 col-md-6 col-12">
                             <div class="form-group">
                                 <label for="">Sampai Tanggal</label>
                                 <input type="date" class="form-control" name="sampai" id="sampai" value="{{date('Y-m-d')}}">
     
                               </div> 
                         </div>
                      
                       <button type="submit" style="margin-top:32px;margin-bottom:20px" 
                         class="btn btn-outline-primary float-right">
                         Print &nbsp;
                         <i class="fa fa-print"></i>
                         </button>
                     </div>
                   </form>
                   @endif

                   {{-- end cetak transaksi --}}

                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Kode Transaksi</th>
                        <th>Jenis Transaksi</th> 
                        <th>Keterangan</th>  
                        <th>Nominal Transaksi</th>  
           
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($data as $dt)
                         <tr>
                            <td>{{$dt->kode_transaksi}}
                                <br>
                                <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($dt->tgl_transaksi)))}}</small>
                            </td>
                            
                            <td>{{$dt->jenis_transaksi}}</td>
                            <td>{{$dt->ket_transaksi}}</td>
                            <td>
                                <?php if($dt->status == 1){?>
                                    <div style="color:green">
                                        + Rp. {{number_format($dt->nominal_transaksi)}} 
                                    </div>    
                                    <?php }elseif($dt->status ==2){?>
                                        <div style="color:red">
                                            - Rp. {{number_format($dt->nominal_transaksi)}} 
                                        </div>
                                    <?php }?>   
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