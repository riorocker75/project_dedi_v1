@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Aju Simpanan Pendidikan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Aju Simpanan Pendidikan</li>
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
          Agar Anda Bisa melakukan Simpanan Pendidikan
          </div>
          <?php }else{?>
            {{-- start else jika udah statusnya 1 atau lainya --}}
          <div class="row">
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Ajukan permohonan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    @php
                        $dt = App\Model\Anggota::where('anggota_id',Session::get('ang_id'))->first();
                    @endphp  
                    
                    <form action="{{url('/anggota/ajukan/simpanan-pendidikan/act')}}" method="post">
                        @csrf
                       <div class="form-group">
                         <label for="">Nama</label>
                       <input type="text" name="ang_id" value="{{$dt->anggota_id}}" hidden>
                       <input type="text" name="nama" class="form-control" value="{{$dt->anggota_nama}}" disabled>
                       </div> 

                       {{-- buat ajax cek di simpanan pendidikan detailnya  --}}
                       <div class="form-group">
                        <label for="">Jenis Simpanan Pendidikan</label>
                          <select name="nominal" class="form-control" id="pendidikan" required>
                          @php
                          $pend_list=App\Model\Simpanan\OpsiSimpananLain::where('kode_simpanan','SPN')->orderBy('id','asc')->get();
                          @endphp

                        <option value="">--Pilih Jenis Simpanan Pendidikan--</option>

                          @foreach ($pend_list as $pd)
                              
                            <option value="{{$pd->id}}">{{$pd->jenis_simpanan}}</option>
                          @endforeach
                          </select>
                        
                            @if($errors->has('nominal'))
                            <small class="text-muted text-danger">
                            {{ $errors->first('nominal')}}
                            </small>
                            @endif
                         </div> 

                         {{-- disini dibuat show data aja --}}
                         <div id="review_pendidikan"></div>
                       
                      {{-- end show data ajax --}}

                      <button class="btn btn-primary float-right" type="submit" id="tampil_pendidikan" style="display:none" >Ajukan Simpanan Pendidikan<i class="fa fa-paper-plane"></i></button>
                    </form>
                </div>
              </div>
            </section>
          
          </div>
             {{-- end else status pinjaman --}}
             <?php } ?>
        </div>
      </section>
    </div>
    
@endsection