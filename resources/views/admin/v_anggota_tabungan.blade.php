@extends('layouts.main_app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data anggota</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data anggota</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              @foreach($anggota as $a)  
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('lte/dist/img/user4-128x128.jpg')}}" alt="User profile picture">                
                </div>
                <h3 class="profile-username text-center">{{ $a->anggota_nik }}</h3>
                <p class="text-muted text-center">{{ $a->anggota_nama }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Pekerjaan : </b> <a class="float-right">{{ $a->anggota_pekerjaan }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Kelamin : </b> <a class="float-right">{{ $a->anggota_kelamin }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Telepon</b> <a class="float-right">{{ $a->anggota_kontak }}</a>
                  </li>                  
                </ul>
              </div>
              @endforeach
            </div>
          
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
              <span>Simpanan Anggota</span> 
              <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#simpanan_tambah">Tambah</button>
              <div id="simpanan_tambah" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">KATEGORI SIMPANAN</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      {{-- <form action="/admin/anggota_tabungan_act" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label> JENIS SIMPANAN</label>
                          <select class="form-control" name="jenis" required="required">
                            <option>--Pilih--</option>
                            @foreach($kategori as $sim)  
                            <option>{{ $sim->kategori_jenis }}</option>                           
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label> JUMLAH BIAYA</label>
                          <input type="number" name="besar" required="required" class="form-control">
                        </div>                          
                        <br/>
                        <input type="submit" value="Simpan" class="btn btn-primary">
                      </form> --}}
                    </div>
                  </div>
                </div>
              </div>               
              </div><!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Jenis simpanan</th>
                      <th>Jumlah</th>                      
                    </tr>
                  </thead>
                  <tbody> 
                    <?php $no=0; ?>
                    @foreach($simpanan as $tab)  
                    <?php $no++ ?>               
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $tab->kategori_jenis }}</td>
                      <td>Rp. {{ number_format($tab->simpanan_jumlah) }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>                 
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

</div>
@endsection