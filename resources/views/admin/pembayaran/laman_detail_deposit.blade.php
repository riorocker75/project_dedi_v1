@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Detail Simpanan Berjangka</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Detail Simpanan Berjangka</li>
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
                @foreach ($data as $dt)

                <div class="card-header">
                  <h3 class="card-title">
                   
                 Aktivitas Simpanan Berjangka
                  </h3>

                  @php
                  $tarik_dana=App\Model\TarikDana::where([
                                                    'no_rekening'=> $dt->rekening_deposit,
                                                    'status' => 0   
                                                   ])->get();         
                  $tarik_dana_nulled= App\Model\TarikDana::where('no_rekening',$dt->rekening_deposit)
                                                  ->orderBy('tgl_aju','desc')         
                                                  ->get();   
                  @endphp
                  <div class="card-tools">
                    <div class="float-right">
                      <?php if(count($tarik_dana) > 0){?>
                        <label  class="badge badge-success">
                         Konfirmasi Penarikan Dana
                          </label>
                        <?php }?>  
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/pembayaran/simpanan-deposit/tambah')}}" method="post">
                        @csrf

                     @php
                        $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                        $pk=App\Model\Pekerjaan::where('id', $ang->anggota_pekerjaan)->first();
                        $det_angsur=App\Model\SimpananTransaksi::where('no_rekening', $dt->rekening_deposit)->orderBy('id', 'desc')->first();
                        $ops_lain= App\Model\Simpanan\OpsiSimpananBerjangka::where('id', $dt->opsi_deposit_id)->first();
                       
                        $jangka = $dt->jangka_deposit;
                        $tgl_akhir = date('Y-m-d', strtotime("+$jangka months", strtotime($dt->tgl_deposit)));
                      @endphp
                      
                        <div class="form-group">
                            <label for="">Nominal Transaksi</label>
                            <input type="number"
                        class="form-control" name="nominal" id="format_rupiah" min="10000" value="{{$dt->angsuran_umroh}}" required>
                            <div class="show_rupiah"></div>
                                @if($errors->has('nominal'))
                                <small class="text-muted text-danger">
                                {{ $errors->first('nominal')}}
                                </small>
                                @endif
                        </div>
                        <input type="text" name="no_rek" value={{$dt->rekening_deposit}} hidden>
                        <input type="text" name="ang_id" value={{$dt->anggota_id}} hidden>
                       

                        <div class="form-group">
                            <label for="">Jenis Transaksi</label>
                           <select name="jenis_tr" class="form-control" required>
                               <option value="">--Pilih Jenis Transaksi--</option>
                               <option value="1">Menabung</option>
                               <option value="2">Penarikan</option>

                           </select>
                                @if($errors->has('jenis_tr'))
                                <small class="text-muted text-danger">
                                {{ $errors->first('jenis_tr')}}
                                </small>
                                @endif
                        </div>

                        <div class="form-group">
                          <label for="">Metode Simpan / Penarikan</label>
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

                        <button class="btn btn-primary float-right"><i class="fas fa-save="></i> Simpan</button>
                    </form>
                  </div>
                  @endforeach
              </div>
            </section>
    

            <section class="col-lg-6 connectedSortable">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        {{-- detail simpanan --}}

                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">
                               
                            Detail Simpanan
                              </h3>
                              <div class="card-tools">
                               <div class="float-right">
                                   <button data-toggle="collapse" href="#simpanan" class="btn btn-outline-secondary">
                                       Detail 
                                   </button>
                               </div>
                              </div>
                            </div>
                            <div class="card-body collapse" id="simpanan">
                              <div class="form-group">
                                <label for="">Total Pendapatan Nisbah</label>
                                <input type="text"
                              class="form-control" value="Rp.{{number_format($dt->total_nisbah)}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Nilai Simpanan Berjangka</label>
                                <input type="text"
                                class="form-control" value="Rp.{{number_format($dt->nilai_deposit)}}" disabled>
                            </div>   
                            <div class="form-group">
                                <label for="">Jangka Simpanan</label>
                                <input type="text"
                                class="form-control" value="{{number_format($dt->jangka_deposit)}} bulan" disabled>
                            </div>

                            <div class="form-group">
                            <label for="">Pencairan Simpanan</label>
                                <input type="text"
                              class="form-control" value="{{format_tanggal(date('Y-m-d', strtotime($tgl_akhir)))}}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Nisbah perbulan</label>
                                <input type="text"
                              class="form-control" value="Rp.{{number_format($ops_lain->nisbah_bulan)}}" disabled>
                            </div>

                           
                            {{-- 
                            <div class="form-group">
                                <label for="">Terakhir bayar</label>
                                <input type="text"
                              class="form-control" value="{{format_tanggal(date('Y-m-d', strtotime($det_angsur->tgl_transaksi)))}}" disabled>
                            </div> --}}
          
                            
                            </div>
                        </div>

                            {{-- end card --}}
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        {{-- detail data diri  --}}

                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">
                               
                            Detail Pemilik Tabungan
                              </h3>
                              <div class="card-tools">
                               <div class="float-right">
                                   <button data-toggle="collapse" href="#data-diri" class="btn btn-outline-secondary">
                                       Detail 
                                   </button>
                               </div>
                              </div>
                            </div>
                            <div class="card-body collapse" id="data-diri">
                           
                         
                             <div class="form-group">
                               <label for="">Nama</label>
                               <input type="text"
                             class="form-control" value="{{$ang->anggota_nama}}" disabled>
                             </div>
          
                             <div class="form-group">
                              <label for="">NIK</label>
                              <input type="text"
                                class="form-control" value="{{$ang->anggota_nik}}" disabled>
                            </div>
          
                            <div class="form-group">
                              <label for="">Nomor Hp/Telp</label>
                              <input type="text"
                                class="form-control" value="{{$ang->anggota_kontak}}" disabled>
                            </div>
          
                            <div class="form-group">
                              <label for="">Alamat</label>
                              <input type="text"
                                class="form-control" value="{{$ang->anggota_alamat_ktp}}" disabled>
                            </div>
          
                            <div class="form-group">
                              <label for="">Pekerjaan</label>
                              <input type="text"
                                class="form-control" value="{{$pk->pekerjaan}}" disabled>
                            </div>
          
                            
                            </div>

                            {{-- end card --}}
                          </div>
                    </div>
                    {{-- end detail data diri --}}
                </div>
              </section>

              {{-- data penarikan --}}
