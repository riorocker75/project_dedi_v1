@extends('layouts.main_app')

@section('content')
<div class="content-wrapper">

<div class="content-header">
    <div class="container-fluid">

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Ajukan Pembiayaan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
            <li class="breadcrumb-item active">Ajukan Pembiayaan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">

     <?php
     $pr=App\Model\Anggota::where('anggota_id',Session::get('ang_id'))->first();
    if($pr->status_pinjaman == 0){
    ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan!!</h5>
    Harap Melakukan Pembayaran Uang Pendaftaran dan Upload Peryaratan Segera!! <a href="{{url('/anggota/verifikasi/bayar')}}">&nbsp;disini</a>
    <br>
    Agar Anda Bisa melakukan Pembiayaan
    </div>
    <?php }else{?>
      {{-- start else jika udah statusnya 1 atau lainya --}}
      <div class="row">
    @php
         $cek_pinjaman=App\Model\Pinjaman::where('anggota_id',Session::get('ang_id'))
                                          ->orderBy('id','desc')
                                          ->first();
      $cek_pj_null=App\Model\Pinjaman::where([
                                               'anggota_id'=>Session::get('ang_id'),
                                               'status_bayar' => 1
                                            ])
                                          ->orderBy('id','desc')
                                          ->get();
    @endphp
        <?php if(count($cek_pj_null) > 0){?>
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i>Mohon Maaf </h5>
              Anda Sedang Dalam Masa Pembiayaan Laman Tidak Tersedia
          <br>
          
          </div>
        <?php }else{?> 
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
              Ajukan
              </h3>
              <div class="card-tools">
               
              </div>
            </div>
            <div class="card-body">
            <form action="{{url('/anggota/ajukan-pact')}}" method="post">
              {{ csrf_field() }}

              <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">

                    <div class="form-group">
                      <label>Nama Calon Pembiyaan</label>
                    <input type="text" class="form-control" value={{Session::get('ang_nama')}} disabled>
                    </div>

                    <div class="form-group">
                      <label>Gaji perbulan</label>
                      @php  
                          $anggota= App\Model\Anggota::where('anggota_id',Session::get('ang_id'))->first();
                      @endphp
                    <input type="text" class="form-control" value=Rp.{{number_format($anggota->anggota_gaji)}} disabled>
                    </div>
                   

                    <div class="form-group">
                      <label>Jenis Pinjaman</label>
                      <select class="form-control" name="lama_angsur" required="required" id="angsur">
                        <option value="">Pilih Sesuai Kesanggupan</option>
                        @foreach ($cat_pinjam as $cp)
                            <option value="{{$cp->kategori_id  }}">Jangka&nbsp;{{$cp->kategori_lama_pinjaman }}&nbsp;Minggu, Bunga {{$cp->kategori_besar_bunga}} % , Limit Pinjaman Rp.{{number_format($cp->kategori_besar_pinjaman)}} </option>
                        @endforeach
                      </select> 
                    </div>
                    @if($errors->has('lama_angsur'))
                    <small class="text-muted text-danger">
                        {{ $errors->first('lama_angsur')}}
                    </small>
                    @endif

                      
                    <div class="form-group">
                      <label for="">Keterangan Usaha</label>
                      <textarea class="form-control" name="ket_usaha" rows="3" required="required"></textarea>
                      @if($errors->has('ket_usaha'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('ket_usaha')}}
                          </small>
                      @endif
                    </div>

                    <div class="form-group">
                      <label for="">Alamat Usaha</label>
                      <input type="text" class="form-control" name="alamat_usaha" required="required">
                      @if($errors->has('alamat_usaha'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('alamat_usaha')}}
                          </small>
                      @endif
                    </div>

                  </div>
                  
                  <div class="col-lg-6 col-md-6 col-12">
                    <div id="skenario-fix"></div>
                  </div>

                  
                </div>
                <button type="submit" class="btn btn-primary float-right" id="ajukan" style="display:none"> Ajukan Pinjaman &nbsp;&nbsp;<i class="fas fa-paper-plane"></i></button>

              </form>
            </div>
          </div>
        </section>
      <?php } ?>
          {{-- end elsenya apabila dia sudah dan sedang melakukan pembiayaan --}}
      </div>
      {{-- end else status pinjaman --}}
    <?php } ?>
    
    </div>
  </section>
</div> 
@endsection