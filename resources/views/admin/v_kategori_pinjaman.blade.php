@extends('layouts.main_app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Kategori Pinjaman</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/admin">Home</a></li>
            <li class="breadcrumb-item active">Data Kategori Pinjaman</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">    
      <div class="row">

        <div class="col-12">
          <div class="card">
            <div class="card-header">              
              <h3 class="card-title">Kategori Pembiayaan</h3>
              <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#kat_tambah">Tambah</button>
              <div id="kat_tambah" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kategori Pembiayaan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="kategori_pinjaman_act" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label> Jenis Pembiayaan</label>
                          <input type="text" name="jenis" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                          <label> Besar Pembiayaan</label>
                          <input type="number" name="besar" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                          <label> Lama Pembiayaan (Minggu)</label>
                          <input type="number" name="lama" required="required" class="form-control">
                        </div> 
                        <div class="form-group">
                          <label> Jumlah Bunga /Bulan (%)</label>
                          <input type="number" name="bunga" required="required" class="form-control" step=".01">
                        </div> 
                        
                        <div class="form-group">
                          <label> Angsuran /Minggu</label>
                          <input type="number" name="angsuran" required="required" class="form-control" >
                        </div> 

                        <div class="form-group">
                          <label> Simpanan Wajib Mingguan</label>
                          <input type="number" name="wajib" required="required" class="form-control" >
                        </div>

                        <div class="form-group">
                          <label> Potongan Wajib (%)</label>
                          <input type="number" name="persen_wajib" required="required" class="form-control" step=".01">
                        </div>

                        <div class="form-group">
                          <label> Uang Potong</label>
                          <input type="number" name="uang_potong" required="required" class="form-control" >
                        </div>
                        
                        <div class="form-group">
                          <label> Dana Kebajikan (%)</label>
                          <input type="number" name="persen_sosial" required="required" class="form-control" step=".01">
                        </div>

                        <div class="form-group">
                          <label> Setoran Perlindungan Pembiayaan (%)</label>
                          <input type="number" name="persen_asuransi" required="required" class="form-control" step=".01">
                        </div>
                      
                        
                        <br/>
                        <input type="submit" value="Simpan" class="btn btn-primary">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Besar Pembiayaan</th>                   
                    <th>Lama Pembiayaan</th> 
                    <th>Angsuran Pembiayaan </th>                   
                    <th>Biaya Lainya</th>                   

                    <th>Besar Margin</th>                   
                    <th>Opsi</th>                   
                  </tr>
                </thead>
                <tbody> 
                  <?php $no=0 ?>
                  @foreach($kategori as $kat)
                  @php
                   $no++ ;
                   $total_terima = $kat->kategori_besar_pinjaman - $kat->uang_potong;  
                   $total_angsur= $kat->kategori_angsuran + $kat->biaya_wajib;
                   $dana_bajik =($kat->persen_sosial /100) * $kat->kategori_besar_pinjaman;
                   $dana_asuransi =($kat->persen_asuransi /100) * $kat->kategori_besar_pinjaman;

                  @endphp
                          
                  <tr>
                  
                    <td>{{ $no }}</td>
                    <td>{{ $kat->kategori_jenis }}</td>
                    <td>{{ number_format($kat->kategori_besar_pinjaman) }}
                    <br>
                    <small>potongan: <b>Rp.{{number_format($kat->uang_potong)}} ({{$kat->persen_potong}}%)</b> </small><br>
                    <small>diterima: <b>Rp.{{number_format($total_terima)}}</b> </small>

                    </td>
                    <td>{{ $kat->kategori_lama_pinjaman }} Minggu</td>
                    <td>Rp. {{ number_format( $total_angsur) }}/minggu
                    <br>
                    <small>Angsuran Pokok : <b>Rp.{{number_format($kat->kategori_angsuran)}}</b>  </small><br>
                    <small>Wajib mingguan : <b>Rp.{{number_format($kat->biaya_wajib)}}</b>  </small><br>

                    </td>
                    <td>
                     <small>
                      Dana Kebajikan : <b>Rp.{{number_format($dana_bajik)}}</b>  
                    </small> <br>
                    <small>
                      Dana SPP : <b>Rp.{{number_format($dana_asuransi)}}</b>  
                    </small>
                    </td>

                    <td>{{ $kat->kategori_besar_bunga }}% /bulan</td>                                       
                    <td>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kat_edit{{$kat->kategori_id}}"><i class="fas fa-pencil-alt"></i> Edit</button>
                      <div id="kat_edit{{$kat->kategori_id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Kategori Pembiayaan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                              <form action="kategori_pinjaman_update" method="post" enctype="multipart/form-data"> 
                                {{ csrf_field() }}
                                <table class="table table-bordered table-hover">
                                  <div class="form-group ">
                                    <tr>
                                      <th width="40%"> Jenis Pembiayaan</th>
                                      <th width="1%">:</th>
                                      <td>
                                        <input type="hidden" name="id" class="form-control" value="{{$kat->kategori_id}}">
                                        <input type="text" name="jenis" class="form-control" value="{{$kat->kategori_jenis}}">
                                      </td>
                                    </tr> 
                                    <tr>
                                      <th width="40%"> Besar Pembiayaan</th>
                                      <th width="1%">:</th>
                                      <td>                                        
                                        <input type="NUMBER" name="besar" class="form-control" value="{{$kat->kategori_besar_pinjaman}}">
                                      </td>
                                    </tr>
                                    <tr>
                                      <th width="40%"> Lama Pembiayaan (Minggu)</th>
                                      <th width="1%">:</th>
                                      <td>                                        
                                        <input type="number" name="lama" class="form-control" value="{{$kat->kategori_lama_pinjaman}}">
                                      </td>
                                    </tr> 

                                    <tr>
                                      <th width="40%"> Besar bunga /Bulan (%)</th>
                                      <th width="1%">:</th>
                                      <td>      
                                                                     
                                        <input type="number" name="bunga" class="form-control" value="{{$kat->kategori_besar_bunga}}">
                                      </td>
                                    </tr>
                                    <tr>
                                      <th width="40%">Angsuran /Minggu</th>
                                      <th width="1%">:</th>
                                      <td>      
                                                                     
                                        <input type="number" name="angsuran" class="form-control" value="{{$kat->kategori_angsuran}}">
                                      </td>
                                    </tr>
                                    <tr>
                                      <th width="40%"> Simpanan Wajib Mingguan</th>
                                      <th width="1%">:</th>
                                      <td>      
                                                                     
                                        <input type="number" name="wajib" class="form-control" value="{{$kat->biaya_wajib}}">
                                      </td>
                                    </tr>

                                    <tr>
                                      <th width="40%"> Potongan Wajib (%)</th>
                                      <th width="1%">:</th>
                                      <td>      
                                                                     
                                        <input type="number" name="persen_wajib" class="form-control" value="{{$kat->persen_potong}}">
                                      </td>
                                    </tr>

                                    <tr>
                                      <th width="40%"> Uang Potong </th>
                                      <th width="1%">:</th>
                                      <td>      
                                        <input type="number" name="uang_potong" class="form-control" value="{{$kat->uang_potong}}">
                                      </td>
                                    </tr>

                                    <tr>
                                      <th width="40%">Dana Kebajikan (%) </th>
                                      <th width="1%">:</th>
                                      <td>      
                                        <input type="number" name="persen_sosial" class="form-control" value="{{$kat->persen_sosial}}">
                                      </td>
                                    </tr>
                                    <tr>
                                      <th width="40%">Setoran Perlindungan Pembiayaan (%) </th>
                                      <th width="1%">:</th>
                                      <td>      
                                        <input type="number" name="persen_asuransi" class="form-control" value="{{$kat->persen_asuransi}}">
                                      </td>
                                    </tr>
                                  

                                                                     
                                  </div>                
                                </table> 
                                <br/>
                                <input type="submit" value="Update" class="btn btn-primary">
                              </form>
                            </div>                      
                          </div>
                        </div>
                      </div>
                      <a class="btn btn-danger btn-sm" href="kategori_pinjaman_hapus/{{ $kat->kategori_id }}"><i class="fas fa-trash"></i> Delete</a>  
                    </td>
                  </tr>
                  @endforeach
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

@endsection