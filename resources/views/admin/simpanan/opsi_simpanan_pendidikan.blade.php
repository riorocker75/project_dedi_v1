@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Pengaturan Simpanan Pendidikan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Pengaturan Simpanan Pendidikan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
     
      <div class="row">
        <section class="col-lg-3 col-md-12 col-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
              	Simpanan Pendidikan
              </h3>
              <div class="card-tools">
                {{-- <a data-toggle="modal" data-target="#tambahdeposit"><i class="fa fa-plus"></i> Tambah Data</a> --}}
              </div>
            </div>
            <div class="card-body">
            <form action="{{url('/admin/pengaturan/simpanan-pendidikan/tambah')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="">Nama Jenis</label>
                    <input type="text"
                      class="form-control" name="jenis" required>
                  
                      @if($errors->has('jenis'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('jenis')}}
                          </small>
                      @endif
                  </div>
                  <div class="form-group">
                    <label for="">Angsuran perbulan</label>
                    <input type="number"
                      class="form-control" name="nominal" id="format_rupiah" required>
                      <div class="show_rupiah"></div>
                     
                      @if($errors->has('nominal'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('nominal')}}
                          </small>
                      @endif
                  </div>

                  <div class="form-group">
                    <label for="">Tenor (tahun)</label>
                    <input type="number"
                      class="form-control" name="periode" min="1" required>
                    
                      @if($errors->has('periode'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('periode')}}
                          </small>
                      @endif
                  </div>
                
                  <div class="form-group">
                    <label for="">Bagi Hasil Perthaun (%)</label>
                    <input type="number"
                      class="form-control" name="bunga" step=".01" required>
                    
                      @if($errors->has('bunga'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('bunga')}}
                          </small>
                      @endif
                  </div>
                  <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>

                  
            </form>



            </div>
          </div>
        </section>

        <section class="col-lg-9 col-md-12 col-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
              	Data Simpanan Umroh
              </h3>
              <div class="card-tools">
              </div>
            </div>
              <div class="card-body">
                <table id="data1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th width="30%">Nama Jenis Simpanan</th>
                      <th>Angsuran Perbulan</th>
                      <th width="2%">Nisbah (%)</th> 
                      <th width="2%">Tenor (Tahun)</th>  

                     
                      <th>Opsi</th>                   
                      </tr>
                  </thead>
                  <tbody> 
                     @foreach ($data as $dt)
                         
                     <tr>
                       <td>{{$dt->jenis_simpanan}}</td>
                        
                        <td>Rp.{{number_format($dt->angsuran_simpanan)}} /bulan
                            <br>
                            <small>
                                total:
                                Rp. {{number_format($dt->total_simpanan)}} + nisbah {{$dt->bunga}}%
                            </small>
                        </td>
                        <td>{{$dt->bunga}}%/tahun</td>

                        <td>{{$dt->jangka_simpanan}} tahun</td>
                     
                        <td>
                        <a href="{{url('/admin/pengaturan/simpanan-pendidikan/edit/'.$dt->id)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                        <a href="{{url('/admin/pengaturan/simpanan-pendidikan/hapus/'.$dt->id)}}" style="padding:0 7px"> <i class="fa fa-trash"></i></a>
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

{{-- modal tambah deposit --}}
<div class="modal" tabindex="-1" role="dialog" id="tambahdeposit">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Simpanan Berjangka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('')}}" method="post">
        @csrf
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form> 
    </div>
  </div>
</div>

@endsection