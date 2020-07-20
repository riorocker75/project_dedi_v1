@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Data Pekerjaan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pekerjaan</li>
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
                   
                  Tambah Nama Pekerjaan
                  </h3>
                 
                </div>
                <div class="card-body">
                <form action="{{url('/admin/pekerjaan/tambah-act')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pekerjaan</label>
                          <input type="text" class="form-control"placeholder="misal:PNS" name="kerja" required>
                          </div>
                          @if($errors->has('kerja'))
                          <div class="text-danger">
                              {{ $errors->first('kerja')}}
                          </div>
                          @endif

                         <button type="submit" class="btn btn-primary float-right" ><i class="fas fa-save"></i>&nbsp;Simpan</button>
                    </form>
                </div>
              </div>
            </section>

            <section class="col-lg-8 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                    Data Pekerjaan
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                           
                            <th>Nama Pekerjaan</th>
                                       
                            <th>Opsi</th>                   
                          </tr>
                        </thead>
                        <tbody> 
                            @php
                                $no=1;
                            @endphp
                          @foreach ($data_kerja as $cp)
                            <tr>
                            <td>{{$no++}}</td>
                            <td>{{$cp->pekerjaan}}</td>
                            <td>
                                 <a href="{{url('/admin/pekerjaan/delete-act/'.$cp->id.'')}}" > <i class="fa fa-trash" ></i></a>
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