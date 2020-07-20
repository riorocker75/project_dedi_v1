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
                    <th>Angsuran Pembiayaan</th>                   

                    <th>Besar Margin</th>                   
                    <th>Opsi</th>                   
                  </tr>
                </thead>
                <tbody> 
                  <?php $no=0 ?>
                  @foreach($kategori as $kat)
                  <?php $no++ ?>                 
                  <tr>
                  
                    <td>{{ $no }}</td>
                    <td>{{ $kat->kategori_jenis }}</td>
                    <td>{{ number_format($kat->kategori_besar_pinjaman) }}</td>
                    <td>{{ $kat->kategori_lama_pinjaman }} Minggu</td>
                    <td>Rp. {{ number_format($kat->kategori_angsuran) }}/minggu</td>

                    <td>{{ $kat->kategori_besar_bunga }}% /bulan</td>                                       
                    <td>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kat_edit{{$kat->kategori_id}}"><i class="fas fa-pencil-alt"></i> Edit</button>
                      <div id="kat_edit{{$kat->kategori_id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">KATEGORI PINJAMAN</h5>
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