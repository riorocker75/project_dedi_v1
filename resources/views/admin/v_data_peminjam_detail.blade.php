@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Lengkap Pinjaman</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/admin/data-pinjaman')}}">Data Pengaju</a></li>
                <li class="breadcrumb-item active">Data Pribadi</li>
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
                   
                   Lihat data
                  </h3>
                  <div class="card-tools">
                    <label class="badge badge-success">{{status_pinjaman($dpj->pinjaman_status)}}</label>
                  </div>
                </div>
                <div class="card-body">
                   
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
                                <label>Angsuran per Minggu</label>
                                <input type="text" class="form-control" value="Rp.{{ number_format($dpj->pinjaman_skema_angsuran)}}" disabled>
                              </div>

                              <div class="form-group">
                              <label>Nisbah selama {{$dpj->pinjaman_angsuran_lama}} Minggu</label>
                                @php
                                    $nilai_angsur=$dpj->pinjaman_skema_angsuran;
                                    $nilai_untung=$nilai_angsur * $dpj->pinjaman_angsuran_lama;
                                    $hasil_bersih= $nilai_untung - $dpj->pinjaman_jumlah;

                                    $bulan_total=$dpj->pinjaman_angsuran_lama / 4.345;
                                    $total_bunga= round($bulan_total * $dpj->pinjaman_bunga);

                                    $total_bayar=$dpj->pinjaman_jumlah + $hasil_bersih;
                                @endphp
                                <input type="text" class="form-control" value="Rp.{{number_format($hasil_bersih)}} ( {{ $total_bunga}}% )" disabled>
                              </div>
                              <div class="form-group">
                                <label>Total Di bayarkaan</label>
                                <input type="text" class="form-control" value="Rp.{{ number_format($total_bayar)}}" disabled>
                              </div>
                        </div>
                        {{-- end data pinjman --}}
                        {{-- data pribadi peminjam --}}
                        <div class="col-lg-6 col-md-12 col-12">
                            @foreach ($pribadi as $pr)
                                
                                <div class="form-group">
                                    <label>Nama </label>
                                    <input type="text" class="form-control" value="{{ $pr->anggota_nama}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control" value="{{ $pr->anggota_nik}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Alamat </label>
                                    <input type="text" class="form-control" value="{{ $pr->anggota_alamat_ktp}}" disabled>
                                </div>

                                <div class="form-group">
                                  @php
                                  $kerjax= \App\Model\Pekerjaan::where('id',$pr->anggota_pekerjaan)->first();
                                 @endphp
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" value="{{ $kerjax->pekerjaan}}" disabled>
                                </div>

                                
                                <div class="form-group">
                                
                                    <label>Gaji/bulan</label>
                                    <input type="text" class="form-control" value="Rp.{{ number_format($pr->anggota_gaji)}}" disabled>
                                </div>

                                <div class="form-group">
                                
                                    <label>Keterangan Operator</label>
                                    <textarea rows="3"  class="form-control" disabled>{{ $dpj->pinjaman_ket}}</textarea>
                                </div>
                             @endforeach

                        </div>
                        {{-- end data pribadi --}}
                    </div>

                  
                  </div>
                </div>
              </section>
              @endforeach
          
          </div>
        </div>
      </section>
    </div>
    
    
@endsection