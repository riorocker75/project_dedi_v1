
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
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>            
          </li>         
         
  
          <li class="nav-item">
          <a href="/operator/data-pribadi/{{Session::get('op_id')}}" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p> Data Pribadi</p>
            </a>
          </li>


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
                  <p>Pengaju Pembiayaan</p>
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
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan --</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan --</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan --</p>
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
            <a href="{{url('/logout/operator')}}" class="nav-link">
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
  