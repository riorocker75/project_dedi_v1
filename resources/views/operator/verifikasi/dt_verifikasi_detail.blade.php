@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Detail Verifikasi</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                <li class="breadcrumb-item active">Detail Verifikasi</li>
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
                   
                 Verifikasi
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                  
                    @foreach ($data as $dt)
                    <form action="{{url('/operator/verifikasi/anggota/act')}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="">Keterangan </label>
                        <textarea class="form-control" name="ket"  rows="4"></textarea>
                        <small class="text-danger">* isi jika ada alasan menolak persyaratan dan bukti bayar</small>
                      </div>
                    <input type="text" value="{{$dt->anggota_id}}" name="ang_id" hidden>
                    <input type="text" value="{{$dt->id}}" name="syarat_id"  hidden>


                      <button class="btn btn-primary float-right" type="submit" name="action" value="terima">Setujui</button>
                        <button class="btn btn-default float-right" style="margin-right:10px" type="submit" name="action" value="tolak"> Tolak</button>
                        
                    </form>

                    @endforeach

                </div>
              </div>
            </section>

            <section class="col-lg-6 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                   Data Upload
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">
                    
                    <div class="form-group">
                        <label >File Persyaratan</label>
                        <div class="review-img">
                            
                            <?php echo preview_file($dt->isi)?>
                        </div>
                      </div>
                    
                      <div class="form-group" style="margin:-130px 0">
                        <label >Bukti Bayar</label>
                        <div class="review-img">
                            
                            <?php echo preview_file($dt->bukti)?>
                        </div>
                      </div>
  
                  </div>
                </div>
              </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection