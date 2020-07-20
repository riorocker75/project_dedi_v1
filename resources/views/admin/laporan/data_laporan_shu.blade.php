@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Laporan Sisa Hasil Usaha</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Laporan Sisa Hasil Usaha</li>
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
               
              Laporan
              </h3>
              <div class="card-tools">
               
              </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <select name="" class="form-control">
                                   <option value="">Juli</option> 
                            </select>
                          </div> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="" class="form-control">
                                   <option value="">2020</option> 
                            </select>
                          </div> 
                    </div>
                </div>
                {{-- end row  --}}

                <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Laporan</th>
                        <th>Pendapatan Kotor</th>
                        <th>Pengeluaran </th>
                        <th>Ket </th>                   

                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                    <tbody> 
                        <tr>
                        <td>LPR-9822</td>
                        <td>Rp. 14.000.000</td>
                        <td>Rp. 4.000.000 </td>
                        <td>Pembelian Token Listrik, Transport Pengurus</td>
                          <td>
                              <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>LPR-9822</td>
                            <td>Rp. 9.000.000</td>
                            <td>Rp. 2.000.000 </td>
                            <td>Pembayaran Pajak </td>
                              <td>
                                  <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
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