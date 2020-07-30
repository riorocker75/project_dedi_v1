@extends('layouts.cetak_app')
@section('content')

<div class="cetak_laporan">
    <div class="judul_laporan">
       KSPPS KIS<br>
       <span>KANTOR PUSAT</span> <br>
       <span>LAPORAN SISA HASIL USAHA</span><br>
        <span>TAHUN {{date('Y')}}</span>
    </div>
    
    <div class="tabel_laporan">
        <table class="tabel_isi">
            <thead>
                <tr>
                    <th width="35%"></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- bagian pemasukan --}}
                <tr>
                    <td><b>Pemasukan</b></td>
                </tr>
                @php
                    $tahun =date('Y');
                    $total_masuk =DB::table('tbl_laporan')
                                ->where(['status'=> 1,'jenis'=> "SHU"])
                                ->whereYear('tgl', '=',  $tahun)
                                ->sum('nominal');  
                    $total_keluar =DB::table('tbl_laporan')
                                ->where(['status'=> 2,'jenis'=> "SHU"])
                                ->whereYear('tgl', '=',  $tahun)
                                ->sum('nominal');  
                    $laba_kotor =$total_masuk -$total_keluar;                       
                @endphp
                @foreach ($data_masuk as $dm)
            
                    <tr>
                        <td>{{$dm->ket}}</td>
                        <td style="text-align:right">{{number_format($dm->nominal)}}</td>
                    </tr>
                 @endforeach
                 <tr>
                    <td><b>Total Pemasukan</b></td>
                    <td></td>
                    <td style="text-align:right"><b>{{number_format($total_masuk)}}</b></td>
                </tr>
                 
                {{-- end pemasukan --}}

                {{-- pengeluaran --}}
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Pengeluaran</b></td>
                </tr>
                @foreach ($data_keluar as $dk)
            
                <tr>
                    <td scope="row">{{$dk->ket}}</td>
                    <td style="text-align:right">{{number_format($dk->nominal)}}</td>
                </tr>
              @endforeach
                <tr>
                    <td><b>Total Pengeluaran</b></td>
                    <td></td>
                    <td style="text-align:right"><b>{{number_format($total_keluar)}}</b> </td>
                </tr>
             
                {{-- end pengeluaran --}}

                {{-- laba kotor --}}
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Total </b></td>
                    <td></td>
                    <td style="text-align:right"><b>{{number_format($laba_kotor)}}</b> </td>
                </tr>
                {{-- end laba kotor --}}
            </tbody>
        </table>  
    </div>  
</div>

@endsection