@extends('layouts.main_app')
@section('content')
@foreach ($data as $pr)
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Pribadi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
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
               
               Ubah Data
              </h3>
              <div class="card-tools">
               
              </div>
            </div>
            <div class="card-body">
            <form role="form" action="{{url('/admin/detail/anggota/update/')}}/{{$pr->anggota_kode}}" method="post">
                    {{ csrf_field() }}
                    
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $pr->anggota_nama }}">
                            @if($errors->has('nama'))
                            <small class="text-danger">
                                {{ $errors->first('nama')}}
                            </small>
                            @endif  
                        </div>

                        <div class="form-group">
                            <label>Nomot Induk Kependudukan (NIK)</label>
                            {{-- <input type="hidden" class="form-control" name="id" value="{{ $pr->anggota_id }}"> --}}
                            <input type="number" class="form-control" name="nik" value="{{ $pr->anggota_nik }}">
                            @if($errors->has('nik'))
                                <small class="text-danger">
                                {{ $errors->first('nik')}}
                                </small>
                            @endif  
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{ ucfirst($pr->anggota_kelamin) }}" disabled>
                                                       
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?php if($pr->anggota_tanggal_lahir == ""){echo date('Y-m-d');}else{echo date('Y-m-d', strtotime($pr->anggota_tanggal_lahir));}?>">                        
                            @if($errors->has('tanggal_lahir'))
                            <small class="text-danger">
                                {{ $errors->first('tanggal_lahir')}}
                            </small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{$pr->anggota_tempat_lahir}}" required>                        
                            @if($errors->has('tempat_lahir'))
                            <small class="text-danger">
                                {{ $errors->first('tempat_lahir')}}
                            </small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Nama Suami/Istri</label>
                        <input type="text" name="suami_istri" class="form-control" value="{{$pr->suami_istri}}">                        
                        <small class="text-danger">*Kosongkan jika belum menikah / bercerai</small>
                        <br>    
                        @if($errors->has('suami_istri'))
                            <small class="text-danger">
                                {{ $errors->first('suami_istri')}}
                            </small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Alamat KTP</label>
                            <textarea class="form-control" name="alamat_ktp" rows="2">{{$pr->anggota_alamat_ktp}}</textarea>
                            @if($errors->has('alamat_ktp'))
                            <small class="text-danger">
                                {{ $errors->first('alamat_ktp')}}
                            </small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Alamat Sekarang</label>
                            <textarea class="form-control" name="alamat_sekarang" rows="2" >{{$pr->anggota_alamat_sekarang}}</textarea>
                            @if($errors->has('alamat_sekarang'))
                            <small class="text-danger">
                                {{ $errors->first('alamat_sekarang')}}
                            </small>
                            @endif  
                        </div>
                     
                    </div>
                    {{-- end detail anggota --}}
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label>Nomor Hp/Telp</label>
                            <input type="number" class="form-control" name="kontak" value="{{ $pr->anggota_kontak }}">
                            
                            @if($errors->has('kontak'))
                            <small class="text-danger">
                                {{ $errors->first('kontak')}}
                            </small>
                            @endif
                       </div>

                        <div class="form-group">
                            <label>PEKERJAAN</label>
                            <select class="form-control" name="pekerjaan" required="required">
                              @php
                              $kerja = \App\Model\Pekerjaan::all();
                              $kerjax= \App\Model\Pekerjaan::where('id',$pr->anggota_pekerjaan)->first();
                             @endphp
                            
                            <option value="{{ $pr->anggota_pekerjaan}}" selected hidden>{{$kerjax->pekerjaan}}</option>
                            @foreach ($kerja as $kj)
                               <option value="{{$kj->id}}">{{$kj->pekerjaan}}</option>
                             @endforeach
                            </select> 
                         
                           @if($errors->has('pekerjaan'))
                                <small class="text-danger">
                                    {{ $errors->first('pekerjaan')}}
                                </small>
                            @endif
                          </div>
                            
                          <div class="form-group">
                            <label>Gaji/bulan</label>
                            <input type="number" class="form-control" name="gaji" value="{{ $pr->anggota_gaji }}" id="format_rupiah">
                            <div class="show_rupiah"></div>
                            @if($errors->has('gaji'))
                            <small class="text-danger">
                                {{ $errors->first('gaji')}}
                            </small>
                            @endif  
                        </div>

                        <div class="bingkai"  style="margin-top:40px">
                            <div class="judul-bingkai">Pengaturan Akun</div>
                            <div class="form-group">
                                <label style="font-weight: 400!important">Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username" value="{{$pr->anggota_username}}" required="required">
                                    @if($errors->has('username'))
                                    <small class="text-danger">
                                        {{ $errors->first('username')}}
                                    </small>
                                    @endif
                              </div>
                           

                              <div class="form-group">
                                <label style="font-weight: 400!important">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <small class="text-danger">*Kosongkan jika tidak ingin merubah password</small>
                               <br>
                                 @if($errors->has('password'))
                                      <small class="text-danger">
                                          {{ $errors->first('password')}}
                                      </small>
                                  @endif
                              </div>
                            </div>

                        <div class="bingkai" >
                            <div class="judul-bingkai">Kelayakan Pembiayaan</div>
                            <div class="form-group">
                                <label style="font-weight: 400!important">Status Pembiayaan</label>
                                <select class="form-control" name="status_pinjaman" >
                                <option value="{{$pr->status_pinjaman}}" selected hidden>{{layak_pinjam($pr->status_pinjaman)}}</option>
                                  <option value="">--Pilih Kelayakan--</option>
                                  <option value="0">Pratinjau</option>
                                  <option value="1">Layak Pembiayaan</option>
                                  <option value="2">Tidak Layak Pembiayaan</option>

                                </select> 
                                <small class="text-danger">*pilih pratinjau jika belum ada survei langsung</small>
                                <br>
                                @if($errors->has('status_pinjaman'))
                                      <small class="text-danger">
                                          {{ $errors->first('status_pinjaman')}}
                                      </small>
                                  @endif
                              </div>
                        </div>  
                    </div>

                </div>
                <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary float-right">                      
            </form>
            </div>
          </div>
        </section>
      
      </div>
    </div>
  </section>
</div>
   @endforeach 
@endsection