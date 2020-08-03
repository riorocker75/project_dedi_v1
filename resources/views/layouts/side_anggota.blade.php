
{{-- notif start  --}}
    <!-- Right navbar links -->
    @php
        $notif_nulled=App\Model\Notif::where([
                                      'kode_user'=> Session::get('ang_kode'),
                                      'status_baca' => 0,
                                    ])->get();
      $notif=App\Model\Notif::where('kode_user', Session::get('ang_kode'))->orderBy('tgl','desc')->take(7)->get();
    @endphp
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown" id="notif_ang">
      <input type="text" value="{{Session::get('ang_kode')}}" id="ang_kode" hidden>
        <a class="nav-link" data-toggle="dropdown" href="#">
          @if (count($notif_nulled) > 0)
          <i class="far fa-bell bell"></i>
          <span class="badge badge-warning navbar-badge">{{count($notif_nulled)}}</span>
          @else    
          <i class="far fa-bell"></i>
          @endif
        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{count($notif_nulled)}} Pemberitahuan Baru</span>
          <div class="dropdown-divider"></div>
          @foreach ($notif as $nt)
          <a href="#" class="dropdown-item">
          <b>#{{$nt->kode_transaksi}}</b> 
            <small class="float-right text-muted text-sm" style="color:#c1c2c3">{{format_notif_jam($nt->tgl)}}</small>
            <br>
            <b>
              <span style="color:#c1c2c3;font-size:13px">{{substr($nt->ket,0,40)}}</span>
            </b>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
          
          {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
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
          {{-- <img src="{{asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
          <i class="fa fa-user-circle" style="font-size:30px;color:#fff" aria-hidden="true"></i>
        
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Session::get('ang_nama') }}</a>
        </div>
      </div>
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="{{url('/dashboard/anggota')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>            
          </li>
         
         
  
          <li class="nav-item">
          <a href="/anggota/data-pribadi/{{Session::get('ang_kode')}}" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p> Data Pribadi</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('/anggota/riwayat/transaksi/')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Simpanan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/anggota/data-pinjaman/'.Session::get('ang_id').'')}}" class="nav-link">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>Pembiayaan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/anggota/ajukan-pinjaman')}}" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p> Ajukan Pembiayaan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/anggota/aju-simpanan')}}" class="nav-link">
             <i class="nav-icon fa fa-plus-circle" aria-hidden="true"></i>
              <p> Ajukan Simpanan</p>
            </a>
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
  
