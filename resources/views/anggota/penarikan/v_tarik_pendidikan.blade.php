@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Laman Penarikan Dana</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard/anggota')}}">Home</a></li>
                <li class="breadcrumb-item active">Laman Penarikan Dana</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
         
          <div class="row">
              @foreach ($data as $dt)
                  
              @php
                  $op= App\Model\Simpanan\OpsiSimpananLain::where('id',$dt->opsi_simpanan_lain_id)->first();
                  $ang=App\Model\Anggota::where('anggota_id',$dt->anggota_id)->first();
              @endphp
            <section class="col-lg-6 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                   
                  Tarik Dana <b>{{$dt->no_rekening}}</b>
                  </h3>
                  <div class="card-tools">
                    
                  </div>
                </div>
                <div class="card-body">
                <form action="{{url('/anggota/simpanan-pendidikan/tarik/act')}}" method="post" >
                    @csrf
                    <div class="form-group">
                      <label for="">Nominal Tarik</label>
                      <input type="number"
                    class="form-control" name="nominal" max="{{$dt->total_angsur}}" min="5000" id="format_rupiah" required>
                    <div class="show_rupiah"></div>
                        
                    @if($errors->has('nominal'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('nominal')}}
                          </small>
                      @endif 
                    </div>
                    <input type="text" name="no_rek" value={{$dt->no_rekening}} hidden>
                    <div class="form-group">
                        <label for="">Nomor Rekening Bank </label>
                        <textarea  class="form-control" name="info" rows="3" placeholder="Nomor Rekening#Nama Bank" required></textarea>
                        <small id="helpId" class="form-text text-danger">*Nama di rekening Bank <b>Wajib</b> sama dengan nama di akun, jika tidak penarikan ditolak </small>
                        <br>
                        @if($errors->has('info'))
                        <small class="text-muted text-danger">
                            {{ $errors->first('info')}}
                            </small>
                        @endif 
                    </div>

                    <div class="form-group">
                      <label for="">Nama </label>
                      <input type="text"
                    class="form-control"  value="{{$ang->anggota_nama}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Total Saldo </label>
                        <input type="text"
                      class="form-control"  value="Rp.{{number_format($dt->total_angsur)}}" disabled>
                      </div>
                      @if ($dt->total_angsur > 0)
                         <button type="submit" class="btn btn-primary float-right">Tarik Dana&nbsp;<i class="fa fa-paper-plane"></i></button>
                      @endif
                </form>
                </div>
              </div>
            </section>
            @endforeach

            {{-- detail tabungan --}}
          
            {{-- end detail tabunga --}}

            {{-- transaksi pengajuan tarik dana --}}
            <section class="col-lg-12 connectedSortable">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                     
                     History Pengajuan Penarikan
                    </h3>
                    <div class="card-tools">
                     
                    </div>
                  </div>
                  @php
                    $data_narik =App\Model\TarikDana::where('no_rekening',$dt->no_rekening)->orderBy('tgl_aju','desc')->get();
                  @endphp
                  <div class="card-body">
                    <table id="data1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Kode Transaksi</th>
                            <th>Nominal Tarik</th> 
                            <th>Keterangan</th>  
                            <th>Status</th>                 
                            <th>Opsi</th>                   
                            </tr>
                        </thead>
                        <tbody> 
                           @foreach ($data_narik as $dn)
                               
                             <tr>
                                <td>{{$dn->kode_transaksi}}
                                    <br>
                                <small class="tgl-text">{{format_tanggal(date('Y-m-d',strtotime($dn->tgl_aju)))}}</small>
                                </td>
                                
                                <td>Rp.{{number_format($dn->nominal)}}</td>
                                <td>{{$dn->ket}}</td>

                                <td>{{status_tarik($dn->status)}}</td>
                                <td>

                                <a href="{{url('/anggota/simpanan-pendidikan/tarik/delete/'.$dn->id)}}" style="padding:0 7px" onclick="return confirm('Anda yakin membatalkan / hapus penarikan ini ?')"> <i class="fa fa-trash"></i></a>
                                </td>
                             </tr>
                             @endforeach
                    
                    
                        </tbody>   
                    </table>
                  </div>
                </div>
              </section>

            {{-- end transaksi tarik dana --}}
          </div>
        </div>
      </section>
    </div>
    
    


@endsection
