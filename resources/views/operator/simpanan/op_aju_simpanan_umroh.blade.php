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
                    <div class="float-right">
                      <a  data-toggle="modal" data-target="#pesan_umroh" class="btn btn-block btn-outline-info">Kirim Pesan &nbsp;&nbsp;<i class="fa fa-comment"></i></a>
                    </div>
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
    

    <!-- Modal pesan datang ke koperasi-->
<div class="modal fade" id="pesan_umroh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan Ke Pemohon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{url('/operator/detail/aju/simpanan-umroh/pesan/act')}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Isi Pesan</label>
            <textarea name="pesan"  placeholder="misal: Harap datang besok jam 8 pagi"  class="form-control" rows="2" required></textarea>
          </div>
        <input type="text" value="{{ $ang->anggota_kode}}" name="ang_kode" hidden>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Kirim Pesan</button>
        </div>
    </form>
    </div>
  </div>
</div>
@endsection