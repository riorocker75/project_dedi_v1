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
                <li class="breadcrumb-item"><a href="{{ url('/operator/data-pinjaman')}}">Data Pengaju</a></li>
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
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                   Lihat data
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                 @foreach ($data as $dpj)
                    <form action="{{url('/operator/review-act/'.$dpj->id.'')}}" method="post">
                        @csrf
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

                              
                              <div class="form-group">
                                
                                <label>Keterangan Usaha</label>
                              <textarea class="form-control" rows="3" disabled>{{$dpj->ket_usaha}}</textarea>
                            </div>

                            <div class="form-group">
                              
                              <label>Alamat Usaha</label>
                            <textarea class="form-control" rows="3" disabled>{{$dpj->alamat_usaha}}</textarea>
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
                                  <label>Nomor Hp/Telp</label>
                                  <input type="text" class="form-control" value="{{ $pr->anggota_kontak}}" disabled>
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

                             @endforeach

                             <div class="form-group">
                                <label>Keterangan Pinjaman</label>
                                <textarea class="form-control" name="ket" rows="2" placeholder="Isi keterangan dengan kelengkapan persyaratan atau alasan menolak" required></textarea>
                            </div>
                             
                                @if($errors->has('ket'))
                                <div class="text-danger">
                                    {{ $errors->first('ket')}}
                                </div>
                                @endif 
                        </div>
                        {{-- end data pribadi --}}
                    </div>

                    
                    <button class="btn btn-primary float-right" type="submit" name="action" value="terima">Setujui</button>
                    <button class="btn btn-default float-right" style="margin-right:10px" type="submit" name="action" value="tolak"> Tolak Pinjaman</button>
                    
                    </form>
                @endforeach
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
    
@endsection