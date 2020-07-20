@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Transaksi Simpanan Pendidikan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi Simpanan Pendidikan</li>
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
                   
                 Seluruh Transaksi Simpanan Pendidikan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Transaksi</th>
                        <th>Nomor Rekening</th>
                        <th>Tenor (Tahun)</th> 
                        <th>Jenis Simpanan</th>  

                        <th>Setoran/bulan</th> 
                        <th>Sisa Bayar</th> 
                        <th>Status</th>                   
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>
                              TRPD-5698
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>846588</td>
                            <td>3 tahun</td>
                            <td>SMA</td>

                            <td>Rp.180.000</td>
                            <td>Rp.7.259.040</td>
                            <td> <label class="badge badge-warning">Masa cicilan</label></td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        {{-- data 2 --}}
                        <tr>
                            <td>TRPD-4836
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>843895</td>
                            <td>3 tahun</td>
                            <td>SMA</td>

                            <td>Rp.180.000</td>
                            <td>Rp.7.259.040</td>
                            <td> <label class="badge badge-warning">Masa cicilan</label></td>

                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                         {{-- data 3 --}}
                         <tr>
                            <td>TRPD-4278
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>847825</td>
                            <td>3 tahun</td>
                            <td>Kuliah</td>

                            <td>Rp.300.000</td>
                            <td>Rp.12.098.400</td>
                            <td> <label class="badge badge-warning">Masa cicilan</label></td>

                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        {{-- data 4 --}}
                       

                    </tbody>   
                </table> 
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
    
@endsection