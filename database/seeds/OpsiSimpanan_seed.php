<?php

use Illuminate\Database\Seeder;
use App\Model\Simpanan\OpsiSimpanan;


class OpsiSimpanan_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_opsi_simpanan')->delete();
        OpsiSimpanan::create([
            'id'=> 1,
            'simpanan_pokok' => 20000,
            'simpanan_wajib' => 5000,
            'bunga' => 6,
            'biaya_buku' =>5000,
            'biaya_endapan' => 50000,
            'biaya_admin' =>5000,
            'sukarela_min' =>5000
        ]);
    }

}
