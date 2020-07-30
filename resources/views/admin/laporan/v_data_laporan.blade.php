@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Laporan Sisa Hasil Usaha</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Laporan Sisa Hasil Usaha</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
     
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
               
              Laporan
              </h3>
              <div class="card-tools">
                <div class="float-right">
                {{-- <a href="{{url('/admin/laman/akuntan')}}" class="btn btn-outline-primary btn-sm">Laman Keuangan Koperasi</a> --}}
                <a href="#tambah_shu" data-toggle="modal" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Tambah SHU</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{url('/admin/laporan/shu/cetak/filter')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Dari Tanggal</label>
                           <input type="date" class="form-control" name="dari" id="dari" value="{{date('Y-m-d')}}">
                          </div> 
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="sampai" id="sampai" value="{{date('Y-m-d')}}">

                          </div> 
                    </div>

                    <div class="col-lg-1 col-md-6 col-6">
                      <div class="form-group">
                        <label for="" style="color:#fff">.</label>
                        <button type="button" id="filter_tanggal" class="btn btn-sm btn-outline-info form-control">Tampilkan</button>
                      </div> 
                  </div>

                  @if(count($data) > 0)
                  <a id="lap_all" href="{{url('/admin/laporan/shu/cetak/all')}}"   style="margin-top:32px;margin-bottom:20px"
                    class="btn btn-outline-primary float-right">
                    Print &nbsp;
                    <i class="fa fa-print"></i>
                    </a>
                  @endif

                  @if(count($data) > 0)
                  <button type="submit" id="lap_filter" style="display:none;margin-top:32px;margin-bottom:20px" 
                    class="btn btn-outline-primary float-right">
                    Print &nbsp;
                    <i class="fa fa-print"></i>
                    </button>
                  @endif

                  
                </div>
              </form>
                {{-- end row  --}}

                <table id="data1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Laporan</th>
                        <th>Nominal Transaksi</th>
                        <th>Sisa Saldo </th>
                        <th>Keterangan </th>                   
                        <th>Jenis</th>
                        <th>Opsi</th>                   
                      </tr>
                    </thead>
                   
                    <tbody id="hilang"> 
                      {{-- cetak laporan --}}
                   
              
                     {{-- end cetak laporan --}}
                      @foreach ($data as $dt)

                      @php
                          $op= App\Model\Kas::where('id', $dt->kas_id)->first();
                      @endphp
                        <tr>
                        <td>{{$dt->kode_laporan}}
                          <br>
                        <small class="tgl-text">{{format_tanggal(date('Y-m-d',strtotime($dt->tgl)))}}</small>
                        </td>
                        <td>
                          @if ($dt->status == "1")
                              <span style="color:green">+ Rp.{{number_format($dt->nominal)}}</span>
                          @elseif($dt->status == "2")
                             <span style="color:red">- Rp.{{number_format($dt->nominal)}}</span>
                          @endif
                        </td>
                    

                        {{-- saldo kas --}}
                        <td>
                            Rp.{{number_format($op->saldo)}}
                            <br>
                            <small><b>{{$op->nama}}</b></small>
                        </td>
                        {{-- ket --}}
                        <td>
                          {{$dt->ket}}
                        </td>
                        {{-- status --}}
                        <td>
                          @if ($dt->status == "1")
                          <label class="badge badge-success">Pemasukan</label>
                         @elseif($dt->status == "2")
                          <label class="badge badge-danger">Pengeluaran</label>
                          @endif
                        </td>
                        <td>
                          
                            <a href="{{url('/admin/laporan/shu/hapus/'.$dt->id)}}" onclick="return confirm('Yakin Menghapus Data Ini?');">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                          {{-- modal detail shu --}}
                              

                          {{-- end detail modal shu --}}
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table> 
                  <table id='data2' class='hasil_filter table table-bordered table-striped'>
                   
                  </table>
               
            </div>
          </div>
        </section>
      
      </div>
    </div>
  </section>
</div>
{{-- modal tambah shu --}}

<div class="modal fade" id="tambah_shu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah SHU</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{('/admin/laporan/shu/tambah')}}" method="post">
        @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="">Nominal</label>
            <input type="number"
              class="form-control" name="nominal" id="format_rupiah" required>
          <div class="show_rupiah"></div>
          </div>

          <div class="form-group">
            <label for="">Tanggal</label>
            <input type="date"
          class="form-control"  name="tgl" value="{{date('Y-m-d')}}" required>
          </div>

          <div class="form-group">
            <label for="">Jenis</label>
            <select class="form-control" name="jenis" required>
              <option value="">Pilih Jenis Transaksi</option>
              <option value="1">Pemasukan</option>
              <option value="2">Pengeluaran</option>
            </select>
          </div>
          <div class="form-group">
              @php
              $kas_op=App\Model\Kas::where('status', 1)->orderBy('id','asc')->get();
              @endphp
            <label for="">Kategori Dana</label>
            <select class="form-control" name="kas" required>
                <option value="">Pilih Kategori</option>
              @foreach ($kas_op as $kop)
                <option value="{{$kop->id}}">{{$kop->nama}} | Saldo: Rp.{{number_format($kop->saldo)}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Keterangan</label>
           <textarea name="ket" rows="3" class="form-control" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form> 
    </div>
  </div>
</div>
{{-- end modal --}}

@endsection