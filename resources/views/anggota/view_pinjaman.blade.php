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
            @foreach ($data as $dpj)
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Detail 
                  </h3>
                  <div class="card-tools">
                   <a href="{{url('/anggota/pinjaman/bayar/transfer/detail/'.$dpj->pinjaman_kode)}}" class="btn btn-outline-primary"><i class="fa fa-credit-card"></i>&nbsp; Bayar Via Transfer</a>
                  </div>
                </div>
                <div class="card-body">
                    @php
                    $ops=App\Model\Cat_Pinjaman::where('kategori_id',$dpj->kategori_id)->first();
                    $source_sisa =App\Model\PinjamanTransaksi::where('pinjaman_kode',$dpj->pinjaman_kode)->get();

                    $total_angsur = $dpj->pinjaman_skema_angsuran + $ops->biaya_wajib;
                    @endphp
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
                                <label>Angsuran Pokok/minggu</label>
                                <input type="text" class="form-control" value="Rp.{{ number_format( $total_angsur)}}" disabled>
                              </div>
                              <div class="form-group">
                                <label for="">Angsuran Wajib/minggu</label>
                              <input type="text" class="form-control" value="Rp.{{number_format($ops->biaya_wajib)}}" disabled>
                              </div>
                              <div class="form-group">
                                <label>Jangka Angsuran</label>
                                <input type="text" class="form-control" value="{{$dpj->pinjaman_angsuran_lama}} minggu" disabled>
                              </div>
                          
    
                        </div> 
                        
                        <div class="col-lg-6 col-md-12 col-12">
                          
                            {{-- lebih detail pinjaman --}}
                              @php
                              $source_sisa =App\Model\PinjamanTransaksi::where('pinjaman_kode',$dpj->pinjaman_kode)->get();
                              // cek dulu ada apa nggak nya data di tabel itu baru -> kau bisa manggil dia last record row
                              $sg= App\Model\PinjamanTransaksi::where('pinjaman_kode',$dpj->pinjaman_kode)->orderBy('id', 'DESC')->first(); 
                              @endphp

                              @if (count($source_sisa) > 0)
                              <input type="text" name="angsuran" value="{{$sg->sisa_bayar}}" hidden>

                              <div class="form-group">
                                <label for="">Terakhir bayar</label>
                                <input type="text" class="form-control" value="{{format_tanggal(date('Y-m-d', strtotime($sg->tgl_transaksi)))}}" disabled>
                              </div>

                              <div class="form-group">
                                <label for="">Sisa Angsuran</label>
                                <input type="text" class="form-control" value="Rp.{{number_format($sg->sisa_bayar)}}" disabled>
                              </div>

                              <?php
                                  $pemilik = App\Model\PinjamanTransaksi::where('pinjaman_kode',$sg->pinjaman_kode)
                                    ->select(DB::raw('pinjaman_kode,  sum(kembalian_bayar) as total_kembalian'))
                                    ->groupBy('pinjaman_kode')
                                    ->get();
                                foreach ($pemilik as $tk) {}
                              ?>
                              <div class="form-group">
                                <label for="">Total Kembalian</label>
                                <input type="text" class="form-control" value="Rp.{{number_format($tk->total_kembalian)}}" disabled>
                              </div>

                              @else

                              <input type="text" name="angsuran" value="{{$total_angsur}}" hidden>

                              <div class="form-group">
                                <label for="">Terakhir bayar</label>
                                <input type="text" class="form-control" value="Belum Ada transaksi" disabled>
                              </div>

                              <div class="form-group">
                                <label for="">Sisa Angsuran</label>
                                <input type="text" class="form-control" value="Belum Ada transaksi" disabled>
                              </div>

                              @endif

                          {{-- end lebih detail  --}}
                      
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
                  </div>
                </div>
              </section>
              @endforeach

            
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
                $data_bayar= App\Model\PinjamanTransaksi::where('pinjaman_kode', $dpj->pinjaman_kode)->orderBy('tgl_transaksi','desc')->get();
              @endphp
              <div class="card-body">
                  {{-- start cetak transaksi --}}
                  @if(count($data) > 0)
                  <form action="{{url('/cetak/transaksi/simpanan/pinjaman/filter/'.$dpj->pinjaman_kode)}}" method="post" target="__blank">
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
                @if(count($data_bayar) > 0)
                <table id="data1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Tanggal Bayar</th>
                      <th>Nominal dibayarkan</th>                   
                      <th>Kembalian Bayar</th> 
                      <th>Sisa Angsuran</th>                   
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
                        <td>{{$db->ket_bayar}}
                          <br>{{status_metode($db->metode)}}
                        </td>
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