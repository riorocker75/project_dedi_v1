@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Laman Keuangan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Laman Keuangan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
      @php
      /* total simpanan sukarela */
      $sim_sukarela=App\Model\Simpanan::where('status', 1)->sum('total_simpanan');
      /* total simpanan wajib*/
      $sim_wajib=App\Model\Simpanan::where('status', 1)->sum('jlh_wajib');
      /* total simpanan pokok */
      $sim_pokok=App\Model\Simpanan::where('status', 1)->sum('jlh_pokok');
      $tot_umum = $sim_sukarela + $sim_wajib + $sim_pokok;
      $tot_wajib_pokok=$sim_wajib + $sim_pokok;
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
      <div class="row">
        <section class="col-lg-3 col-6 connectedSortable">
          <div class="small-box bg-default">
            <div class="inner">
              <h3>Rp.{{number_format($sim_sukarela)}}</h3>
              <p>Total Aset Simpanan Sukarela</p>
            </div>
            <div class="icon">
            <i class="fas fa-dollar-sign    "></i>
            </div>
          
          </div>
        </section>

        <section class="col-lg-3 col-6 connectedSortable">
          <div class="small-box bg-default">
            <div class="inner">
              <h3>Rp.{{number_format($tot_umroh)}}</h3>
              <p>Total Aset Simpanan Umroh</p>
            </div>
            <div class="icon">
            <i class="fas fa-dollar-sign    "></i>
            </div>
          
          </div>
        </section>

        <section class="col-lg-3 col-6 connectedSortable">
          <div class="small-box bg-default">
            <div class="inner">
              <h3>Rp.{{number_format($tot_pend)}}</h3>
              <p>Total Aset Simpanan Pendidikan</p>
            </div>
            <div class="icon">
            <i class="fas fa-dollar-sign    "></i>
            </div>
          
          </div>
        </section>

        <section class="col-lg-3 col-6 connectedSortable">
          <div class="small-box bg-default">
            <div class="inner">
              <h3>Rp.{{number_format($tot_wajib_pokok)}}</h3>
              <p>Total Aset Simpanan Wajib & Pokok</p>
            </div>
            <div class="icon">
            <i class="fas fa-dollar-sign    "></i>
            </div>
          
          </div>
        </section>

        <section class="col-lg-4 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
             Tambah Kas
           
              </h3>
              <div class="card-tools">
                <div class="float-right">

                </div>
              </div>
            </div>
            <div class="card-body">
            <form action="{{url('/admin/akuntan/kas/tambah')}}" method="post">
                @csrf
               
                  <div class="form-group">
                    <label for="">Nama Kas </label>
                    <input type="text" 
                      class="form-control" name="nama" required>
                        @if($errors->has('nama'))
                        <small class="text-muted text-danger">
                            {{ $errors->first('nama')}}
                            </small>
                        @endif
                        </div> 

                  <div class="form-group">
                    <label for="">Jumlah Saldo </label>
                    <input type="number" 
                      class="form-control" name="saldo" id="format_rupiah" required>
                      <div class="show_rupiah"></div>
                      @if($errors->has('saldo'))
                      <small class="text-muted text-danger">
                          {{ $errors->first('saldo')}}
                          </small>
                      @endif
                    </div>
  
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </form>
             
            </div>
          </div>
        </section>


         {{--Kategoti Kas--}}
         <section class="col-lg-8 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
              Data Kas 
              </h3>
              <div class="card-tools">
               
              </div>
            </div>
            <div class="card-body">
              <table id="data1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>Nama Kas</th>
                    <th>Saldo</th>  
                    <th>Status</th>                 
                    <th>Opsi</th>                   
                    </tr>
                </thead>
                <tbody> 
                   @foreach ($data_kas as $dk)
                       
                     <tr>
                        <td>{{$dk->nama}}</td>
                        
                     <td>Rp.{{number_format($dk->saldo)}}</td>
                        <td>{{status_kas($dk->status)}}</td>
                        <td>
                            <a data-toggle="modal" href="#kas_edit{{$dk->id}}" style="padding:0 7px"> <i class="fa fa-pen"></i></a>
                            @if ($dk->id > 1)
                            <a href="{{url('/admin/akuntan/kas/hapus/'.$dk->id)}}" style="padding:0 7px"> <i class="fa fa-trash"></i></a>
                            @endif

                            {{-- modal kas edit --}}
                                <div class="modal fade" id="kas_edit{{$dk->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                   
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Kas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form action="{{url('/admin/akuntan/kas/update')}}" method="post">
                                        @csrf
                                        
                                        <div class="modal-body">
                                            <div class="form-group">
                                              <label for="">Nama Kas </label>
                                              <input type="text" 
                                                class="form-control" name="nama" value="{{$dk->nama}}" required>
                                              </div> 
                                            <input type="text" name="id_kas" value="{{$dk->id}}" hidden>
                                              <div class="form-group">
                                                <label for="">Jumlah Saldo </label>
                                                <input type="number" 
                                                   class="form-control" name="saldo" id="format_rupiah_2" value="{{$dk->saldo}}" required>
                                                  <div class="show_rupiah_2"></div>
                                                </div>

                                                <div class="form-group">
                                                  <label for="">Status</label>
                                                  <select name="status" class="form-control">
                                                  <option value="{{$dk->status}}" hidden selected>{{status_kas($dk->status)}}</option>
                                                  <option value="1">Aktif</option>
                                                  <option value="0">Non Aktif</option>

                                                  </select>
                                                  </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                        </div>

                                     </form>

                                    </div>
                                  </div>
                                </div>
                            {{-- end modal kas edit --}}

                        </td>
                     </tr>


                     @endforeach
                </tbody>   
            </table>
            </div>
          </div>
        </section>
      
       

      </div>
    </div>
  </section>
</div>
@endsection