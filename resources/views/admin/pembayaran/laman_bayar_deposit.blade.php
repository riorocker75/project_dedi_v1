@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pengguna Simpanan Berjangka</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pengguna Simpanan Berjangka</li>
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
                <div class="card-header">
                  <h3 class="card-title">
                   
                List Data
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                  <table id="data1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Rekening</th>  
                        <th>Status</th>                 
                        <th>Opsi</th>                   
                        </tr>
                    </thead>
                    <tbody> 
                       @php
                           $no=1;
                       @endphp
                       @foreach ($data as $dt)
                       @php
                        $ang= App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                        @endphp
                         <tr>
                            <td>{{$no++}}</td>
                            <td>{{$ang->anggota_nama}}
                              <br><small class="tgl-text">NIK: {{$ang->anggota_nik}}</small>
                              </td>
                            <td>{{$dt->rekening_deposit}}</td>
                            <td>{{cek_status_simpanan($dt->status)}}</td>
                            <td>
                              <?php if($dt->status == 1){?>   
                                <a href="{{url('/admin/pembayaran/simpanan-deposit/detail/'.$dt->rekening_deposit)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                                <?php }else{?>
                                   masih review
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