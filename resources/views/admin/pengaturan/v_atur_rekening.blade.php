@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Pengaturan Rekening</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Pengaturan Rekening</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
            <section class="col-lg-12 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                 Atur
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/pengaturan/rekening/update')}}" method="post">
                        @csrf
                         @php
                             $syarat = App\Model\Option::where('option_name', 'rekening')->first();
                         @endphp   
                        <div class="form-group">
                          <label for="">Rekening</label>
                        <textarea id="editor1" class="form-control" name="rekening" required>{{$syarat->option_value}}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
        
                        </form>
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
       
@endsection