@php
         $data_sim= App\Model\Simpanan\SimpananBerjangka::where('status',1)->get();
    $data_pinjam=App\Model\Pinjaman::where('status_bayar',1)->get();
@endphp




<br>
<br>
<p>
    
    tabel Pinjaman
</p> 
<table>
<thead>
    <tr>
        <th>Nama</th>
        <th>tgl</th>
        <th>nominal</th>
        <th>bayar</th>
        <th>status</th>
     
    </tr>
</thead>
<tbody>
   @foreach (  $data_pinjam as $ds)
       @php
      $data_bayar_null=App\Model\PinjamanTransaksi::where('pinjaman_kode',$ds->pinjaman_kode)->get();

      $data_bayar=App\Model\PinjamanTransaksi::where('pinjaman_kode',$ds->pinjaman_kode)->orderBy('id','desc')->first();

         $end = strtotime(date($ds->pinjaman_tgl));
         $start = $month = strtotime("+0 day", $end);
         $months = strtotime("+1 week",  $month);
         $tgl_hari=date('Y-m-d',$months);
         $sekarang=date('Y-m-d');
         $origin = new DateTime($tgl_hari);
         $target = new DateTime($sekarang);
        //  $selisih= $tgl_hari->diff($sekarang);
        //  $tgl_s=;
       @endphp
   <tr>
       <td>{{$ds->pinjaman_kode}}</td>
       <td>{{$ds->pinjaman_tgl}}</td>
       <td>{{$ds->pinjaman_jumlah}}</td>
       <td>{{ $tgl_hari}}</td>
        <td>
            {{-- cek dulu ada apa nggak dai bayar di pinjaman transaksi --}}
            <?php if( count($data_bayar_null) > 0){ ?>
                {{-- disini jika dia udah pernah bayar tetapi nunggak dari sebelumnya --}}
                {{-- parameter tanggalnya dari tgl transaksi terakhir dengan keterangan bayar --}}
                @php
                 $end_trs = strtotime(date( $data_bayar->tgl_transaksi));
                $start_trs = $month = strtotime("+0 day", $end);
                $month_trs = strtotime("+1 week",  $month);
                    $tgl_trs= date('Y-m-d',$month_trs);
                $origin_trs = new DateTime($tgl_trs);
                 $target_trs = new DateTime($sekarang);
                @endphp
                @if ($tgl_trs < $sekarang)
                {{-- disini cek tunggakan bagi yang pertama kali dan sudah nuggak lebih dari 7 hari --}}
 
                    benar ssss<br>
                    <?php
                     $interval_trs = $origin_trs->diff($target_trs);
                     //   konvert dulu ke interger value ke hari %a
                     $int_trs= $interval_trs->format('%a');
                     echo $interval_trs->format('%R%a days');
                     ?>
                             @if ($int_trs > 7)
                                 @php
                                     $tot_nunggak=$int / 7;
                                     $bulatkan =ceil($tot_nunggak);
                                     echo "total nunggak sebanyak $bulatkan";
                                 @endphp
                             @else
                             salah karena urang                      
                             @endif
                @else
 
                    {{-- disini cek tunggakan bayar tapi dalam kondisi belum masuk tempo 7 hari --}}
                   
                   ssss
                @endif

            
            <?php }else{?>
                {{-- disini jika dia belum ada bayar maka cek dia dari tgl awal dia minjam --}}
               @if ($tgl_hari < $sekarang)
               {{-- disini cek tunggakan bagi yang pertama kali dan sudah nuggak lebih dari 7 hari --}}

                   benar ssss<br>
                   <?php
                    $interval = $origin->diff($target);
                    //   konvert dulu ke interger value ke hari %a
                    $int= $interval->format('%a');
                    echo $interval->format('%R%a days');
                    ?>
                            @if ($int > 7)
                                @php
                                    $tot_nunggak=$int / 7;
                                    $bulatkan =ceil($tot_nunggak);
                                    echo "total nunggak sebanyak $bulatkan";
                                @endphp
                            @else
                            salah karena urang                      
                            @endif
               @else

                   {{-- disini cek tunggakan bayar tapi dalam kondisi belum masuk tempo 7 hari --}}
                  
                  ssss
               @endif
            <?php }?>

           
        </td>
       
    </tr>
    @endforeach
</tbody>

</table>

