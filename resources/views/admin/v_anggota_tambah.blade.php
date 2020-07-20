@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Tambah Data Penduduk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Data Penduduk</li>
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
                   
                   Data Baru
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/anggota/tambah/act')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" name="nama" required="required">
                                    @if($errors->has('nama'))
                                      <small class="text-muted text-danger">
                                          {{ $errors->first('nama')}}
                                      </small>
                                   @endif
                                </div>

                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="number" class="form-control" name="nik" required="required">
                                    @if($errors->has('nik'))
                                      <small class="text-muted text-danger">
                                          {{ $errors->first('nik')}}
                                      </small>
                                   @endif
                                </div>

                                <div class="form-group">
                                  <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" required="required" value="{{date('Y-m-d')}}">
                                  @if($errors->has('tgl_lahir'))
                                    <small class="text-muted text-danger">
                                        {{ $errors->first('tgl_lahir')}}
                                    </small>
                                 @endif
                              </div>

                              <div class="form-group">
                                <label for="">Tempat Lahir</label>
                              <input type="text" class="form-control" name="tempat_lahir" required="required" >
                                @if($errors->has('tempat_lahir'))
                                  <small class="text-muted text-danger">
                                      {{ $errors->first('tempat_lahir')}}
                                  </small>
                               @endif
                            </div>

                            <div class="form-group">
                              <label>Nama Suami/Istri</label>
                          <input type="text" name="suami_istri" class="form-control">                        
                          <small class="text-danger">*Kosongkan jika belum menikah / bercerai</small>
                          <br>
                          @if($errors->has('suami_istri'))
                              <small class="text-danger">
                                  {{ $errors->first('suami_istri')}}
                              </small>
                              @endif
                          </div>

                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" required="required">
                                    @if($errors->has('alamat'))
                                      <small class="text-muted text-danger">
                                          {{ $errors->first('alamat')}}
                                      </small>
                                   @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select class="form-control" name="kelamin" required="required">
                                        <option value="">Jenis Kelamin</option>
                                        <option value="laki-laki">Laki - Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                      </select> 
                                     
                                     @if($errors->has('kelamin'))
                                          <small class="text-muted text-danger">
                                              {{ $errors->first('kelamin')}}
                                          </small>
                                      @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Kontak</label>
                                    <input type="number" class="form-control" name="kontak" required="required">
                                    @if($errors->has('kontak'))
                                      <small class="text-muted text-danger">
                                          {{ $errors->first('kontak')}}
                                      </small>
                                   @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Pekerjaan</label>
                                    <select class="form-control" name="kerja" required="required">
                                      <option value="">Pilih Pekerjaan</option>
                                     @php
                                        $kerja = \App\Model\Pekerjaan::all();
                                     @endphp
                                     @foreach ($kerja as $kj)
                                    <option value="{{$kj->id}}">{{$kj->pekerjaan}}</option>
                                     @endforeach
                                    </select> 
                                   
                                   @if($errors->has('kerja'))
                                        <small class="text-muted text-danger">
                                            {{ $errors->first('kerja')}}
                                        </small>
                                    @endif
                                  </div>
                                 
                                  <div class="form-group">
                                    <label for="">Gaji/bulan</label>
                                    <input type="number" class="form-control" id="format_rupiah" name="gaji" required="required">
                                    <div class="show_rupiah"></div>
                                     @if($errors->has('gaji'))
                                          <small class="text-muted text-danger">
                                              {{ $errors->first('gaji')}}
                                          </small>
                                      @endif
                                  </div> 

                            </div>
                            {{-- end detail anggota --}}
                            <div class="col-lg-6 col-md-6 col-12">
                              <div class="bingkai">
                                <div class="judul-bingkai">Pengaturan Akun</div>
                                <div class="form-group">
                                    <label style="font-weight: 400!important">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username" required="required">
                                        @if($errors->has('username'))
                                        <small class="text-danger">
                                            {{ $errors->first('username')}}
                                        </small>
                                        @endif
                                  </div>
                               

                                  <div class="form-group">
                                    <label style="font-weight: 400!important">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                                   
                                     @if($errors->has('password'))
                                          <small class="text-danger">
                                              {{ $errors->first('password')}}
                                          </small>
                                      @endif
                                  </div>
                                </div>

                                <div class="bingkai">
                                  <div class="judul-bingkai">Kelayakan Pembiayaan</div>

                                  <div class="form-group">
                                    <label style="font-weight: 400!important">Status Pembiayaan</label>
                                    <select class="form-control" name="status_pinjaman" required="required">
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
                        <button type="submit" class="float-right btn btn-primary"><i class="fas fa-save    "></i> Simpan </button>
                    </form>
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection