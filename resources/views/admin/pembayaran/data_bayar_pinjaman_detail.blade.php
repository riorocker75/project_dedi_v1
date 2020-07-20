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
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                         Form bayar
                    </h3>
                   
                  </div>
                  <div class="card-body">
                    @foreach ($data as $dx)
                            @csrf

                            @php
                                $ang=App\Model\Anggota::where('anggota_id',$dx->anggota_id)->first();
                            @endphp
                            <div class="form-group">
                              <label for="">Nama / Nik Anggota</label>
                              <input type="text" class="form-control" value="{{$ang->anggota_nama}} | {{$ang->anggota_nik}}" disabled>
                            </div>
                            
                            <input type="text" name="kode" value="{{$dx->pinjaman_kode}}" hidden>
                            <input type="text" name="anggota" value="{{$dx->anggota_id}}" hidden>

                              <div class="form-group">
                                <label for="">Nominal Yang Dibayar</label>
                                <input type="number" class="form-control" name="bayar" id="format_rupiah" min="{{$dx->pinjaman_skema_angsuran}}" required>
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
                    @endforeach 
                  </div>
                </div>
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
                                <label for="">Angsuran Wajib/minggu</label>
                              <input type="text" class="form-control" value="Rp.{{number_format($dx->pinjaman_skema_angsuran)}}" disabled>
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
                            <td>{{$dt->ket_bayar}}</td>
                            
                           <td>
                           <a href="{{url('/admin/pembayaran/pinjaman/transaksi/hapus/'.$dt->id)}}" style="padding:0 7px"> <i class="fa fa-trash"></i></a>
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