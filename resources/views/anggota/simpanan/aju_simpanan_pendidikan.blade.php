@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Aju Simpanan Pendidikan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Aju Simpanan Pendidikan</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Ajukan permohonan
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                    @php
                        $dt = App\Model\Anggota::where('anggota_id',Session::get('ang_id'))->first();
                    @endphp  
                    
                    <form action="" method="post">
                        @csrf
                       <div class="form-group">
                         <label for="">Nama</label>
                       <input type="text" name="nama" id="" class="form-control" value="{{$dt->anggota_nama}}" disabled>
                       </div> 

                       {{-- buat ajax cek di simpanan pendidikan detailnya  --}}
                       <div class="form-group">
                        <label for="">Jenis Simpanan Pendidikan</label>
                        <select name="nominal" class="form-control">
                            <option value="">Pendidikan SLTA</option>
                            <option value="">--pilih tenor--</option>

                        </select>
                         </div> 

                         {{-- disini dibuat show data aja --}}
                         <div class="form-group">
                            <label for="">Lama Setoran</label>
                            <input type="text" id="" class="form-control" value="3 tahun" disabled>
                           
                        </div> 
                         <div class="form-group">
                            <label for="">Setoran perbulan</label>
                            <input type="text" id="" class="form-control" value="Rp.180.000" disabled>
                           
                        </div> 
                        <div class="form-group">
                            <label for="">Total Simpanan AKhir</label>
                            <input type="text" id="" class="form-control" value="Rp.7.439.040" disabled>
                           
                        </div> 

                       
                      {{-- end show data ajax --}}

                      <button class="btn btn-primary float-right" type="submit">Ajukan Simpanan Pendidikan<i class="fa fa-paper-plane"></i></button>
                    </form>
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection