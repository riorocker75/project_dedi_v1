
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
        <a href="#" class="d-block">{{ Session::get('adm_nama') }}</a>
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
                <p>Data Pengurus</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/dashboard/admin/anggota')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Anggota</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/dashboard/admin/atur_simpanan')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/dashboard/admin/kategori_pinjaman')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori Pembiayaan</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{url('/admin/pekerjaan')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pekerjaan</p>
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
         {{-- pembayaran --}}
         <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
             Pembayaran
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="margin-left:20px;font-size:14px">
            <li class="nav-item">
            <a href="{{url('/admin/pembayaran/pinjaman')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembayaran Pembiayaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/admin/pembayaran/simpanan')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembayaran Simpanan</p>
              </a>
            </li>
                           
          </ul>
        </li>

        {{-- end pembayaran --}}

        {{-- start transaksi --}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
              <i class="nav-icon fa fa-leaf"></i>
            <p>
              TRANSAKSI
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

        {{-- pengaturan aplikasi --}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
             Pengaturan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="margin-left:20px;font-size:14px">
            <li class="nav-item">
            <a href="{{url('/admin/pengaturan/web')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengaturan Web</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/admin/pengaturan/syarat')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengaturan Syarat</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{url('/admin/pengaturan/rekening')}}" class="nav-link">
                <i class="fa fa-university nav-icon"></i>
                <p>Pengaturan Rekening Bank</p>
              </a>
            </li>
                           
          </ul>
        </li>

        {{-- end pengaturan --}}
         <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-question"></i>
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
