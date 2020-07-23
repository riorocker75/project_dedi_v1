@extends('layouts.main_app')
@section('content')
    
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Pemohon Simpanan Berjangka</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Pemohon Simpanan Berjangka</li>
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
                   
                   Tambah Data
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
            
                <div class="card-body">
                    <form action="{{url('/admin/pemohon/simpanan-deposit/tambah/act')}}" method="post">
                        @csrf
                
                        <div class="form-group">
                            <label for="">Nama / Nik</label>
                            <select class="selectpicker form-control form-control-user " name="nama" data-live-search="true" id="anggota" required>
                                <option value="" >--Cari Nama / NIK--</option>
                                @foreach ($data as $dt)
                            <option data-tokens="{{$dt->anggota_nama}} | {{$dt->anggota_nik}}" value="{{$dt->anggota_id}}">{{$dt->anggota_nama}} | {{$dt->anggota_nik}}</option>
                                 @endforeach
                            </select>

                                @if($errors->has('nama'))
                                <small class="text-muted text-danger">
                                {{ $errors->first('nama')}}
                                </small>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="">Jenis Simpanan Berjangka</label>
                            
                            @php
                                $ops= App\Model\Simpanan\OpsiSimpananBerjangka::orderBy('id','asc')->get();
                            @endphp
                            <select class="selectpicker form-control form-control-user " name="nominal" data-live-search="true" id="deposit" required>
                                <option value="" >--Pilih Jenis Simpanan--</option>

                                @foreach ($ops as $op)
                            <option data-tokens="{{$op->nominal_deposit}}" value="{{$op->id}}">Rp.{{number_format($op->nominal_deposit)}} Periode {{$op->periode_deposit}} bulan</option>
                                 @endforeach
                            </select>

                            @if($errors->has('nominal'))
                            <small class="text-muted text-danger">
                            {{ $errors->first('nominal')}}
                            </small>
                            @endif
                        </div>

                        <div id="review_deposit"></div>

                        <button class="btn btn-primary float-right" type="submit" style="display:none" id="tampil_deposit"> <i class="fas fa-save    "></i> Setujui Simpanan</button>
                    </form>   
                </div>
              </div>
            </section>

            <section class="col-lg-6 connectedSortable" id="form_anggota" style="display:none">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                    Detail Peminjam
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
              
                  <div class="card-body">
                     
                    <div id="detail-anggota"></div>
                       
                  </div>
                </div>
              </section>
          
          </div>
        </div>
      </section>
    </div>
@endsection
    