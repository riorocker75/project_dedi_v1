@extends('layouts.main_app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Operator</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Operator</li>
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
              <h3 class="card-title">Data Operator</h3>
              <a href="operator_tambah" class="btn btn-info btn-sm float-right">Tambah Data</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>KELAMIN</th>
                    <th>KONTAK</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody> 

                  <?php $no = 0;?>
                  @foreach($operator as $o) 
                  <?php $no++ ;?>                                
                  <tr>
                   <td>{{ $no }}</td>
                   <td>{{ $o->operator_nomor_pegawai }}</td>
                   <td>{{ $o->operator_nama }}</td>
                   <td>{{ $o->operator_kelamin }}</td>
                   <td>{{ $o->operator_kontak }}</td>
                   <td>
                    <a class="btn btn-info btn-sm" href="operator_edit/{{ $o->operator_id }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a class="btn btn-danger btn-sm" href="operator_hapus/{{ $o->operator_id }}"><i class="fas fa-trash"></i> Delete</a>
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