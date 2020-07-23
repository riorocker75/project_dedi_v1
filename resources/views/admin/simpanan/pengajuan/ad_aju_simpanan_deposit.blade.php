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
                @foreach ($data as $dt)
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Data Pengajuan
                  </h3>
                  <div class="card-tools">
                    <div class="float-right">
                        <label class="badge badge-success">Telah Aktif</label>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  
                   
                        
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
                       <input type="text" class="form-control" value="Rp.{{number_format($ops_e->nominal_deposit)}}" disabled>
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

                    
                      {{-- <a href="{{url('/operator/detail/aju/simpanan-deposit/hapus/'.$dt->rekening_deposit)}}" class="btn btn-default"><i class="fa fa-trash" ></i> Hapus</a> --}}
                   
                    </form>
                    
                </div>
                @endforeach
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>

@endsection