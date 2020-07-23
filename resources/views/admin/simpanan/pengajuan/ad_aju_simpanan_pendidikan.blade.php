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
                @foreach ($data as $dt)
                <div class="card-header">
                  <h3 class="card-title">
                   
                 Data pengajuan
                  </h3>
                  <div class="card-tools">
                    <div class="float-right">
                        <div class="badge badge-primary">Masa Angsuran Simpanan</div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                 
                   
                    <form action="" method="post">
                        @csrf
                        @php
                        $ops=App\Model\Simpanan\OpsiSimpananLain::where('kode_simpanan','SPN')->orderBy('id','asc')->get();
                        $ops_e=App\Model\Simpanan\OpsiSimpananLain::where('id',$dt->opsi_simpanan_lain_id)->first();
  
                          $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
                        @endphp
                        <div class="form-group">
                            <label for="">Nama dan Nik</label>
                            <input type="text" class="form-control" value="{{$ang->anggota_nama}} | {{$ang->anggota_nik}}" disabled>

                          </div> 

                       {{-- buat ajax cek di simpanan pendidikan detailnya  --}}
                       <div class="form-group">
                        <label for="">Jenis Simpanan Pendidikan</label>
                            <input type="text" class="form-control" value="{{$ops_e->jenis_simpanan}} Tenor {{$ops_e->jangka_simpanan}} tahun" disabled>
                         </div> 
                         <input type="text"  value="{{$dt->anggota_id}}" name="ang_id" hidden>

                         {{-- disini dibuat show data aja --}}
                         <div class="form-group">
                            <label for="">Lama Setoran</label>
                            <input type="text" id="" class="form-control" value="{{$dt->jangka_pend}} tahun" disabled>
                           
                        </div> 

                        <div class="form-group">
                            <label for="">Nisbah pertahun</label>
                            <input type="text" id="" class="form-control" value="{{$ops_e->bunga}} %" disabled>
                           
                        </div>
                         <div class="form-group">
                            <label for="">Setoran perbulan</label>
                            <input type="text" id="" class="form-control" value="Rp.{{number_format($dt->angsuran_pend)}}" disabled>
                           
                        </div> 
                        <div class="form-group">
                            <label for="">Total Simpanan Akhir</label>
                            <input type="text" id="" class="form-control" value="Rp.{{number_format($dt->total)}}" disabled>
                           
                        </div> 

                       
                      {{-- end show data ajax --}}

                      {{-- <a href="{{url('/operator/detail/aju/simpanan-pendidikan/hapus/'.$dt->no_rekening)}}" class="btn btn-default"><i class="fa fa-trash" ></i> Hapus</a> --}}
                        
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