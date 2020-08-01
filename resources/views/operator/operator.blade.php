@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/operator')}}">Home</a></li>
                
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     @php
     // nda =notif daftar anggota // nda =notif daftar anggota
     // nbk =notif daftar deposit  // num=notif daftar umroh
    // npd=notif daftar pendidikan // npj=notif daftar pinjaman
    $verifikasi = App\Model\Syarat::where('status',0)->orderBy('id','ASC')->get();
       $nda= App\Model\Anggota::where('status',0)->get();
       $nbk = App\Model\Simpanan\SimpananBerjangka::where('status',0)->get();
       $num = App\Model\Simpanan\SimpananUmroh::where('status_aju',0)->get();
       $npd = App\Model\Simpanan\SimpananPendidikan::where('status_aju',0)->get();
       $npj= App\Model\Pinjaman::where('pinjaman_status',0)->get();
       $nt_sim =count($nbk) + count($num) + count($npd) ;
     $tot_notif = count($nda) + $nt_sim + count($npj) ;
   @endphp
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
            <div class="col-md-3">
                <!-- Info Boxes Style 2 -->
                <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{count($nda)}}</h3>
      
                      <p>Aju Anggota</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="{{url('/operator/mohon-gabung')}}" class="small-box-footer">Menunggu Persetujuan <i class="fas fa-arrow-circle-right"></i></a>
                  </div>

          </div>

          <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{count($verifikasi) }}</h3>
  
                  <p>Verifikasi Lanjutan</p>
                </div>
                <div class="icon">
             <i class="fa fa-check-circle" aria-hidden="true"></i>
                </div>
                <a href="{{url('/operator/verifikasi/anggota')}}" class="small-box-footer">Menunggu Persetujuan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{count($npj)}}</h3>
  
                  <p>Aju Pembiayaan</p>
                </div>
                <div class="icon">
               <i class="fa fa-credit-card" aria-hidden="true"></i>
                </div>
                <a href="{{url('/operator/data-pinjaman')}}" class="small-box-footer">Menunggu Persetujuan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>

          
          <div class="col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                  <h3>{{$nt_sim }}</h3>
  
                  <p>Aju Simpanan</p>
                </div>
                <div class="icon">
              <i class="fa fa-university" aria-hidden="true"></i>
                </div>
                <a href="{{url('/operator/data-simpanan')}}" class="small-box-footer">Menunggu Persetujuan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

      




        </div>
      </section>
    </div>
@endsection