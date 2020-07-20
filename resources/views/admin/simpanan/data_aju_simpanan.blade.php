@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pengaju Simpanan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pengaju</li>
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
                   
                    Simpanan Sukarela
                  </h3>
                  <div class="card-tools">
                  {{-- <a href="{{url('/operator/tambah/mohon/simpanan-umum')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Pemohon</a> --}}
                  </div>
                </div>
                <div class="card-body">
                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Nominal Transaksi</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>AG-827
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                          
                            <td>Rp.200.000</td>
                            <td><label class="badge badge-success">operator Setuju</label></td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        {{-- data 2 --}}
                        <tr>
                            <td>AG-652
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                          
                            <td>Rp.50.000</td>
                            <td><label class="badge badge-success">operator Setuju</label></td>

                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                       

                    </tbody>   
                </table>
                </div>
              </div>
            </section>

            {{-- end simpanan sukarela --}}

            {{-- start simpanan berjangka --}}
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                    Simpanan Berjangka
                  </h3>
                  <div class="card-tools">
                  {{-- <a href="{{url('/operator/tambah/mohon/simpanan-deposit')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Pemohon</a> --}}
                  </div>
                </div>
                <div class="card-body">
                  <table id="data2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Nominal Transaksi</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>AG-827
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>Rp.5.0000.000</td>
                            <td><label class="badge badge-success">operator Setuju</label></td>

                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    </tbody>   
                </table>
                </div>
              </div>
            </section>
            {{-- end simpanan berjangka --}}


            {{-- start simpanan umroh --}}
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                    Simpanan Umroh
                  </h3>
                  <div class="card-tools">
                  {{-- <a href="{{url('/operator/tambah/mohon/simpanan-umroh')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Pemohon</a> --}}
                  </div>
                </div>
                <div class="card-body">
                  <table id="data3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Jenis Simpanan</th> 
                        <th>Setoran perbulan</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>AG-827
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>Tenor 3 tahun</td>
                            <td>Rp.1.800.000</td>
                            <td><label class="badge badge-success">operator Setuju</label></td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    </tbody>   
                </table>
                </div>
              </div>
            </section>
            {{-- end simpanan umroh  --}}

            {{-- start simpanan pendidikan --}}
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                    Simpanan Pendidikan
                  </h3>
                  <div class="card-tools">
                  {{-- <a href="{{url('/operator/tambah/mohon/simpanan-pendidikan')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Pemohon</a> --}}
                  </div>
                </div>
                <div class="card-body">
                  <table id="data4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Anggota</th>
                        <th>Jenis Simpanan Pendidikan</th> 
                        <th>Setoran perbulan</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>AG-827
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>Simpanan Pendidikan SLTA</td>
                            <td>Rp.180.000</td>
                            <td><label class="badge badge-success">operator Setuju</label></td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    </tbody>   
                </table>
                </div>
              </div>
            </section>

            {{-- end simpanan pendidikan --}}
          </div>
        </div>
      </section>
    </div>
    
@endsection