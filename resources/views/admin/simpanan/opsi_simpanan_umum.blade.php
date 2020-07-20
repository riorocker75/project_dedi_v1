@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Pengaturan Simpanan Sukarela</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Pengaturan Simpanan Sukarela</li>
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
               
              	Simpanan Sukarela
              </h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body">

            	@php 
            	$opsi=App\Model\Simpanan\OpsiSimpanan::all();
              @endphp
              @foreach ($opsi as $xt)
                  
                <form action="{{url('/admin/pengaturan/simpanan-umum/update')}}" method="post"> 
                  @csrf
              	 	<div class="form-group">
                      <label>Biaya Simpanan Pokok</label>
                    <input type="number" class="form-control" value="{{$xt->simpanan_pokok}}" name="pokok" required="">
                        @if($errors->has('pokok'))
                        <small class="text-muted text-danger">
                        {{ $errors->first('pokok')}}
                        </small>
                        @endif 
                   </div>

                    <div class="form-group">
                      <label>Biaya Simpanan Wajib</label>
                    <input type="number" class="form-control" value="{{$xt->simpanan_wajib}}" name="wajib" required="">
                      @if($errors->has('wajib'))
                        <small class="text-muted text-danger">
                        {{ $errors->first('wajib')}}
                        </small>
                        @endif 
                    </div>

                    

                    <div class="form-group">
                      <label>Biaya Buku</label>
                    <input type="number" class="form-control" value="{{$xt->biaya_buku}}" name="buku">
                    </div>

                     <div class="form-group">
                      <label>Biaya Administrasi</label>
                       <input type="number" class="form-control" value="{{$xt->biaya_admin}}" name="admin">
                    </div>

                     <div class="form-group">
                      <label>Minimal Simpanan Sukarela</label>
                       <input type="number" class="form-control" value="{{$xt->sukarela_min}}" name="sukarela" required="">
                        @if($errors->has('sukarela'))
                        <small class="text-muted text-danger">
                        {{ $errors->first('sukarela')}}
                        </small>
                        @endif 
                    </div>

                    <div class="form-group">
                      <label>Bunga pertahun (%)</label>
                    <input type="number" class="form-control" value="{{$xt->bunga}}" name="bunga" minlength="0" maxlength="100">
                      @if($errors->has('bunga'))
                        <small class="text-muted text-danger">
                        {{ $errors->first('bunga')}}
                        </small>
                        @endif 
                    </div>

                    <button class="btn btn-primary float-right" type="submit">Simpan Perubahan&nbsp;&nbsp;<i class="fas fa-save"></i></button>
                    </form> 
                @endforeach

            </div>
          </div>
        </section>

        <section class="col-lg-6 connectedSortable">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
                List 
              </h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body">
                <p class="ket_opsi">Biaya Simpanan Pokok: <b>Rp. {{number_format($xt->simpanan_pokok)}}</b> </p>
                <p class="ket_opsi">Biaya Simpanan Wajib: <b>Rp. {{number_format($xt->simpanan_wajib)}}</b> </p>
                <p class="ket_opsi">Biaya Buku: <b>Rp. {{number_format($xt->biaya_buku)}}</b> </p>
                <p class="ket_opsi">Biaya Administrasi: <b>Rp. {{number_format($xt->biaya_admin)}}</b> </p>
                <p class="ket_opsi">Minimal Sukarela: <b>Rp. {{number_format($xt->sukarela_min)}}</b> </p>
                <p class="ket_opsi">Bunga pertahun: <b>{{number_format($xt->bunga)}} %</b> </p>
            
            </div>  
            </div>  
        </section>
      
      </div>
    </div>
  </section>
</div>


<!-- pengaturan modal -->



<!-- end  -->

@endsection


