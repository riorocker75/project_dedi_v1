@extends('layouts.main_app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <?php
        $pr = App\Model\Anggota::where('anggota_id',Session::get('ang_id'))->first();
        if($pr->status_pinjaman == 0){
        ?>
       <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan!!</h5>
        Harap Melakukan Pembayaran Uang Pendaftaran dan Upload Peryaratan Segera!! <a href="{{url('/anggota/verifikasi/bayar')}}">&nbsp;disini</a>
        <br>
        Agar Anda Bisa melakukan Pembiayaan
      </div>
        <?php }?>
    
      
      <div class="row">
        
        <?php 
            $pj=App\Model\Pinjaman::where('anggota_id',Session::get('ang_id'))->get();
            if (count($pj) > 0) {
        ?>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-warning">
            @php
                $dx = App\Model\Pinjaman::where('anggota_id',Session::get('ang_id'))->first();
                $source_sisa =App\Model\PinjamanTransaksi::where('pinjaman_kode',$dx->pinjaman_kode)->get();
                // cek dulu ada apa nggak nya data di tabel itu baru -> kau bisa manggil dia last record row
                $sg= App\Model\PinjamanTransaksi::where('pinjaman_kode',$dx->pinjaman_kode)->orderBy('id', 'DESC')->first(); 
            @endphp
            <div class="inner">
                <h3>
                 
                        @if (count($source_sisa) > 0)
                        Rp.{{number_format($sg->sisa_bayar)}}
                        @else
                        0
                        @endif
                  
                </h3>
              <p>
                Sisa Angsuran Pembiayaan
              </p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>
            </div>
          </div>
        </div>
      <?php }else{ ?>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                  <h3>
                    Rp.0
                  </h3>
                  <p>
                    Belum ada Melakukan Pembiayaan
                  </p>
              </div>
              <div class="icon">
                <i class="fa fa-credit-card"></i>
              </div>
            </div>
          </div>
      <?php }?>  

     
        <div class="col-lg-4 col-6">
          <div class="small-box bg-success">
            @php
            /* total simpanan sukarela */
            $sim_sukarela=App\Model\Simpanan::
            where([
              'status' => 1,
              'anggota_id' => Session::get('ang_id')
            ])
            ->sum('total_simpanan');
            /* total simpanan wajib*/
            $sim_wajib=App\Model\Simpanan::
            where([
              'status' => 1,
              'anggota_id' => Session::get('ang_id')
            ])
            ->sum('jlh_wajib');
            /* total simpanan pokok */
            $sim_pokok=App\Model\Simpanan::
            where([
              'status' => 1,
              'anggota_id' => Session::get('ang_id')
            ])
            ->sum('jlh_pokok');
            $tot_umum = $sim_sukarela + $sim_wajib + $sim_pokok;
            // ==================================================
            /* total simpanan deposit */
            $tot_deposit =App\Model\Simpanan\SimpananBerjangka::
            where([
              'status' => 1,
              'anggota_id' => Session::get('ang_id')
            ])
            ->sum('nilai_deposit');
            $tot_nisbah =App\Model\Simpanan\SimpananBerjangka::
            where([
              'status' => 1,
              'anggota_id' => Session::get('ang_id')
            ])
            ->sum('total_nisbah');
            $nisbah_depo =$tot_nisbah + $tot_deposit;
            // ==================================================
            /* total simpanan umroh */
            $tot_umroh =App\Model\Simpanan\SimpananUmroh::
            where([
              'status' => 1,
              'anggota_id' => Session::get('ang_id')
            ])
            ->sum('total_angsur');
            /* total simpanan pendidikan */
            $tot_pend =App\Model\Simpanan\SimpananPendidikan::
            where([
              'status' => 1,
              'anggota_id' => Session::get('ang_id')
            ])
            ->sum('total_angsur');
            // ==================================================
            $tot_sim =$tot_umum +  $nisbah_depo + $tot_umroh +$tot_pend;
            @endphp
            <div class="inner">
              <h3>Rp.{{number_format($tot_sim)}}</h3>
              <p>Total Aset Simpanan</p>
            </div>
            <div class="icon">
            <i class="fas fa-dollar-sign    "></i>
            </div>
            {{-- <a href="#" class="small-box-footer">selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        
      </div>

      
      {{-- <div class="row">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Chart Simpanan</h3>

            <div class="card-tools">
             
            </div>
          </div>
          <div class="card-body">
          </div>
          <!-- /.card-body -->
        </div>
      </div> --}}


    </div>
  </section>

</div>

</div>

@endsection