@if (count($tarik_dana_nulled) > 0)
<section class="col-lg-12 connectedSortable">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
       
           Riwayat Penarikan Dana<b> {{$dt->no_rekening}}</b>
           @if (count($tarik_dana) > 0)
               <label class="badge badge-info"> {{count($tarik_dana)}} </label>
           @endif
      </h3>
      <div class="card-tools">
       <div class="float-right">
         <a  href="#tarik-dana" class="btn btn-default" data-toggle="collapse"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
       </div>
      </div>
    </div>
    <div class="card-body collapse" id="tarik-dana">
        <table id="data4" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>Kode Transaksi</th>
                <th>Nominal Penarikan</th> 
                <th>Keterangan</th> 
                <th>Status</th>                   
                <th>Opsi</th>                   
                </tr>
            </thead>
            <tbody> 
               @foreach ($tarik_dana_nulled as $tdn)
                   
               <tr>
                   <td>{{$tdn->kode_transaksi}}
                      <br>
                      <small>{{format_tanggal(date('Y-m-d',strtotime($tdn->tgl_aju)))}}</small>
                  </td>
               <td>Rp. {{number_format($tdn->nominal)}}</td>
               <td>{{$tdn->ket}}</td>

                <td>{{status_tarik($tdn->status)}}</td>

               <td>
                 
               <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#view_tarik{{$tdn->id}}"><i class="fa fa-eye"></i> </button>
               <a href="{{url('/admin/penarikan/simpanan-deposit/hapus/'.$tdn->id)}}" style="padding:0 7px" onclick="return confirm('Yakin menghapus data ini ?')"> <i class="fa fa-trash"></i></a>
                 
                 {{-- modal penarikan dana --}}
                 <div class="modal fade" id="view_tarik{{$tdn->id}}" >
                   <div class="modal-dialog modal-dialog-centered" role="dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLongTitle">Detail penarikan</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <form action="{{url('/admin/penarikan/simpanan-deposit/act')}}" method="post">
                         @csrf
                       <div class="modal-body">
                        <div class="form-group">
                          <label >Nominal Penarikan</label>
                          <input type="text"
                            class="form-control" value="Rp.{{number_format($tdn->nominal)}}" disabled>
                         
                          </div>

                          <div class="form-group">
                            <label >Nomor Rekening Bank</label>
                            <input type="text"
                          class="form-control" value="{{$tdn->info}}" disabled>
                            </div>
                          <div class="form-group">
                            <label >Saldo</label>
                            <input type="text"
                              class="form-control" value="Rp.{{number_format($dt->total_nisbah)}}" disabled>
                            </div>

                            <div class="form-group">
                              <label >Nama Pemilik Rekening</label>
                              <input type="text"
                                class="form-control" value="{{$ang->anggota_nama}}" disabled>
                                <small class="text-danger">*Tolak jika nama tidak sama dengan rekening</small>
                              
                              </div>
                              @if ($tdn->status < 1)
                              <div class="form-group">
                                <label >Keterangan</label>
                                <textarea  class="form-control" name="ket"  rows="3"></textarea>
                                <small class="text-danger">*isi jika melakukan penolakan</small>
                                </div>
                                @endif

                        <input type="text" value="{{$tdn->id}}" name="tarik_id" hidden>
                        <input type="text" value="{{$ang->anggota_kode}}" name="ang_kode" hidden>
                        <input type="text" value="{{$tdn->kode_transaksi}}" name="trs_kode" hidden>
                        <input type="text" value="{{$tdn->nominal}}" name="nominal" hidden>
                         
                       </div>
                       <div class="modal-footer">
                         @if ($tdn->status < 1)
                         <button class="btn btn-default float-right" style="margin-right:10px" type="submit" name="action" value="tolak"> Tolak Penarikan</button>
                         <button class="btn btn-primary float-right" type="submit" name="action" value="terima">Terima Penarikan</button>
                         @endif
                       </div>
                     </form>
                     </div>
                   </div>
                 </div>
                 {{-- end modal penarikan--}}


                </td>
            </tr>
            @endforeach
        
            </tbody>   
        </table>
    </div>
  </div>
