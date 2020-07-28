@php
         $data_sim= App\Model\Simpanan\SimpananBerjangka::where('status',1)->get();
      
@endphp

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>tgl</th>
            <th>nominal</th>
            <th>hari aja</th>

            <th>situasi hasil</th>
            <th>dibagi</th>

        </tr>
    </thead>
    <tbody>
       @foreach ( $data_sim as $ds)
           @php
                $op= App\Model\Simpanan\OpsiSimpananBerjangka::where('id', $ds->opsi_deposit_id)->first();
               $t= date('d',strtotime($ds->tgl_deposit));
               $tx= $t-2;
               $hari_ini =date('d');
           @endphp
       <tr>
           <td>{{$ds->rekening_deposit}}</td>
           <td>{{$ds->tgl_deposit}}</td>
           <td>{{$ds->nilai_deposit}}</td>
           <td>{{$tx}}</td>
            <td>
                <?php
                   if($tx == $hari_ini) {
                       echo "dibagi sekarang";
                   }else{
                       echo "dibagi nanti";
                   }

                    ?>

            </td>

            <td>
                {{$op->nisbah_bulan}}
            </td>
           
        </tr>
        @endforeach
    </tbody>
    
</table>