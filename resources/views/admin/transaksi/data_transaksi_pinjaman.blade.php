@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Transaksi Pembiayaan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi Pembiayaan</li>
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
                   
                   Seluruh Transaksi Pembiayaan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Kode Pembiayaan</th>
                            <th>Nama</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nominal Yang Dibayar</th>  
                            <th>Total Angsuran</th>                   
                            <th>Sisa Angsuran</th>                   
                            <th>Keterangan </th>                   
                            <th>Opsi</th>                   
                          </tr>
                        </thead>
                        <tbody> 
                            
                        @foreach ($data as $dt)
                            @php
                                $cad=App\Model\PinjamanTransaksi::where('id',$dt->id)->first();
                                $tbl_pinjaman=App\Model\Pinjaman::where('pinjaman_kode',$dt->pinjaman_kode)->first();
                                $total_angsur = $tbl_pinjaman->pinjaman_skema_angsuran * $tbl_pinjaman->pinjaman_angsuran_lama;
                                $ang= App\Model\Anggota::where('anggota_id',$tbl_pinjaman->anggota_id)->first();

                            @endphp

                            {{-- data 1 --}}
                            <tr>
                                <td>{{$dt->pinjaman_kode}}
                                    <br>
                                <small class="tgl-text"></small>
                                </td>
                                <td>{{$ang->anggota_nama}}
                                  <br><small class="tgl-text">NIK: {{$ang->anggota_nik}}</small>
                                  </td>
                                <td>{{format_tanggal(date('Y-m-d',strtotime($cad->tgl_transaksi)))}}</td>
                                <td>Rp.{{number_format($cad->nominal_bayar)}}
                                <br><small>Kembalian: Rp.{{number_format($cad->kembalian_bayar)}}</small>
                                </td>
                                <td>Rp. {{number_format($total_angsur)}}</td>
                                <td>Rp. {{number_format($cad->sisa_bayar)}}</td>
                                <td>{{$cad->ket_bayar}}</td>
                                <td>
                                <a href="{{url('/admin/pembayaran/pinjaman/detail/'.$dt->pinjaman_kode)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
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