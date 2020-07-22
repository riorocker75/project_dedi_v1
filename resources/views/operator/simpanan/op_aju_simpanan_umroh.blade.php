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
                     
                    @foreach ($data as $dt)
                        
                    <form action="{{url('/operator/aju/simpanan-umroh/act/'.$dt->no_rekening)}}" method="post">
                        @csrf
                        @php
                        $ops=App\Model\Simpanan\OpsiSimpananLain::where('kode_simpanan','SUH')->orderBy('id','asc')->get();
                        $ops_e=App\Model\Simpanan\OpsiSimpananLain::where('id',$dt->opsi_simpanan_lain_id)->first();
  
                          $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                        @endphp
                        <div class="form-group">
                            <label for="">Nama dan Nik</label>
                            <input type="text" class="form-control" value="{{$ang->anggota_nama}} | {{$ang->anggota_nik}}" disabled>
                          </div> 

                       {{-- buat ajax cek di simpanan umroh detailnya  --}}
                       <div class="form-group">
                        <label for="">Jenis Simpanan Umroh</label>
                        <select name="nominal" class="form-control" required>
                        <option value="{{$ops_e->id}}" hidden selected>{{$ops_e->jenis_simpanan}} Tenor {{$ops_e->jangka_simpanan}} tahun</option>
                           @foreach ($ops as $op)
                        <option value="{{$op->id}}">{{$op->jenis_simpanan}} Tenor {{$op->jangka_simpanan}} tahun</option>
                               
                           @endforeach

                        </select>
                         </div> 
                         <input type="text" value="{{$dt->anggota_id}}" name="ang_id" hidden>

                         {{-- disini dibuat show data aja --}}
                         
                         <div class="form-group">
                            <label for="">Lama Setoran</label>
                         <input type="text"  class="form-control" value="{{$dt->jangka_umroh}} tahun" disabled>
                           
                        </div> 
                         <div class="form-group">
                            <label for="">Setoran perbulan</label>
                            <input type="text" class="form-control" value="Rp.{{number_format($dt->angsuran_umroh)}}" disabled>
                           
                        </div> 
                        <div class="form-group">
                            <label for="">Total Akhir</label>
                            <input type="text" class="form-control" value="Rp.{{number_format($dt->total)}}" disabled>
                           
                        </div> 

                       
                      {{-- end show data ajax --}}

                      <button class="btn btn-primary float-right" type="submit">Setujui Simpanan Umroh <i class="fa fa-paper-plane"></i></button>
                      <a href="{{url('/operator/detail/aju/simpanan-umroh/hapus/'.$dt->no_rekening)}}" class="btn btn-default"><i class="fa fa-trash" ></i> Hapus</a>
                    
                    </form>
                    @endforeach

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