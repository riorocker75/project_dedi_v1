@extends('layouts.main_app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Verfikasi</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Verfikasi</li>
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
                   
                  Lihat Persyaratan 
                  </h3>
                  <div class="card-tools">
                   
                  </div>
                </div>
                <div class="card-body">
                  @php
                      $syarat =App\Model\Option::where('option_name','syarat')->first();
                  @endphp

                    {!! $syarat->option_value !!}
                   {{-- <?php echo $syarat->option_value?> --}}
                  
                </div>
              </div>
            </section>


            <section class="col-lg-6 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                   Form Upload
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  <div class="card-body">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br/>
                        @endforeach
                    </div>
                    @endif
                  <form action="{{url('/anggota/verifikasi/bayar/act')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="border: 1px solid #c1c2c3;padding:10px">
						<b>Upload Persyaratan</b><br/>
                        <input type="file" name="syarat" id="file_1" required>
                        <br>
                        <small class="text-danger">* wajib file .pdf max:2mb</small>
                        <div class="file_show" id="file_show_1"></div>
                        <br>
                        @if($errors->has('syarat'))
                        <small class="text-muted text-danger">
                        {{ $errors->first('syarat')}}
                        </small>
                        @endif
                    </div>
                    
                    <div class="form-group" style="border: 1px solid #c1c2c3;padding:10px">
						<b>Upload Bukti Bayar</b><br/>
                        <input type="file" name="bukti_bayar" id="file_2">
                        <br>
                        <small class="text-danger">* support file PNG,JPG,JPEG max:2mb</small>
                        <div class="file_show" id="file_show_2"></div>
                        <br>
                            @if($errors->has('bukti_bayar'))
                            <small class="text-muted text-danger">
                            {{ $errors->first('bukti_bayar')}}
                            </small>
                            @endif
                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary float-right">Kirim data</button>
                </form>
  
                    
                  </div>
                </div>
              </section>
          
          </div>

          
        </div>
      </section>
    </div>
    
@endsection