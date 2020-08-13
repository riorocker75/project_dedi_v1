@extends('layouts.main_app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Anggota</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Anggota</li>
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
              <h3 class="card-title">Data Anggota Koperasi</h3>             
            
              <div class="card-tools">
                @if (Session::get('level') == "1")
                <a href="{{url('/admin/anggota/tambah')}}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>&nbsp;Tambah Anggota</a>
                @endif
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Kelamin</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    @if (Session::get('level') == "1")
                    <th>Opsi</th>
                    @endif
                  </tr>
                </thead>
                <tbody> 
                  <?php $no=0; ?>
                  @foreach($anggota as $a)  
                  <?php $no++ ?>               
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $a->anggota_nik }}</td>
                    <td>{{ $a->anggota_nama }}</td>
                    <td>{{ $a->anggota_kelamin }}</td>
                    <td>{{ $a->anggota_kontak }}</td>
                    <td>{{cek_status_anggota($a->status)}}</td>
                    @if (Session::get('level') == "1")
                      <td>                    
                      <a class="btn btn-secondary btn-sm" href="{{url('/admin/detail/anggota/'.$a->anggota_kode)}}"><i class="fas fa-eye"></i> Lihat</a>   
                      <a class="btn btn-danger btn-sm" href="{{url('/admin/detail/anggota/hapus/'.$a->anggota_kode)}}"><i class="fas fa-trash"></i> Delete</a>   
                    </td>
                   @endif
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