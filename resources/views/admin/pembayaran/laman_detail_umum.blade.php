@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Penambahan Tabungan </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Penambahan Tabungan</li>
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
                <div class="card-header">
                  <h3 class="card-title">
                   
                 Tambah Nilai Tabungan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                 @foreach ($data as $dt)
                    <form action="{{url('/admin/pembayaran/simpanan-umum/tambah')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Nominal Transaksi</label>
                            <input type="number"
                          class="form-control" name="nominal" id="format_rupiah" min="10000" required>
                            <div class="show_rupiah"></div>
                                @if($errors->has('nominal'))
                                <small class="text-muted text-danger">
                                {{ $errors->first('nominal')}}
                                </small>
                                @endif
                        </div>
                        <input type="text" name="no_rek" value={{$dt->no_rekening}} hidden>
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

                       

                        <button class="btn btn-primary float-right"><i class="fas fa-save="></i> Simpan</button>
                    </form>
                 @endforeach
                </div>
              </div>
            </section>


            <section class="col-lg-6 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                  Detail Pemilik Tabungan
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">
                   @php
                       $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                       $pk=App\Model\Pekerjaan::where('id', $ang->anggota_pekerjaan)->first();
                   @endphp
                    <div class="form-group">
                        <label for="">Total Tabungan Sukarela</label>
                        <input type="text"
                        class="form-control" value="Rp.{{number_format($dt->total_simpanan)}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Total Tabungan Wajib</label>
                        <input type="text"
                        class="form-control" value="Rp.{{number_format($dt->jlh_wajib)}}" disabled>
                    </div>

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
                </div>
              </section>


              <section class="col-lg-12 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                    Riwayat Transaksi <b>{{$dt->no_rekening}}</b>
                    <?php if($dt->status == 1 ){?>
                      <label class="badge badge-success">Aktif</label>
                    <?php }elseif($dt->status == 0){ ?>
                      <label class="badge badge-danger">Non Aktif</label>
                      
                    <?php } ?>  
                    </h3>
                    <div class="card-tools">
                     <div class="float-right">
                      <a data-toggle="modal" data-target="#tutup-umum" class="btn-block btn btn-outline-primary"> Tutup Rekening</a>

                     </div>
                    </div>
                  </div>
                  <div class="card-body">
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
                                $last =App\Model\SimpananTransaksi::where('no_rekening',$dt->no_rekening)->orderBy('id','desc')->get();
                            @endphp
                            {{-- data 1 --}}
                            @foreach ($last as $lt)
                          
                            <tr>
                                <td>{{$lt->kode_transaksi}}
                                  <br>
                                  <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($lt->tgl_transaksi)))}}</small>
                                </td>
                              
                              <td>{{$lt->jenis_transaksi}}</td>
                              <td>{{$lt->ket_transaksi}}</td>

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
                                <a href="{{url('/admin/transaksi/simpanan-umum/detail/'.$lt->kode_transaksi)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
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
          <form action="{{url('/admin/pembayaran/simpanan-umum/tutup-rekening')}}" method="post">
            @csrf
          <div class="modal-body">
          @php
             $ops = App\Model\Simpanan\OpsiSimpanan::where('id', 1)->first();              
          @endphp
            <div class="form-group">
              <label for="">Total Tabungan Sukarela</label>
              <input type="text"
              class="form-control" value="Rp.{{number_format($dt->total_simpanan)}}" disabled>
          </div>
         <input type="text" value="{{$dt->no_rekening}}" name="rek_tutup" hidden>
         <input type="text" value="{{$dt->anggota_id}}" name="ang_tutup" hidden>


          <div class="form-group">
              <label for="">Total Tabungan Wajib</label>
              <input type="text"
              class="form-control" value="Rp.{{number_format($dt->jlh_wajib)}}" disabled>
          </div>

          <div class="form-group">
            <label for="">Tabungan Pokok</label>
            <input type="text"
            class="form-control" value="Rp.{{number_format($dt->jlh_pokok)}}" disabled>
        </div>

          <div class="form-group">
            <label for="">Biaya Endapan Rekening</label>
            <input type="text"
            class="form-control" value="Rp.{{number_format($ops->biaya_endapan)}}" disabled>
        </div>
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