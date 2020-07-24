@extends('layouts.main_app')
@section('content')
    @foreach ($data as $dt)
    
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
             <h1 class="m-0 text-dark">Detail Transaksi {{$dt->kode_transaksi}}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Detail Transaksi {{$dt->kode_transaksi}}</li>
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
                   
                   Detail
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">

                  @foreach ($data as $dt)
                  
                  <div class="form-group">
                    <label for="">No Rekening</label>
                    <input type="text"
                     class="form-control" name="" value="{{$dt->no_rekening}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">Nama Transaksi</label>
                    <input type="text"
                     class="form-control" name="" value="{{$dt->jenis_transaksi}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">Keterangan Transaksi</label>
                    <input type="text"
                     class="form-control" name="" value="{{$dt->ket_transaksi}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">Nominal Transaksi</label>
                    <input type="text"
                     class="form-control" name="" value="Rp.{{number_format($dt->nominal_transaksi)}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">Sisa Angsuran</label>
                    <input type="text"
                     class="form-control" name="" value="Rp.{{number_format($dt->sisa_angsuran)}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">Tanggal Transaksi</label>
                    <input type="text"
                     class="form-control" name="" value="{{format_tanggal(date('Y-m-d',strtotime($dt->tgl_transaksi)))}}" disabled>
                  </div>

                  @endforeach
                </div>
              </div>
            </section>


            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                   Pemilik Rekening : {{$dt->no_rekening}}
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                  @php
                    $ang = App\Model\Anggota::where('anggota_id',$dt->anggota_id)->get();
                  @endphp
                  @foreach ($ang as $ag)
                  
                  <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text"
                     class="form-control" name="" value="{{$ag->anggota_nama}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">NIK</label>
                    <input type="text"
                     class="form-control" name="" value="{{$ag->anggota_nik}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">No Hp</label>
                    <input type="text"
                     class="form-control" name="" value="{{$ag->anggota_kontak}}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text"
                     class="form-control" name="" value="{{$ag->anggota_alamat_ktp}}" disabled>
                  </div>


                  @endforeach
                </div>
              </div>
            </section>

            {{-- list detail transaksi rekening --}}

            <section class="col-lg-12 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                     List Transaksi Rekening :<b>{{$dt->no_rekening}}</b>
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="data1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Transaksi</th>
                          <th>Jenis Transaksi</th>  
                          <th>Nominal Simpanan</th>  
                          <th>Sisa Angsuran</th>                   

                          <th>Opsi</th>                   
                        </tr>
                      </thead>
                      <tbody> 
                          
                          @php
                              $last =App\Model\SimpananTransaksi::where('no_rekening',$dt->no_rekening)->orderBy('tgl_transaksi','desc')->get();
                          @endphp
                          {{-- data 1 --}}
                          @foreach ($last as $lt)
                        
                          <tr>
                              <td>{{$lt->kode_transaksi}}
                                <br>
                                <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($lt->tgl_transaksi)))}}</small>
                              </td>
                            
                            <td>{{$lt->jenis_transaksi}}</td>
                              <td>Rp.{{number_format($lt->nominal_transaksi)}}</td>
                              <td>Rp.{{number_format($lt->sisa_angsuran)}}</td>

                              <td>
                              <a href="{{url('/admin/transaksi/simpanan-umroh/detail/'.$lt->kode_transaksi)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
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
    
    @endforeach
      
@endsection