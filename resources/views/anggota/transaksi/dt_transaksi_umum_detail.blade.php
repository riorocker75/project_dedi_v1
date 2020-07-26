@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Simpanan Umum </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Simpanan Umum </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
        
          <div class="row">
             
                  
            
              <section class="col-lg-6 connectedSortable">
                <div class="card">
                 @foreach ($data_sim as $ds)
                        
                  <div class="card-header">
                    <h3 class="card-title">
                     
                     Detail Tabungan <b>{{$ds->no_rekening}}</b> 
                    </h3>
                    <div class="card-tools">
                     <div class="float-right">
                         <a href="{{url('/anggota/simpanan-umum/transfer/'.$ds->no_rekening)}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-credit-card"></i> Bayar Tabungan </a>
                     </div>
                    </div>
                  </div>
                  <div class="card-body">
                    
                    <div class="form-group">
                      <label for="">Total Simpanan Pokok</label>
                      <input type="text"
                    class="form-control" value="Rp.{{number_format($ds->jlh_pokok)}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Total Simpanan Wajib</label>
                        <input type="text"
                      class="form-control" value="Rp.{{number_format($ds->jlh_wajib)}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="">Total Simpanan Sukarela</label>
                        <input type="text"
                      class="form-control" value="Rp.{{number_format($ds->total_simpanan)}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="">Tanggal Buka Rekening</label>
                        <input type="text"
                      class="form-control" value="{{format_tanggal(date('Y-m-d',strtotime($ds->tgl_buka_rek)))}}" disabled>
                      </div>
                  </div>
                  @endforeach
                </div>
              </section>
         




              <section class="col-lg-12 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                    History Transaksi
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">

                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Kode Transaksi</th>
                            <th>Jenis Transaksi</th> 
                            <th>Keterangan</th>  
                            <th>Nominal Transaksi</th>  
               
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($data as $dt)
                             <tr>
                                <td>{{$dt->kode_transaksi}}
                                    <br>
                                    <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($dt->tgl_transaksi)))}}</small>
                                </td>
                                
                                <td>{{$dt->jenis_transaksi}}</td>
                                <td>{{$dt->ket_transaksi}}</td>
                                <td>
                                    <?php if($dt->status == 1){?>
                                        <div style="color:green">
                                            + Rp. {{number_format($dt->nominal_transaksi)}} 
                                        </div>    
                                        <?php }elseif($dt->status ==2){?>
                                            <div style="color:red">
                                                - Rp. {{number_format($dt->nominal_transaksi)}} 
                                            </div>
                                        <?php }?>   
                                </td>
                             </tr>
                             @endforeach
                    
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