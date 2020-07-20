@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Tambah Anggota Simpanan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Anggota Simpanan</li>
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
                   
                    Data Lengkap Pengaju
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <label>Nama Anggota</label>
                              <select  class="selectpicker form-control form-control-user" name="nama_anggota" data-live-search="true" required>
                                <option value="">Cari Berdasarkan Nama / Nik </option>
                                  @foreach ($anggota as $ag)
                                    <option value="{{$ag->anggota_id}}" data-tokens="{{$ag->anggota_nama}} | {{$ag->anggota_nik}}">{{$ag->anggota_nama}} | {{$ag->anggota_nik}}</option>
                                  @endforeach
                              </select>
                              @if($errors->has('nama_anggota'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('nama_anggota')}}
                                </small>
                              @endif
                            </div>

                            {{-- <div class="form-group">
                              <label for=""></label>
                              <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div> --}}

                        </div>
                        <div class="col-lg-6 col-md-6 col-12"></div>
                      </div>
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection