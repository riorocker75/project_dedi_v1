@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Transaksi Simpanan Sukarela</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Transaksi Simpanan Sukarela</li>
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
                   
                  Transaksi Simpanan Sukarela
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
                        <th>Jenis Transaksi</th>  
                        <th>Nominal Transaksi</th>                   
                                        
                                      
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        
                        {{-- data 1 --}}
                        <tr>
                            <td>TRSU-6555
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>886539</td>
                            <td>Simpanan Sukarela</td>
                            <td>Rp.200.000</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        {{-- data 2 --}}
                        <tr>
                            <td>TRSU-2289
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>889665</td>
                            <td>Simpanan Sukarela</td>
                            <td>Rp.50.000</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                         {{-- data 3 --}}
                         <tr>
                            <td>TRSU-6698
                              <br>
                              <small class="tgl-text">14-07-2020</small>
                            </td>
                            <td>889332</td>
                            <td>Simpanan Sukarela</td>
                            <td>Rp.70.000</td>
                            <td>
                            <a href="" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        {{-- data 4 --}}
                        <tr>
                          <td>TRSU-5567
                            <br>
                              <small class="tgl-text">14-07-2020</small>
                          </td>
                          <td>887899</td>
                          <td>Simpanan Sukarela</td>
                          <td>Rp.130.000</td>
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