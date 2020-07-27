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
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              @php
                  $jlh_anggota= App\Model\Anggota::where('status',1)->get();
                  $sim_u=App\Model\Simpanan::where('status',1)->get();

                  $sim_depo=App\Model\Simpanan\SimpananBerjangka::where('status',1)->get();
                  $sim_umroh=App\Model\Simpanan\SimpananUmroh::where('status',1)->get();
                  $sim_pend=App\Model\Simpanan\SimpananPendidikan::where('status',1)->get();

              @endphp

              @php
                  
              @endphp
              <h3>{{number_format(count($jlh_anggota))}}</h3>
              <p>Anggota Bergabung</p>
            </div>
            <div class="icon">
             <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            {{-- <a href="{{url('/admin/data-anggota')}}" class="small-box-footer">selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            @php
                $total_peminjam=App\Model\Pinjaman::where('status_bayar',1)->get();
            @endphp
            <div class="inner">
            <h3><sup style="font-size: 20px">{{number_format(count($total_peminjam))}}</sup></h3>
              <p>Pembiayaan Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>

            </div>
            {{-- <a href="#" class="small-box-footer">selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            @php
            /* total simpanan sukarela */
            $sim_sukarela=App\Model\Simpanan::where('status', 1)->sum('total_simpanan');
            /* total simpanan wajib*/
            $sim_wajib=App\Model\Simpanan::where('status', 1)->sum('jlh_wajib');
            /* total simpanan pokok */
            $sim_pokok=App\Model\Simpanan::where('status', 1)->sum('jlh_pokok');
            $tot_umum = $sim_sukarela + $sim_wajib + $sim_pokok;
            // ==================================================
            /* total simpanan deposit */
            $tot_deposit =App\Model\Simpanan\SimpananBerjangka::where('status',1)->sum('nilai_deposit');
            // ==================================================
            /* total simpanan umroh */
            $tot_umroh =App\Model\Simpanan\SimpananUmroh::where('status',1)->sum('total_angsur');
            /* total simpanan pendidikan */
            $tot_pend =App\Model\Simpanan\SimpananPendidikan::where('status',1)->sum('total_angsur');
            // ==================================================
            $tot_sim =$tot_umum +$tot_deposit + $tot_umroh +$tot_pend;
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
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            @php
                $tot_tr_pinjaman =App\Model\PinjamanTransaksi::get();
                $tot_tr_simpanan =App\Model\SimpananTransaksi::get();
                $tot_transaksi =count($tot_tr_pinjaman )+ count($tot_tr_simpanan);

            @endphp
            <div class="inner">
            <h3>{{number_format($tot_transaksi)}}</h3>
              <p>Total Transaksi</p>
            </div>
            <div class="icon">
            <i class="fa fa-chevron-circle-up" ></i>
            </div>
            {{-- <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
      </div>

      
      <div class="row">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Chart Simpanan</h3>
            @php
                // $chart_sim =[];
                $chart_sim = $tot_umum.",".$tot_deposit.",".$tot_umroh.",".$tot_pend;
           
            @endphp
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="simpanan_data" style="height:230px; min-height:230px"></canvas>
          </div>
          <!-- /.card-body -->

        {{-- <div>{{$tes_f}}</div> --}}
        </div>
        
      </div>
    </div>
  </section>

</div>

</div>

<script>
// Get context with jQuery - using jQuery's .get() method.
var donutChartCanvas = $('#simpanan_data').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Simpanan Sukarela',
          'Simpanan Berjangka', 
          'Simpanan Umroh', 
          'Simpanan Pendidikan', 
      ],
      datasets: [
        {
     
          data: [{{$chart_sim}}],

          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })


</script>
@endsection