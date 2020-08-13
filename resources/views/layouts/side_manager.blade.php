

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">

        {{-- penarikan dana --}}
        @php
        $dana_tarik =App\Model\TarikDana::where('status',0)->orderBy('tgl_aju','desc')->take(7)->get();
  
        @endphp
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          @if (count($dana_tarik) > 0)
          <i class="fa fa-download bell"></i>
            <span class="badge badge-warning navbar-badge">{{ count($dana_tarik) }}</span>
            @else
            <i class="fa fa-download"></i>
            @endif
        </a>
  
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"> {{count($dana_tarik) }} Permohonan Penarikan Dana</span>
          <div class="dropdown-divider"></div>
          @if (count($dana_tarik) > 0)
            @foreach ($dana_tarik as $dn)
                @php
                      // $cek_jam = date('Y-m-d H:i:s' strtotime($dn->tgl_aju) - 3600));
                @endphp   
            <a href="" class="dropdown-item">
                  #{{$dn->kode_transaksi}} 
                  <small class="tgl_text float-right" style="color:#c1c2c3">{{format_notif_jam($dn->tgl_aju)}}</small>
                  <br>
            <small class="tgl_text"><b>Rp.{{number_format($dn->nominal)}}</b></small>
            </a>
            @endforeach
          @else
            <span class="dropdown-item">Belum ada penarikan dana....</span>
          @endif
  
  
          <div class="dropdown-divider"></div>
        <a  style="color:#717c86"href="{{url('/admin/data/penarikan/dana')}}" class="dropdown-item dropdown-footer">lihat Selengkapnya <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        </li>  
        {{-- end penarikan dana --}}
  
  
  
  
        {{-- start notifikas --}}
        @php
        // nsk =notif transfer simpanan umum // 
        // nbk =notif transfer deposit  // num=notif transfer umroh
       // npd=notif transfer pendidikan // npj=notif transfer pinjaman
       
          $nda= App\Model\Anggota::where('status',0)->get();
          // $nbk = App\Model\BuktiBayar::where(['status' => 0, 'jenis_upload'=>"TRBK"]);
          $nsk = App\Model\BuktiBayar::where(['status' => 0, 'jenis_upload'=>"TRFU"])->get();
          $num = App\Model\BuktiBayar::where(['status' => 0, 'jenis_upload'=>"TRFH"])->get();
          $npd = App\Model\BuktiBayar::where(['status' => 0, 'jenis_upload'=>"TRFD"])->get();
          $npj= App\Model\BuktiBayar::where(['status' => 0, 'jenis_upload'=>"TRFP"])->get();
          $nt_sim =count($nsk) + count($num) + count($npd) ;
        $tot_notif = $nt_sim + count($npj) ;
      @endphp
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            @if ($tot_notif > 0)
              <i class="far fa-bell bell" ></i>
               <span class="badge badge-warning navbar-badge">{{ $tot_notif}}</span>
              @else
              <i class="far fa-bell"></i>
              @endif
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"> {{$tot_notif}} Pemberitahuan</span>
            <div class="dropdown-divider"></div>
            <a href="{{url('/admin/bukti-bayar')}}" class="dropdown-item">
              <i class="fas fa-credit-card mr-2"></i> {{count($npj)}} Transfer Pembiayaan
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{url('/admin/bukti-bayar')}}" class="dropdown-item">
              <i class="fas fa-save mr-2"></i> {{$nt_sim}} Transfer Simpanan
            </a>
            <div class="dropdown-divider"></div>
            {{-- <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a> --}}
            <div class="dropdown-divider"></div>
            {{-- <a href="#" class="dropdown-item dropdown-footer">See All Pemberitahuan</a> --}}
          </div>
        </li>     
        {{-- end notif --}}
  
  
     
      </ul>
  
  
   
    </nav>
  
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">{{ status_user(Session::get('level'))}}</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fa fa-user-circle" style="font-size:30px;color:#fff" aria-hidden="true"></i>
         
          {{-- <img src="{{asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Session::get('mg_nama') }}</a>
        </div>
      </div>
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="{{url('/dashboard/admin')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
             
              </p>
            </a>            
          </li>         
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                DATA MASTER
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left:20px;font-size:14px">
              <li class="nav-item">
                <a href="{{url('/dashboard/admin/operator')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/dashboard/admin/anggota')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Anggota</p>
                </a>
              </li>
                                
            </ul>
          </li>
  
          {{-- data pengaju --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>
                DATA PENGAJU
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left:20px;font-size:14px">
              <li class="nav-item">
                <a href="{{url('/admin/mohon-gabung')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaju Gabung Anggota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/data-pinjaman')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaju Pembiayaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/pemohon/simpanan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaju Simpanan</p>
                </a>
              </li>
                                    
            </ul>
          </li>
          {{-- data pengaju end --}}
     
  
          {{-- start transaksi --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-leaf"></i>
              <p>
                Riwayat Transaksi
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left:20px;font-size:14px">
              <li class="nav-item">
                <a href="{{url('/admin/transaksi/simpanan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi Simpanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/transaksi/pinjaman')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi Pembiayaan</p>
                </a>
              </li>
                                   
            </ul>
          </li>
  
          {{-- <li class="nav-item">
            <a href="/admin/tabungan" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p> TABUNGAN</p>
            </a>
          </li> --}}
        
          <li class="nav-item">
            <a href="{{url('/admin/laporan/shu')}}" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p> LAPORAN</p>
            </a>
          </li>
  
            
          <li class="nav-item">
            <a href="{{url('/admin/laman/akuntan')}}" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p> Keuangan </p>
            </a>
          </li>
  
  
  
           <li class="nav-item">
            <a href="{{url('/logout/admin')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p> Keluar</p>
            </a>
          </li>                                      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  