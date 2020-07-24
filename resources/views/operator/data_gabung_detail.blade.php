@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Detail Pemohon Anggota</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pemohon</li>
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
                   
                  Review Data Pemohon
                  </h3>
                 
                </div>
                <div class="card-body">
                    @foreach ($anggota as $ag)
                <form action="{{url('/operator/gabung-act/'.$ag->anggota_id.'')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" value="{{$ag->anggota_nama}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" class="form-control" value="{{$ag->anggota_nik}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="{{ucfirst($ag->anggota_kelamin)}}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" value="{{ucfirst($ag->anggota_alamat_ktp)}}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Kontak</label>
                                <input type="text" class="form-control" value="{{$ag->anggota_kontak}}" disabled>
                            </div>

                          
                        </div> 
                        
                        <div class="col-lg-6 col-md-6 col-12">
                            @php
                            $kerja=App\Model\Pekerjaan::where('id', $ag->anggota_pekerjaan)->first();
                            @endphp
                            <div class="form-group">
                                <label for="">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{$kerja->pekerjaan}}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Gaji/bulan</label>
                                <input type="text" class="form-control" value="Rp. {{number_format($ag->anggota_gaji)}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Status Kelayakan Pembiayaan</label>
                                <select name="status_pinjam" class="form-control" required>
                                    <option value="">--Pilih Status--</option>
                                    <option value="0">Tahap Review</option>
                                    <option value="1">Layak Pembiayaan</option>
                                    <option value="2">Tidak Layak Pembiayaan</option>

                                </select>
                                @if($errors->has('status_pinjam'))
                                <small class="text-muted text-danger">
                                    {{ $errors->first('status_pinjam')}}
                                </small>
                                @endif 
                            </div>

                        </div>
                    </div>    
                    <div class="float-right">
                        <button class="btn btn-primary float-right" type="submit" name="action" value="terima">Setujui Bergabung</button>
                        <button class="btn btn-default float-right" style="margin-right:10px" type="submit" name="action" value="tolak"> Tolak Bergabung</button>
                        
                    </div>
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