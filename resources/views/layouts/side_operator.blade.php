
{{-- notif start  --}}
    <!-- Right navbar links -->
    @php
      // nda =notif daftar anggota // nda =notif daftar anggota
      // nbk =notif daftar deposit  // num=notif daftar umroh
     // npd=notif daftar pendidikan // npj=notif daftar pinjaman
     
        $nda= App\Model\Anggota::where('status',0)->get();
        $nbk = App\Model\Simpanan\SimpananBerjangka::where('status',0)->get();
        $num = App\Model\Simpanan\SimpananUmroh::where('status_aju',0)->get();
        $npd = App\Model\Simpanan\SimpananPendidikan::where('status_aju',0)->get();
        $npj= App\Model\Pinjaman::where('pinjaman_status',0)->get();
        $nt_sim =count($nbk) + count($num) + count($npd) ;
      $tot_notif = count($nda) + $nt_sim + count($npj) ;
    @endphp
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown">
         
          @if ($tot_notif > 0)
          <i class="far fa-bell bell" ></i>
            <span class="badge badge-warning navbar-badge ">
            {{number_format($tot_notif)}}
            </span>
            @else
            <i class="far fa-bell"></i>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{number_format($tot_notif)}} Pemberitahun</span>
          <div class="dropdown-divider"></div>
          <a href="{{url('/operator/mohon-gabung')}}" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> {{count($nda)}} Gabung Anggota
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('/operator/data-pinjaman')}}" class="dropdown-item">
             <i class="fas fa-credit-card mr-2"></i> {{count($npj)}} Aju Pinjaman
          
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('/operator/data-simpanan')}}" class="dropdown-item">
            <i class="fas fa-save mr-2"></i> {{$nt_sim}} Aju Simpanan
          
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>     
    </ul>
  </nav>

{{-- end notif --}}

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
          <a href="#" class="d-block">{{ Session::get('op_nama') }}</a>
        </div>
      </div>
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="{{('/dashboard/operator')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>            
          </li>         
         
  
          {{-- <li class="nav-item">
          <a href="{{url('/operator/data-pribadi/')}}/{{Session::get('op_id')}}" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p> Data Pribadi</p>
            </a>
          </li> --}}

          @php
              $aju_pinjam =App\Model\Pinjaman::where('pinjaman_status','0')->get();
          @endphp
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>
                Data Pengaju
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left:20px;font-size:14px">
              <li class="nav-item">
                <a href="{{url('/operator/mohon-gabung')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaju Gabung Anggota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/operator/data-pinjaman')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaju Pembiayaan 
                    <?php if(count($aju_pinjam) > 0){?>
                    <label class="badge badge-warning">baru</label>
                    <?php }?>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/operator/data-simpanan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengaju Simpanan</p>
                </a>
              </li>
                                    
            </ul>
          </li>
            <li class="nav-item">
          <a href="{{url('/operator/verifikasi/anggota')}}" class="nav-link">
              <i class="nav-icon fas fa-check"></i>
              <p> Verifikasi Lanjutan&nbsp; 
               
               <?php
                    $tot_vf =App\Model\Syarat::where('status',0)->get();
                    if(count($tot_vf) > 0){
              ?>
               <label class="badge badge-warning">
                {{count($tot_vf)}}
               </label>
              <?php  }?>
            </p>
            </a>
          </li>
         
          {{-- aktifkan lagi laporan kalau udah fix --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Data Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left:20px;font-size:14px">
              <li class="nav-item">
                <a href="{{url('/operator/laporan/shu')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan SHU</p>
                </a>
              </li>
          
                                    
            </ul>
          </li>

         
           <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fa fa-question-circle" aria-hidden="true"></i>
              <p> BANTUAN</p>
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
  