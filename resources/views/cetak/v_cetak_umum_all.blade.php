@extends('layouts.cetak_app')
@section('content')

<div class="cetak_transaksi">
    <div class="judul_laporan">
       KSPPS KIS<br>
       <span>KANTOR PUSAT</span> <br>
       <span>Riwayat Transaksi Simpanan </span><br>
       <span>{{$dari}} - {{$sampai}}</span><br><br>

    </div>
    
    <div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Keterangan</th>
                    <th>Jenis </th>
                    <th>Nominal</th>
                    <th>Sisa Saldo</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
               <tr>
                   <td>{{$dt->ket_transaksi}}
                    <br>
                    <small class="tgl-text">{{format_tanggal(date('Y-m-d', strtotime($dt->tgl_transaksi)))}}</small>    
                    </td>
                   <td>{{$dt->jenis_transaksi}}</td>
                    
                   
                   <td class="float-right"><b>{{number_format($dt->nominal_transaksi)}} </b></td>
                   <td style="text-align:right"><b>{{number_format($dt->sisa_angsuran)}} </b></td>
                   
               </tr>
               @endforeach
            </tbody>
        </table>  
    </div>  
</div>

@endsection