@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Aju Simpanan Sukarela</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Aju Simpanan Sukarela</li>
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
                      <a  data-toggle="modal" data-target="#pesan_umum" class="btn btn-block btn-outline-info"> Kirim Pesan &nbsp;&nbsp;<i class="fa fa-comment"></i></a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                   
                
                @foreach ($data as $dt)
                <form action="{{url('/operator/aju/simpanan-umum/act/'.$dt->no_rekening)}}" method="post">
                    @csrf

                    @php
                    $ops=App\Model\Simpanan\OpsiSimpanan::where('id',1)->first();
                      $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                    @endphp
                        <div class="form-group">
                            <label for="">Nama</label>
                           <input class="form-control" type="text" value="{{$ang->anggota_nama}}" disabled>
                            </select>
                          </div> 
                         
                          <input type="number" name="ang_id" value="{{$dt->anggota_id}}" hidden>

                          <div class="form-group">
                            <label for="">NIK</label>
                           <input class="form-control" type="text" value="{{$ang->anggota_nik}}" disabled>
                            </select>
                          </div> 

                       <div class="form-group">
                        <label for="">Simpanan Pokok</label>
                      <input type="text" id="" class="form-control" value="Rp.{{number_format($ops->simpanan_pokok)}}" disabled>
                      </div> 

                       <div class="form-group">
                        <label for="">Simpanan Wajib/bulan</label>
                      <input type="text" id="" class="form-control" value="Rp.{{number_format($ops->simpanan_wajib)}}" disabled>
                      </div> 

                      <div class="form-group">
                        <label for="">Jumlah Setoran Awal</label>
                      <input type="number" name="sukarela" id="format_rupiah" class="form-control" value="{{$dt->total_simpanan}}">
                        @if($errors->has('sukarela'))
                        <small class="text-muted text-danger">
                        {{ $errors->first('sukarela')}}
                        </small>
                        @endif
                      <div class="show_rupiah"></div>
                      </div> 

                      <button class="btn btn-primary float-right" type="submit">Setujui Simpanan Sukarela <i class="fa fa-paper-plane"></i></button>
                      <a href="{{url('/operator/detail/aju/simpanan-umum/hapus/'.$dt->no_rekening)}}" class="btn btn-default"><i class="fa fa-trash" ></i> Hapus</a>
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
<div class="modal fade" id="pesan_umum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan Ke Pemohon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{url('/operator/detail/aju/simpanan-umum/pesan/act')}}" method="post">
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