</section>
@endif

{{-- end data penarikan--}}

              <section class="col-lg-12 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                    Riwayat Transaksi <b>{{$dt->rekening_deposit}}</b>
                    <?php if($dt->status == 1 ){?>
                      <label class="badge badge-success">Aktif</label>
                    <?php }elseif($dt->status == 3){ ?>
                      <label class="badge badge-danger">Tutup Rekening</label>
                      
                    <?php } ?>  
                    </h3>
                    <div class="card-tools">
                     <div class="float-right">
                      <a data-toggle="modal" data-target="#tutup-umum" class="btn-block btn btn-outline-primary"> Tutup Rekening</a>

                     </div>
                    </div>
                  </div>
                  <div class="card-body">
                          {{-- start cetak transaksi --}}
                    @if(count($data) > 0)
                    <form action="{{url('/cetak/transaksi/simpanan/deposit/filter/'.$dt->rekening_deposit)}}" method="post" target="__blank">
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
                      
                        <button type="submit"  style="margin-top:32px;margin-bottom:20px" 
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
                            <th>Opsi</th>                   
                          </tr>
                        </thead>
                        <tbody> 
                            
                            @php
                                $last =App\Model\SimpananTransaksi::where('no_rekening',$dt->rekening_deposit)->orderBy('tgl_transaksi','desc')->get();
                            @endphp
                            {{-- data 1 --}}
                            @foreach ($last as $lt)
                          
                            <tr>
                                <td>{{$lt->kode_transaksi}}
                                  <br>
                                  <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($lt->tgl_transaksi)))}}</small>
                                </td>
                              
                              <td>{{$lt->jenis_transaksi}}</td>
                              <td>{{$lt->ket_transaksi}}
                                <br>
                                {{status_metode($lt->metode)}}
                              </td>

                                <td>
                                    <?php if($lt->status == 1){?>
                                    <div style="color:green">
                                        + Rp. {{number_format($lt->nominal_transaksi)}} 
                                    </div>    
                                    <?php }elseif($lt->status ==2){?>
                                        <div style="color:red">
                                            - Rp. {{number_format($lt->nominal_transaksi)}} 
                                        </div>
                                    <?php }?>   

                                </td>
                                <td>
                                <a href="{{url('/admin/transaksi/simpanan-pendidikan/detail/'.$lt->kode_transaksi)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
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
    
    {{-- modal tutup rekening --}}
    <div class="modal fade" id="tutup-umum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tutup Rekening</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{url('/admin/pembayaran/simpanan-deposit/tutup-rekening')}}" method="post">
            @csrf
          <div class="modal-body">
         
            <div class="form-group">
              <label for="">Tabungan Simpanan Berjangka</label>
              <input type="text"
              class="form-control" value="Rp.{{number_format($dt->nilai_deposit)}}" disabled>
          </div>

          <div class="form-group">
          <label for="">Total Nisbah </label>
            <input type="text"
            class="form-control" value="Rp.{{number_format($dt->total_nisbah)}}" disabled>
         </div>
         @php
             $total_balik = $dt->nilai_deposit + $dt->total_nisbah;
         @endphp
         <div class="form-group">
            <label for="">Dikembalikan</label>
              <input type="text"
              class="form-control" value="Rp.{{number_format($total_balik )}}" disabled>
           </div>

         <input type="text" value="{{$dt->rekening_deposit}}" name="rek_tutup" hidden>
         <input type="text" value="{{$dt->anggota_id}}" name="ang_tutup" hidden>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Tutup Rekening</button>
          </div>
        </form>

        </div>
      </div>
    </div>
@endsection