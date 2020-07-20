@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pengaju Pinjaman</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pinjaman</li>
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
                   
                  List data peminjam
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
               
                  <table class="table table-bordered table-striped">
                   
                    @php
                        $no=1;
                        $ntahun = 1;
                        $ntahun1 = 1;

                        $bulan=24;
                        $bayar=9450000;
                        $angsuran =393750;
                        $end = strtotime(date("Y-m-01"));
                        $start = $month = strtotime("+1 months", $end);

                        
                    @endphp
                    
                    <thead>
                       <div style="padding:15px;text-align:center;font-size:16px;border:1px solid #c1c2c3">
                          <b> Tabel Angsuran</b>
                       </div>
                        <tr>
                            <th>Bulan Ke</th>
                            <th>Bulan</th>
                            <th>Total Pinjaman</th>
                            <th>Angsuran Perbulan</th>
                            <th>Saldo Total Pinjaman</th>

                        </tr>
                    </thead>
                    @for ($i = 0; $i < $bulan; $i++)
                    
                    <tbody> 
                        <tr>
                            <td>{{$no++}}</td>   
                        <td>
                            @php
                                echo date("Y-m-d", $month);
                             $month = strtotime("+1 month", $month);
                            @endphp
                            

                        </td>
                       {{-- total pinjaman --}}
                        <td>
                            <?php
                            do {
                                $ntahun1++;
                                $bayar1=$bayar+$angsuran;
                                $bayar1 -= $angsuran;
                            ?>
                         {{number_format($bayar1)}}
                         <?php   }while($ntahun1 < 0); ?>  
                        </td>
                        {{-- end total pinjaman --}}

                        <td>Rp. {{number_format($angsuran)}}</td>

                        {{-- saldo Pinjaman --}}
                        <td>
                            <?php
                            do {
                                $ntahun++;
                                $bayar -= $angsuran;
                        ?>
                         {{number_format($bayar)}}
                         <?php   }while($ntahun < 0); ?>  
                        </td>
                        {{-- end saldo pinjaman --}}
                    </tbody>
                    
                    @endfor 
                </table> 
         
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
@endsection