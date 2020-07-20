@extends('layouts.main_app')

@section('content')
<div class="content-wrapper">

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Ajukan Peminjaman</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
            <li class="breadcrumb-item active">Ajukan Peminjaman</li>
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
                      <label>Nama Calon Peminjam</label>
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
      
      </div>
    </div>
  </section>
</div> 
@endsection