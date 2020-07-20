@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Aju Simpanan Umroh</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Aju Simpanan Umroh</li>
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
                     
                    
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama dan Nik</label>
                            <select name="" class="form-control">
                                   <option value="">Dedi | 985687855</option> 
                            </select>
                          </div> 

                       {{-- buat ajax cek di simpanan umroh detailnya  --}}
                       <div class="form-group">
                        <label for="">Jenis Simpanan Umroh</label>
                        <select name="nominal" class="form-control">
                            <option value="">Tenor 3 Tahun</option>
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
                            <input type="text" id="" class="form-control" value="Rp.600.000" disabled>
                           
                        </div> 
                        <div class="form-group">
                            <label for="">Total Akhir</label>
                            <input type="text" id="" class="form-control" value="Rp.21.600.000" disabled>
                           
                        </div> 

                       
                      {{-- end show data ajax --}}

                      <button class="btn btn-primary float-right" type="submit">Setujui Simpanan Umroh <i class="fa fa-paper-plane"></i></button>
                    </form>
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection