@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Aju Simpanan Berjangka</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Aju Simpanan Berjangka</li>
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
                      <a data-toggle="modal" data-target="#pesan_deposit" class="btn btn-outline-info">Kirim Pesan&nbsp;&nbsp;<i class="fa fa-comment"></i></a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  
                    @foreach ($data as $dt)
                        
                <form action="{{url('/operator/aju/simpanan-deposit/act/'.$dt->rekening_deposit)}}" method="post">
                        @csrf

                      @php
                      $ops=App\Model\Simpanan\OpsiSimpananBerjangka::orderBy('id','asc')->get();
                      $ops_e=App\Model\Simpanan\OpsiSimpananBerjangka::where('id',$dt->opsi_deposit_id)->first();

                        $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                      @endphp
                       <div class="form-group">
                         <label for="">Nama</label>
                       <input type="text" class="form-control" value="{{$ang->anggota_nama}}" disabled>
                       </div> 

                       <div class="form-group">
                        <label for="">NIK</label>
                      <input type="text" class="form-control" value="{{$ang->anggota_nik}}" disabled>
                      </div>

                       {{-- buat ajax cek di simpanan berjangka detailnya  --}}
                       <div class="form-group">
                        <label for="">Simpanan Berjangka</label>
                        <select name="nominal" class="form-control" required>
                         <option value="{{$ops_e->id}}" hidden selected>Rp.{{number_format($ops_e->nominal_deposit)}}</option>
                          @foreach ($ops as $op)
                          <option value="{{$op->id}}">Rp.{{number_format($op->nominal_deposit)}}</option>

                          @endforeach

                        </select>
                         </div> 

                        <input type="text" value="{{$dt->anggota_id}}" name="ang_id" hidden>

                         {{-- disini dibuat show data aja --}}
                         <div class="form-group">
                            <label for="">Periode</label>
                            <input type="text" class="form-control" value="{{$dt->jangka_deposit}} bulan" disabled>
                           
                        </div> 
                        <div class="form-group">
                            <label for="">Bagi Hasil Per {{$dt->jangka_deposit}} bulan</label>
                            <input type="text" class="form-control" value="{{$ops_e->bunga_deposit}}%" disabled>
                           
                        </div> 

                        <div class="form-group">
                            <label for="">Nisbah perbulan</label>
                            <input type="text" class="form-control" value="Rp.{{number_format($ops_e->nisbah_bulan)}}" disabled>
                           
                        </div> 
                      {{-- end show data ajax --}}

                      <button class="btn btn-primary float-right" type="submit">Setujui Simpanan Berjangka <i class="fa fa-paper-plane"></i></button>
                      <a href="{{url('/operator/detail/aju/simpanan-deposit/hapus/'.$dt->rekening_deposit)}}" class="btn btn-default"><i class="fa fa-trash" ></i> Hapus</a>
                   
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
<div class="modal fade" id="pesan_deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan Ke Pemohon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{url('/operator/detail/aju/simpanan-deposit/pesan/act')}}" method="post">
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