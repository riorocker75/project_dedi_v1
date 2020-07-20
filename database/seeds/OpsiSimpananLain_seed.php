<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Model\Simpanan\OpsiSimpananLain;
class OpsiSimpananLain_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_opsi_simpanan_lain')->delete();
        OpsiSimpananLain::create([
            'id' => 1,
            'jenis_simpanan' => "Paket 1",
            'kode_simpanan' => "SUH",
            'jangka_simpanan' => 1,
            'angsuran_simpanan' =>1800000,
            'total_simpanan' => 21600000
        ]);
        
        OpsiSimpananLain::create([
            'id' => 2,
            'jenis_simpanan' => "Paket 2",
            'kode_simpanan' => "SUH",
            'jangka_simpanan' => 3,
            'angsuran_simpanan' =>600000,
            'total_simpanan' => 21600000
        ]);
         
        OpsiSimpananLain::create([
            'id' => 3,
            'jenis_simpanan' => "Paket 3",
            'kode_simpanan' => "SUH",
            'jangka_simpanan' => 6,
            'angsuran_simpanan' =>300000,
            'total_simpanan' => 21600000
        ]);

        // end umroh
        OpsiSimpananLain::create([
            'id' => 4,
            'jenis_simpanan' => "Simpanan Pendidikan Tingkat SD",
            'kode_simpanan' => "SPN",
            'jangka_simpanan' => 3,
            'angsuran_simpanan' =>60000,
            'total_simpanan' => 2479680,
            'bunga' =>14.8
        ]);
        OpsiSimpananLain::create([
            'id' => 5,
            'jenis_simpanan' => "Simpanan Pendidikan Tingkat SMP",
            'kode_simpanan' => "SPN",
            'jangka_simpanan' => 3,
            'angsuran_simpanan' =>90000,
            'total_simpanan' => 3719520,
            'bunga' => 14.8
        ]);

        OpsiSimpananLain::create([
            'id' => 6,
            'jenis_simpanan' => "Simpanan Pendidikan Tingkat SMA/SMK Sederajat",
            'kode_simpanan' => "SPN",
            'jangka_simpanan' => 3,
            'angsuran_simpanan' =>180000,
            'total_simpanan' => 7439040,
            'bunga' => 14.8
        ]);

        OpsiSimpananLain::create([
            'id' => 7,
            'jenis_simpanan' => "Simpanan Pendidikan Tingkat Kuliah",
            'kode_simpanan' => "SPN",
            'jangka_simpanan' => 3,
            'angsuran_simpanan' =>300000,
            'total_simpanan' => 12398400,
            'bunga' => 14.8
        ]);


        // end pendidikan
    }
}
