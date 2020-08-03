<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use Illuminate\Console\Command;

class BagiDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kirim:deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $data_sim=SimpananBerjangka::where('status',1)->get();
       if(count($data_sim) > 0) { 
            foreach($data_sim as $ds){

                    $op=OpsiSimpananBerjangka::where('id', $ds->opsi_deposit_id)->first();
            
                    $t= date('d',strtotime($ds->tgl_deposit));
                    $tx = $t;
                    // $tx = $t-2;

                    $hari_ini =date('d'); //ini untuk cek tgl hari ini 
                    $tot_nisbah = $ds->total_nisbah + $op->nisbah_bulan;  
                    $saldo_tambah = $ds->nilai_deposit + $ds->total_nisbah ;
                    if($tx = $hari_ini) {

                        DB::table('tbl_simpanan_berjangka')->where([
                            'rekening_deposit'=> $ds->rekening_deposit,
                            'status' => 1
                        ])->update([
                            'total_nisbah' =>$tot_nisbah
                        ]);

                        $kode_trs="TRBK-" .rand(10000,99999);
                        DB::table('tbl_simpanan_transaksi')->insert([
                            'anggota_id' =>$ds->anggota_id,
                            'no_rekening' => $ds->rekening_deposit,  
                            'operator_id' => "BOT",
                            'kode_simpanan' => "SBK",
                            'kode_transaksi' => $kode_trs,
                            'nominal_transaksi' => $op->nisbah_bulan,
                            'tgl_transaksi' => date('Y-m-d H:i:s'),
                            'jenis_transaksi' => "Simpanan Berjangka",
                            'ket_transaksi' => "Pembagian Nisbah Bulanan",
                            'sisa_angsuran' => $saldo_tambah,
                            'status' => 1
                        ]);

                    }else{
                        \Log::info('Belum ada yang di bagi');
                    }
            }
        //    end foreach
       
       }else{
        \Log::info('Belum ada yang ajukan tabungan berjangka');
       }
    // end check status tabungan

       
    }
}
