@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Transfer Pinjaman </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Transfer Pinjaman </li>
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
                   
                  Data
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                     <form action="{{url('/anggota/pinjaman/bayar/transfer/act/'.$dt->pinjaman_kode)}}" enctype="multipart/form-data" method="post">
                      @csrf
                      @php
                          $ops= App\Model\Cat_Pinjaman::where('kategori_id',$dt->kategori_id)->first();
                          $total_bayar = $ops->kategori_angsuran + $ops->biaya_wajib;
                          $rek=App\Model\Option::where('option_name','rekening')->first();
                      @endphp
                    
                    {{-- <div class="form-group">
                      <label for="">Nominal Angsuran Pokok</label>
                      <input type="number"
                       class="form-control"  name="nominal" required>
                     <small class="text-muted text-danger">*Jika nunggak maka kalikan nilai Angsuran dengan banyak tunggakan </small>
                    </div>

                    <div class="form-group">
                      <label for="">Nominal Simpanan Wajib</label>
                      <input type="number"
                       class="form-control"  name="wajib" required>
                     <small class="text-muted text-danger">*Jika nunggak maka kalikan nilai Simpanan dengan banyak tunggakan </small>
                    </div> --}}
                    <div class="form-group">
                      <label for="">Angsuran Perminggu + Simpanan Wajib</label>
                      <input type="text"
                     class="form-control"  value="Rp.{{number_format($total_bayar)}}" disabled>
                     <small class="text-muted text-danger">*transfer sesuai nominal</small>
                    </div>
                    <input type="text" name="dibayar" value="{{$total_bayar}}" hidden>
                      <div class="form-group">
                        <label for="">Nomor Rekening</label>
                        {!! $rek->option_value !!}
                      </div>

                      <br>
                      <div class="form-group" style="border: 1px solid #c1c2c3;padding:10px">
					            	<b>Upload Bukti Bayar</b><br/>
                        <input type="file" name="bukti" id="file_1" required>
                        <br>
                        <small class="text-danger">*File support:jpg,png.  max:2mb</small>
                        <div class="file_show" id="file_show_1"></div>
                        <br>
                        @if($errors->has('bukti'))
                        <small class="text-muted text-danger">
                        {{ $errors->first('bukti')}}
                        </small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary float-right"> Submit <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </form>   
                </div>
                @endforeach
              </div>
            </section>


            <section class="col-lg-6 connectedSortable">
              <div class="card">
            
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Data
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                  @php
                  $source_sisa =App\Model\PinjamanTransaksi::where('pinjaman_kode',$dt->pinjaman_kode)->get();
                  // cek dulu ada apa nggak nya data di tabel itu baru -> kau bisa manggil dia last record row
                  $total_angsur= $dt->pinjaman_skema_angsuran * $dt->pinjaman_angsuran_lama;

                  $sg= App\Model\PinjamanTransaksi::where('pinjaman_kode',$dt->pinjaman_kode)->orderBy('id', 'DESC')->first(); 
                @endphp
                  <div class="form-group">
                    <label for="">Angsuran Perminggu</label>
                    <input type="text"
                   class="form-control"  value="Rp.{{number_format($ops->kategori_angsuran)}}" disabled>
                   {{-- <small class="text-muted text-danger">*Jika nunggak maka kalikan nilai Angsuran dengan banyak tunggakan </small> --}}
                  </div>

                  <div class="form-group">
                    <label for="">Simpanan Wajib Perminggu</label>
                    <input type="text"
                   class="form-control"  value="Rp.{{number_format($ops->biaya_wajib)}}" disabled>
                   {{-- <small class="text-muted text-danger">*Jika nunggak maka kalikan nilai Angsuran dengan banyak tunggakan </small> --}}
                  </div>
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
             
              </div>
            </section>

            <section class="col-lg-12 connectedSortable">
              <div class="card">
             
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Data transfer
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                  @php
                   $dt_transfer = App\Model\BuktiBayar::where('no_rekening',$dt->pinjaman_kode)->orderBy('tgl_upload','DESC')->get();    
                   @endphp
                <div class="card-body">

                    <table id="data1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Kode Transfer</th>
                        <th>Nominal Transaksi</th> 
                        <th>Keterangan</th>                 

                        <th>Status</th>                 
                        <th>Opsi</th>                   
                        </tr>
                    </thead>
                    <tbody> 
                     @foreach ($dt_transfer as $dtf)
                      
                        <tr>
                            <td>{{$dtf->kode_transaksi}}
                                <br>
                                <small class="tgl-text">{{format_tanggal(date('Y-m-d',strtotime($dtf->tgl_upload)))}}</small>
                            </td>
                            
                            <td>Rp.{{number_format($dtf->nominal)}}</td>
                          <td>{{$dtf->ket_upload}}</td>

                          <td>{{status_transfer($dtf->status)}}</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
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