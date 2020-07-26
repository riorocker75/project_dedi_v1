@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Bayar Angsuran Umroh Secara Transfer</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Bayar Angsuran Umroh Secara Transfer</li>
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
                @php
                    $ops =App\Model\Simpanan\OpsiSimpananLain::where('id', $dt->opsi_simpanan_lain_id)->first();
                    $min_bayar = $ops->angsuran_simpanan / 30;
                @endphp
                <div class="card-body">
                  <form action="{{url('/anggota/simpanan-umroh/transfer/act/'.$dt->no_rekening)}}" enctype="multipart/form-data" method="post" >
                  @csrf
                      <div class="form-group">
                        <label for="">Nominal Transfer</label>
                        <input type="number" min="{{$min_bayar}}" id="format_rupiah"
                      class="form-control" name="nominal" value="{{$ops->angsuran_simpanan}}" required>
                          <div class="show_rupiah"></div>
                          <small class="text-muted text-danger">* Ubah jika ingin membayar tunggakan dengan nominal yang sesuai</small>
                      </div>
                      
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
                      <button type="submit" class="btn btn-primary float-right">Kirim Bukti <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                  </form>
                </div>
                @endforeach
              </div>
            </section>


            {{-- detail singkat  simpanan umroh --}}
            <section class="col-lg-6 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                     Detail singkat
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">
                       
                    <div class="form-group">
                    <label for="">Angsuran perbulan</label>
                    <input type="text"
                    class="form-control" value="Rp.{{number_format($ops->angsuran_simpanan)}}" disabled>
                  </div>

                  @php
                        $source_sisa =App\Model\SimpananTransaksi::where('no_rekening',$dt->no_rekening)->get();
                        // cek dulu ada apa nggak nya data di tabel itu baru -> kau bisa manggil dia last record row
                        $sg= App\Model\SimpananTransaksi::where('no_rekening',$dt->no_rekening)->orderBy('id', 'DESC')->first(); 
                    @endphp

                        @if (count($source_sisa) > 0)
                        {{-- <input type="text" name="angsuran" value="{{$sg->sisa_bayar}}" hidden> --}}

                            <div class="form-group">
                            <label for="">Terakhir bayar</label>
                            <input type="text" class="form-control" value="{{format_tanggal(date('Y-m-d', strtotime($sg->tgl_transaksi)))}}" disabled>
                            </div>
                        @else
                            <div class="form-group">
                            <label for="">Terakhir bayar</label>
                            <input type="text" class="form-control" value="Belum Ada transaksi" disabled>
                            </div>
                        @endif


                  </div>
                </div>
              </section>
            
            </div>
          </div>
        </section>

            {{-- end detail singkat --}}

            {{-- data bukti transfer simpanan umum --}}

          
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
                   $dt_transfer = App\Model\BuktiBayar::where('no_rekening',$dt->no_rekening)->orderBy('tgl_upload','DESC')->get();    
                   @endphp
                <div class="card-body">

                    <table id="data1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Kode Transfer</th>
                        <th>Nominal Transaksi</th> 
                        <th>Keterangan</th>                 

                        <th>Status</th>                 
                        {{-- <th>Opsi</th> --}}
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
                            {{-- <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                             </tr> --}}
                        @endforeach


                    </tbody>   
                </table>
                </div>
           
              </div>
            </section>
            {{-- end data bukti transfer --}}
          </div>
        </div>
      </section>
    </div>
    
@endsection