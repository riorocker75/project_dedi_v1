@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Aju Simpanan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Aju Simpanan</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
            <section class="col-lg-12 connectedSortable">
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
                     $ang = App\Model\Anggota::where('anggota_id', Session::get('ang_id'))->first();
                 @endphp 

                 {{-- @if ($ang->status_simpanan == 0)
                 <a href="{{url('/anggota/ajukan/simpanan-umum')}}" class="btn btn-default"> Ajukan Simpanan Sukarela <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                 <br> 
                 <br> 
                 @endif --}}
                 
                 {{-- deposit --}}
                 @if ($ang->status_deposit == 0)
                <a href="{{url('/anggota/ajukan/simpanan-deposit')}}" class="btn btn-default"> Ajukan Simpanan Berjangka <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                   <br> 
                   <br>  
                @endif

                @if ($ang->status_deposit == 2)
                <a href="{{url('/anggota/ajukan/simpanan-deposit')}}" class="btn btn-default"> Ajukan Simpanan Berjangka <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                   <br> 
                   <br>  
                @endif
              {{-- end deposit--}}
              {{-- umroh --}}
                  @if ($ang->status_umroh == 0)
                  <a href="{{url('/anggota/ajukan/simpanan-umroh')}}" class="btn btn-default"> Ajukan Simpanan Umroh <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    <br> 
                    <br> 
                    @endif
                  @if ($ang->status_umroh == 2)
                  <a href="{{url('/anggota/ajukan/simpanan-umroh')}}" class="btn btn-default"> Ajukan Simpanan Umroh <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    <br> 
                    <br> 
                    @endif
               {{-- end umroh --}}

               {{-- pendidikan --}}
                @if ($ang->status_pendidikan == 0)
                  <a href="{{url('/anggota/ajukan/simpanan-pendidikan')}}" class="btn btn-default"> Ajukan Simpanan Pendidikan <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                  <br> 
                  <br> 
                @endif

                @if ($ang->status_pendidikan == 2)
                  <a href="{{url('/anggota/ajukan/simpanan-pendidikan')}}" class="btn btn-default"> Ajukan Simpanan Pendidikan <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                  <br> 
                  <br> 
                @endif
               {{-- end pendidikan --}}
     
                </div>
              </div>
            </section>
          
          </div>
        </div>
      </section>
    </div>
    
@endsection