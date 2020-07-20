@extends('login.layout_login')

@section('content')
 <div class="login-box">
  <div class="login-logo">
  	<b>Daftar Menjadi Anggota </b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->
       {{ show_alert()}}

      <form action="{{ url('/daftar/anggota-act') }}" method="post">
        {{ csrf_field() }}
 		{{ method_field('POST') }}
		 <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama" name="nama" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-book"></span>
            </div>
          </div>
          @if($errors->has('nama'))
        <small class="text-muted text-danger">
            {{ $errors->first('nama')}}
        </small>
		     @endif
        </div>
		
         <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="NIK" name="nik" maxlength="16" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
           
        </div>
             @if($errors->has('nik'))
                <small class="text-muted text-danger">
                    {{ $errors->first('nik')}}
                </small>
            @endif
         <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Alamat KTP" name="alamat" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-road"></span>
            </div>
          </div>
           @if($errors->has('alamat'))
                <small class="text-muted text-danger">
                    {{ $errors->first('alamat')}}
                </small>
            @endif
        </div>

        <div class="input-group mb-3">
            <select class="form-control" name="kelamin" required="required">
              <option value="">Jenis Kelamin</option>
              <option value="laki-laki">Laki - Laki</option>
              <option value="perempuan">Perempuan</option>
            </select> 
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-venus-mars"></span>
            </div>
          </div>
           @if($errors->has('kelamin'))
                <small class="text-muted text-danger">
                    {{ $errors->first('kelamin')}}
                </small>
            @endif
        </div>

        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Nomor HP" name="kontak" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
           @if($errors->has('kontak'))
                <small class="text-muted text-danger">
                    {{ $errors->first('kontak')}}
                </small>
            @endif
        </div>

        <div class="input-group mb-3">
          <select class="form-control" name="kerja" required="required">
            <option value="">Pilih Pekerjaan</option>
           @php
              $kerja = \App\Model\Pekerjaan::all();
           @endphp
           @foreach ($kerja as $kj)
          <option value="{{$kj->id}}">{{$kj->pekerjaan}}</option>
           @endforeach
          </select> 
          <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-venus-mars"></span>
          </div>
        </div>
         @if($errors->has('kerja'))
              <small class="text-danger">
                  {{ $errors->first('kerja')}}
              </small>
          @endif
        </div>

        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Jumlah gaji/bulan" name="gaji" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-credit-card"></span>
            </div>
          </div>
           @if($errors->has('gaji'))
                <small class="text-danger">
                    {{ $errors->first('gaji')}}
                </small>
            @endif
        </div>


        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @if($errors->has('username'))
            <small class="text-danger">
                {{ $errors->first('username')}}
            </small>
        @endif
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
           @if($errors->has('password'))
                <small class="text-danger">
                    {{ $errors->first('password')}}
                </small>
            @endif
        </div>
        <div class="row">
         
          <!-- /.col -->
          <div class="col-12 ">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
 

      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box --> 
@endsection