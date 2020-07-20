@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Transaksi Simpanan Berjangka</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi Simpanan Berjangka</li>
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
                   
                 Seluruh Transaksi Simpanan Berjangka
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
                        <th>Periode</th>  
                        <th>Nominal Simpanan</th>                   
                        <th>Bagi Hasil</th>                   
                        <th>Nisbah/bulan</th>                   
                                      
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>TRBJ-5698
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>886539</td>
                            <td>12 bulan</td>
                            <td>Rp.200.000.000</td>
                            <td>10%</td>
                            <td>Rp.1.666.667</td>

                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        {{-- data 2 --}}
                        <tr>
                            <td>TRBJ-4736
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>889665</td>
                            <td>12 bulan</td>
                            <td>Rp.50.000.000</td>
                            <td>10%</td>
                            <td>Rp.416.667</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                         {{-- data 3 --}}
                         <tr>
                            <td>TRBJ-5378
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>889332</td>
                            <td>12 bulan</td>
                            <td>Rp.100.000.000</td>
                            <td>10%</td>
                            <td>Rp.833.333</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        {{-- data 4 --}}
                        <tr>
                          <td>TRBJ-9834
                            <br>
                              <small class="tgl-text">14-07-2020</small>
                          </td>
                          <td>887899</td>
                          <td>12 bulan</td>
                          <td>Rp.450.000.000</td>
                          <td>10%</td>
                          <td>Rp.3.750.000</td>
                          <td>
                          <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                          </td>
                      </tr>

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