@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Detail Pembayaran Pinjaman</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboar/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Detail Pembayaran Pinjaman</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <form action="{{url('/admin/pembayaran/pinjaman/bayar/')}}" method="post">
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
            {{-- bagian form pembayaran --}}

            <section class="col-lg-6 connectedSortable">
              @foreach ($data as $dx)  
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                         Form bayar 

                    </h3>
                    <div class="card-tools">
                      @php
                        $bukti_by = DB::table('tbl_bukti_bayar')
                                  ->where([
                                      ['no_rekening',$dx->pinjaman_kode],
                                      ['status',0]
                                    ])->get();   
                        $bukti_nulled= App\Model\BuktiBayar::where('no_rekening',$dx->pinjaman_kode)->get();            
                      @endphp
                     
                      
                      @if (count($bukti_by) > 0)
                        <div class="float-right">
                            <label class="badge badge-info"> Ada Bayar Transfer Baru </label>
                        </div>
                      @endif
                      
                    </div>
                  </div>
                  <div class="card-body">
                    
                            @csrf

                            @php
                                $ang=App\Model\Anggota::where('anggota_id',$dx->anggota_id)->first();
                               $ops =App\Model\Cat_Pinjaman::where('kategori_id',$dx->kategori_id)->first();

                            @endphp
                            <div class="form-group">
                              <label for="">Nama / Nik Anggota</label>
                              <input type="text" class="form-control" value="{{$ang->anggota_nama}} | {{$ang->anggota_nik}}" disabled>
                            </div>
                            
                            <input type="text" name="kode" value="{{$dx->pinjaman_kode}}" hidden>
                            <input type="text" name="anggota" value="{{$dx->anggota_id}}" hidden>

                              <div class="form-group">
                                <label for="">Nominal Angsuran Pokok Yang Dibayar</label>
                                <input type="number" class="form-control" name="bayar" id="format_rupiah_2" min="{{$dx->pinjaman_skema_angsuran}}" value="{{$dx->pinjaman_skema_angsuran}}" required>
                                <div class="show_rupiah_2"></div>
                                @if($errors->has('bayar'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('bayar')}}
                                </small>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="">Nominal Wajib Mingguan </label>
                                <input type="number" class="form-control" name="wajib" id="format_rupiah" min="{{$ops->biaya_wajib}}" value="{{$ops->biaya_wajib}}" required>
                                <div class="show_rupiah"></div>
                                @if($errors->has('bayar'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('bayar')}}
                                </small>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="">Kembalian</label>
                                <input type="number" class="form-control" name="kembalian" value="0" min="0" required>
                                <small>*isi nilai 0 jika uangnya pas</small>
                              
                              </div>

                              <div class="form-group">
                                <label for="">Metode Bayar</label>
                               <select name="metode" class="form-control" required>
                                   <option value="">--Pilih Metode--</option>
                                   <option value="1">Langsung</option>
                                   <option value="2">Transfer</option>
                               </select>
                                    @if($errors->has('metode'))
                                    <small class="text-muted text-danger">
                                    {{ $errors->first('metode')}}
                                    </small>
                                    @endif
                            </div>

                              <div class="form-group">
                                <label for="">Keterangan Bayar</label>
                                <input type="text" class="form-control" name="ket_bayar" required>
                                <small>*isi: Pembayaran Ke 1 atau Pembayaran ke 3,4,5 jika tertunggak lebih dari 1</small>
                                <br>
                                @if($errors->has('ket_bayar'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('ket_bayar')}}
                                </small>
                                @endif
                              </div> 

                              @if ($dx->status_bayar == 1)
                                  
                              <button type="submit" class="btn btn-primary float-right"> Bayar <i class="fa fa-paper-plane"></i></button>
                              @elseif($dx->status_bayar == 2)
                              
                              @endif
                            </div>
                          </div>
                          @endforeach 
           </section>   
           
           {{-- detail pinjaman --}}
           <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                     Detail Pinjaman {{status_bayar_pinjaman($dx->status_bayar)}}
                </h3>
               
              </div>
              <div class="card-body">
                 
                    <div class="row">
                      {{-- ini bagian detail pinjaman --}}
                      <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group">
                              <label for="">Kode Pinjaman</label>
                            <input type="text" class="form-control" value="{{$dx->pinjaman_kode}}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Angsuran pokok perminggu</label>
                              <input type="text" class="form-control" value="Rp.{{number_format($dx->pinjaman_skema_angsuran)}}" disabled>
                              </div>

                              <div class="form-group">
                                <label for="">Angsuran Wajib perminggu</label>
                              <input type="text" class="form-control" value="Rp.{{number_format($ops->biaya_wajib)}}" disabled>
                              </div>
                              @php
                                  $total_angsur= $dx->pinjaman_skema_angsuran * $dx->pinjaman_angsuran_lama;
                              @endphp
                              <div class="form-group">
                                <label for="">Total Angsuran</label>
                              <input type="text" class="form-control" value="Rp.{{number_format($total_angsur)}}" disabled>
                              </div>
                              
                              <div class="form-group">
                                <label for="">Mulai Pinjaman</label>
                              <input type="text" class="form-control" value="{{format_tanggal(date('Y-m-d', strtotime($dx->pinjaman_tgl)))}}" disabled>
                              </div>

                              <div class="form-group">
                                @php
                                     $end = strtotime(date($dx->pinjaman_tgl));
                                     $week=$dx->pinjaman_angsuran_lama;
                                     $start = strtotime("+$week week", $end);
                                @endphp 
                                <label for="">Jatuh Tempo Pada</label>
                              <input type="text" class="form-control" value="{{format_tanggal(date("Y-m-d", $start))}}" disabled>
                              </div>
                            
                               
                      </div>
                      {{-- ini bagian detail yang akan dibayarkan --}}
                      <div class="col-lg-6 col-md-12 col-12">
                           @php
                              $source_sisa =App\Model\PinjamanTransaksi::where('pinjaman_kode',$dx->pinjaman_kode)->get();
                              // cek dulu ada apa nggak nya data di tabel itu baru -> kau bisa manggil dia last record row
                              $sg= App\Model\PinjamanTransaksi::where('pinjaman_kode',$dx->pinjaman_kode)->orderBy('id', 'DESC')->first(); 
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
                      </div>
                      {{-- end row --}}
                      </div>
                       
                    </div>
                  </div>
                </section>       
              </form>
           {{-- end detail pinjaman --}}


            {{-- data Transfer --}}
              @if (count($bukti_nulled) > 0)
              <section class="col-lg-8 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                         List transaksi Bayar Transfer<b> {{$dx->pinjaman_kode}}</b>
                         @if (count($bukti_by) > 0)
                         
                             <label class="badge badge-info"> {{count($bukti_by)}} </label>
                         
                       @endif
                    </h3>
                    <div class="card-tools">
                     <div class="float-right">
                       <a  href="#transfer" class="btn btn-default" data-toggle="collapse">Selengkapnya</a>
                     </div>
                    </div>
                  </div>
                  <div class="card-body collapse" id="transfer">
                      <table id="data2" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                              <th>Kode Transaksi</th>
                              <th>Nominal Transfer</th> 
                              <th>Status</th> 
                              <th>Opsi</th>                   
                              </tr>
                          </thead>
                          <tbody> 
                             @foreach ($bukti_nulled as $bn)
                                 
                             <tr>
                                 <td>{{$bn->kode_transaksi}}
                                    <br>
                                    <small>{{format_tanggal(date('Y-m-d',strtotime($bn->tgl_upload)))}}</small>
                                </td>
                             <td>Rp. {{number_format($bn->nominal)}}</td>
                              <td>{{status_transfer($bn->status)}}</td>

                             <td>
                             <a data-toggle="modal" data-target="#view_tr{{$bn->id}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                             <a href="{{url('/admin/pinjaman/detail/transfer/hapus/'.$bn->id)}}" style="padding:0 7px"> <i class="fa fa-trash"></i></a>
            
                               {{-- modal transfer --}}
                                  <div class="modal fade" id="view_tr{{$bn->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Detail Transfer</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                                <form action="{{url('/admin/pinjaman/detail/transfer/act')}}" method="post">
                                                  @csrf
                                                <div class="modal-body">

                                                  <div class="form-group" style="margin-bottom:-145px">
                                                    <label >Bukti Bayar</label>
                                                    <div class="review-img">
                                                        
                                                        <?php echo preview_bukti($bn->isi)?>
                                                    </div>
                                                  </div>

                                                  <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea class="form-control" name="ket" rows="3"></textarea>
                                                    <small class="text-danger">* isi jika ada alasan menolak  bukti bayar</small>

                                                  </div>

                                                <input type="text" value="{{$bn->id}}" name="bukti_id" hidden>
                                                  

                                                </div>
                                                <div class="modal-footer">
                                                  <button class="btn btn-default float-right" style="margin-right:10px" type="submit" name="action" value="tolak"> Tolak Transfer</button>
                                                  <button class="btn btn-primary float-right" type="submit" name="action" value="terima">Terima Transfer</button>
                                                </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                  {{-- end modal transfer --}}

                              </td>
                          </tr>
                          @endforeach
                      
                      
                          </tbody>   
                      </table>
                  </div>
                </div>
              </section>
              @endif

            {{-- end data transfer --}}

            {{-- bagian list bayar --}}
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                       List transaksi pembayaran <b>{{$dx->pinjaman_kode}}</b>
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                      {{-- start cetak transaksi --}}
                      @if(count($data) > 0)
                      <form action="{{url('/cetak/transaksi/simpanan/pinjaman/filter/'.$dx->pinjaman_kode)}}" method="post" target="__blank">
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
                            <th>Kode Pinjaman</th>
                            <th>Tanggal bayar</th>  
                            <th>Jumlah Bayar</th>
                             <th>Sisa Bayar</th>  
                             <th>Keterangan</th>           
                            <th>Opsi</th>                   
                            </tr>
                        </thead>
                        <tbody> 
                           @foreach ($data_bayar as $dt)
                               
                           <tr>
                               <td>{{$dt->pinjaman_kode}}</td>
                            
                       
                            <td> {{date('d-M-Y' , strtotime($dt->tgl_transaksi))}}</td>
                           <td>Rp. {{number_format($dt->nominal_bayar)}}
                           <small> Kembalian: Rp. {{number_format($dt->kembalian_bayar)}}</small> 
                            </td>
                           <td>Rp. {{number_format($dt->sisa_bayar)}}</td>
                            <td>{{$dt->ket_bayar}}
                              <br>
                              {{status_metode($dt->metode)}}
                            </td>
                            
                           <td>
                           <a href="{{url('/admin/pembayaran/pinjaman/transaksi/hapus/'.$dt->id)}}" style="padding:0 7px"
                            onclick="return confirm('Apakah anda yakin menghapus data ini ?');"> 
                            <i class="fa fa-trash"></i>
                          </a>
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