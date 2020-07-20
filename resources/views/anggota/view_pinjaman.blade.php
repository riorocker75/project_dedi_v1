@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Lihat Pinjaman</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/anggota/data-pinjaman/'.Session::get('ang_id').'')}}">Riwayat Pinjaman</a></li>
                <li class="breadcrumb-item active">Lihat Pinjaman</li>
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
                   
                   Cek 
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    @foreach ($data as $dpj)
                    <div class="row">
                        {{-- data pinjaman --}}
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group">
                                <label>Kode Pinjaman</label>
                                <input type="text" class="form-control"  value="{{ $dpj->pinjaman_kode }}" disabled>
                              </div>
                              <div class="form-group">
                                <label>Tanggal Ajukan Pinjaman</label>
                                <input type="text" class="form-control" value="{{ date('d-M-Y',strtotime($dpj->pinjaman_tgl)) }}" disabled>
                              </div>
                              <div class="form-group">
                                <label>Nomimal Pinjaman</label>
                                <input type="text" class="form-control" value="Rp.{{ number_format($dpj->pinjaman_jumlah)}}" disabled>
                              </div>

                              <div class="form-group">
                                <label>Angsuran per minggu</label>
                                <input type="text" class="form-control" value="Rp.{{ number_format($dpj->pinjaman_skema_angsuran)}}" disabled>
                              </div>

                        </div> 
                        
                        <div class="col-lg-6 col-md-12 col-12">
                          
                          <div class="form-group">
                            <label>Jangka Angsuran</label>
                            <input type="text" class="form-control" value="{{$dpj->pinjaman_angsuran_lama}} minggu" disabled>
                          </div>

                          @php
                          $bulan_total=$dpj->pinjaman_angsuran_lama / 4.345;
                           $total_bunga= round($bulan_total * $dpj->pinjaman_bunga);
                          @endphp
                          <div class="form-group">
                            <label>Total Bunga</label>
                            <input type="text" class="form-control" value="{{$total_bunga}} %" disabled>
                          </div>
                          <div class="form-group">
                            <label>Total Pengembalian</label>
                            <input type="text" class="form-control" value="Rp. <?php $ck=$dpj->pinjaman_skema_angsuran * $dpj->pinjaman_angsuran_lama; echo number_format($ck);?>" disabled>
                          </div>
                          <?php if($dpj->pinjaman_status != 1){ ?>
                            @if ($dpj->pinjaman_ket != "")
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" value="{{status_pinjaman($dpj->pinjaman_status)}} " disabled>
                              </div>

                              <div class="form-group">
                                <label>Keterangan</label>
                               <textarea class="form-control" rows="3" disabled>{{$dpj->pinjaman_ket}}</textarea>
                              </div>
                            @else

                            @endif
                            <?php }else{?>
                              <div class="form-group">
                                <label>Status Pinjaman</label>
                                <br>
                                {{status_bayar_pinjaman($dpj->status_bayar)}}
                              </div>
                            <?php } ?> 
                        </div> 
                    </div> 
                    @endforeach
                </div>
              </div>
            </section>

            
            {{-- bagian pembayaran --}}
           
          
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                 
                  Riwayat Pembayaran Pinjaman <b>{{$dpj->pinjaman_kode}}</b> 
                </h3>
                <div class="card-tools">
                 
                </div>
              </div>
              @php
              $no=1;
                $data_bayar= App\Model\PinjamanTransaksi::where('pinjaman_kode', $dpj->pinjaman_kode)->get();
              @endphp
              <div class="card-body">
                  
                @if(count($data_bayar) > 0)
                <table id="data1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Tanggal Bayar</th>
                      <th>Nominal dibayarkan</th>                   
                      <th>Kembalian Bayar</th> 
                      <th>Sisa Cicilan</th>                   
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach ($data_bayar as $db)
                      <tr>
                        {{-- strtotime($db->tgl_transaksi) --}}
                        <td>{{format_tanggal(date('Y-m-d',strtotime($db->tgl_transaksi)))}}</td>
                        <td>Rp.{{number_format($db->nominal_bayar)}}</td>
                        <td>Rp.{{number_format($db->kembalian_bayar)}}</td>
                        <td>Rp.{{ number_format($db->sisa_bayar)}}</td>
                        <td>{{$db->ket_bayar}}</td>
                      </tr>
                   @endforeach

                  </tbody>   
              </table> 
                 
                      

                @else
                  Belum ada Transaksi Pembayaran Pinjaman...
                @endif
              </div>
            </div> 

            </section>   
          {{-- end bagian pembayaran --}}
          </div>
        </div>
      </section>
    </div>
    
    
@endsection