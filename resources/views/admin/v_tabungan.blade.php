@include ('admin/header')
<!-- /.navbar -->

<!-- Main Sidebar Container -->
@include('admin/sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Tabungan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/admin">Home</a></li>
            <li class="breadcrumb-item active">Data Tabungan</li>
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
              <h3 class="card-title">Tabungan</h3>
              <a href="/admin/tabungan_tambah" class="btn btn-info btn-sm float-right">Tambah Data</a>
              <div id="kat_tambah" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">KATEGORI PINJAMAN</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="/admin/kategori_pinjaman_act" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label> JENIS PINJAMAN</label>
                          <input type="text" name="jenis" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                          <label> BESAR PINJAMAN</label>
                          <input type="number" name="besar" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                          <label> LAMA PINJAMAN</label>
                          <input type="number" name="lama" required="required" class="form-control">
                        </div> 
                        <div class="form-group">
                          <label> JUMLAH BUNGA</label>
                          <input type="number" name="bunga" required="required" class="form-control">
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
                    <th>NO</th>
                    <th>NAMA ANGGOTA</th>
                    <th>JENIS TABUNGAN</th>                   
                    <th>JUMLAH TABUNGAN</th>              
                    <!-- <th>OPSI</th>                    -->
                  </tr>
                </thead>
                <tbody> 
                  <?php $no=0 ?>
                  @foreach($tabungan as $tab)
                  <?php $no++ ?>                 
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $tab->anggota_nama }}</td>
                    <td>{{ $tab->kategori_jenis }}</td>
                    <td>Rp. {{number_format($tab->simpanan_jumlah) }}</td>                                   
                    <!-- <td>                      
                      <a class="btn btn-danger btn-sm" href="/admin/kategori_pinjaman_hapus/{{ $tab->simpanan_id }}"><i class="fas fa-trash"></i> Delete</a>  
                    </td> -->
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
@include('admin/footer')