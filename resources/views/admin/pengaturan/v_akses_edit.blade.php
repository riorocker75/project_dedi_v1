@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Hak Akses</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
                <li class="breadcrumb-item active">Hak Akses</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
            <section class="col-lg-5 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                 Pengaturan Hak Akses
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                @php
                $akses=App\Model\User::whereIn('level',[1,2,4])->get();
               @endphp

                @foreach ($data as $dt)
                                
                <div class="card-body">
                  <form action="{{url('/admin/pengaturan/akses/update/'.$dt->id)}}" method="post">
                    @csrf
                    @php
                        $peg=App\Model\Operator::orderBy('operator_id','asc')->get();
                    @endphp
                    <div class="form-group">
                      <label for="">Nama Pegawai</label>
                      <select class="form-control form-control-user" disabled>
                        <option value="{{$dt->kode_user}}" selected>{{$dt->nama}}</option>
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="">Hak Akses</label>
                      <select class="form-control" name="akses" required>
                      <option value="{{$dt->level}}" selected hidden>{{akses($dt->level)}}</option>
                        <option value="4">Manager</option>
                        <option value="1">Admin (Asisten Manager)</option>
                        <option value="2">Pengurus</option>
                      </select>
                      @if($errors->has('akses'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('akses')}}
                          </small>
                      @endif          
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                  </form>
                </div>
                @endforeach

              </div>
            </section>


             {{-- data hak akses --}}
             <section class="col-lg-7 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                     Data
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="data1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                          <th>Nama</th>
                          <th>Jabatan</th>  
                          <th>Hak Akses</th>                 
                          <th>Opsi</th>                   
                          </tr>
                      </thead>
                      <tbody> 
                        @foreach ($akses as $ak)
                          @php
                              $jab=App\Model\Operator::where('operator_kode',$ak->kode_user)->first();
                          @endphp
                           <tr>
                              <td>{{$ak->nama}}
                                
                              </td>
                              
                              <td>{{jabatan($jab->jabatan)}}</td>
                            <td>{{akses($ak->level)}}</td>
                              <td>
                              <a href="{{url('/admin/pengaturan/akses/edit/'.$ak->id)}}" style="padding:0 7px"> <i class="fa fa-pen"></i></a>
                              <a href="{{url('/admin/pengaturan/akses/hapus/'.$ak->id)}}" style="padding:0 7px" onclick="return confirm('Anda Yakin Menghapus Data Ini ?')"> <i class="fa fa-trash"></i></a>
  
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