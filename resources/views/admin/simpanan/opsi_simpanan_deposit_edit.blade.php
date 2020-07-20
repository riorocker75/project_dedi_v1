@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Pengaturan Simpanan Berjangka</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Pengaturan Simpanan Berjangka</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
     
      <div class="row">
        <section class="col-lg-4 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
              	Simpanan Berjangka
              </h3>
              <div class="card-tools">
                {{-- <a data-toggle="modal" data-target="#tambahdeposit"><i class="fa fa-plus"></i> Tambah Data</a> --}}
              </div>
            </div>
            @foreach ($data_awal as $da)
            <div class="card-body">
            <form action="{{url('/admin/pengaturan/simpanan-deposit/update/'.$da->id)}}" method="post">
                @csrf
                    
                
                  <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="number"
                  class="form-control" name="nominal" id="format_rupiah" value="{{$da->nominal_deposit}}" required>
                      <div class="show_rupiah"></div>
                     
                      @if($errors->has('nominal'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('nominal')}}
                          </small>
                      @endif
                  </div>

                  <div class="form-group">
                    <label for="">Periode (Bulan)</label>
                    <input type="number"
                      class="form-control" name="periode" value="{{$da->periode_deposit}}" required>
                    
                      @if($errors->has('periode'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('periode')}}
                          </small>
                      @endif
                  </div>

                  <div class="form-group">
                    <label for="">Bunga (%)</label>
                    <input type="number"
                      class="form-control" name="bunga" value="{{$da->bunga_deposit}}" required>
                    
                      @if($errors->has('bunga'))
                      <small class="text-muted text-danger" >
                          {{ $errors->first('bunga')}}
                          </small>
                      @endif
                  </div>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save    "></i> Simpan Perubahan</button>
                </form>
                
              </div>
              @endforeach   
          </div>
        </section>

        <section class="col-lg-8 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
              	Data Simpanan Berjangka
              </h3>
              <div class="card-tools">
              </div>
            </div>
              <div class="card-body">
                <table id="data1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                      <th>Nominal Depostit</th>
                      <th>Periode Bulan</th>  
                      <th>Bunga (%)</th>                 
                      <th>Nisbah perbulan</th>
                      <th>opsi</th>                   
                      </tr>
                  </thead>
                  <tbody> 
                     @foreach ($data as $dt)
                         
                     <tr>
                       <td>Rp. {{number_format($dt->nominal_deposit)}}</td>
                        
                        <td>{{$dt->periode_deposit}} bulan</td>
                        <td>{{$dt->bunga_deposit}} %</td>
                        <td>Rp.{{number_format($dt->nisbah_bulan)}} /bulan</td>
                        <td>
                        <a href="{{url('/admin/pengaturan/simpanan-deposit/edit/'.$dt->id)}}" style="padding:0 7px"> <i class="fa fa-eye"></i></a>
                        <a href="{{url('/admin/pengaturan/simpanan-deposit/hapus/'.$dt->id)}}" style="padding:0 7px"> <i class="fa fa-trash"></i></a>
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