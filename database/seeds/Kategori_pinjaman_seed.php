<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;

class Kategori_pinjaman_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_kategori_pinjaman')->delete();
        Cat_Pinjaman::create([
            'kategori_id' => 1,
            'kategori_jenis' => "Plafon 1",
            'kategori_besar_pinjaman' => "1000000",
            'kategori_lama_pinjaman' => "25",
            'kategori_besar_bunga' => "2",
            'biaya_wajib' => '3000',
            'persen_potong' => '4',
            'uang_potong' => '40000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "44800"
        ]);
        Cat_Pinjaman::create([
            'kategori_id' => 2,
            'kategori_jenis' => "Plafon 2",
            'kategori_besar_pinjaman' => "2000000",
            'kategori_lama_pinjaman' => "25",
            'kategori_besar_bunga' => "2",
            'biaya_wajib' => '4000',
            'persen_potong' => '4',
            'uang_potong' => '80000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "89600"
        ]);

        Cat_Pinjaman::create([
            'kategori_id' => 3,
            'kategori_jenis' => "Plafon 3",
            'kategori_besar_pinjaman' => "3000000",
            'kategori_lama_pinjaman' => "50",
            'kategori_besar_bunga' => "2",
            'biaya_wajib' => '5000',
            'persen_potong' => '4',
            'uang_potong' => '120000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "74400"
        ]);
        Cat_Pinjaman::create([
            'kategori_id' => 4,
            'kategori_jenis' => "Plafon 4",
            'kategori_besar_pinjaman' => "4000000",
            'kategori_lama_pinjaman' => "50",
            'kategori_besar_bunga' => "2",
            'biaya_wajib' => '6000',
            'persen_potong' => '4',
            'uang_potong' => '160000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "99200"
        ]);

        Cat_Pinjaman::create([
            'kategori_id' => 5,
            'kategori_jenis' => "Plafon 5",
            'kategori_besar_pinjaman' => "5000000",
            'kategori_lama_pinjaman' => "50",
            'kategori_besar_bunga' => "2",
            'biaya_wajib' => '7000',
            'persen_potong' => '4',
            'uang_potong' => '200000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "124000"
        ]);

        Cat_Pinjaman::create([
            'kategori_id' => 6,
            'kategori_jenis' => "Plafon 6",
            'kategori_besar_pinjaman' => "6000000",
            'kategori_lama_pinjaman' => "50",
            'kategori_besar_bunga' => "1.75",
            'biaya_wajib' => '8000',
            'persen_potong' => '4',
            'uang_potong' => '240000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "145200"
        ]);

        Cat_Pinjaman::create([
            'kategori_id' => 7,
            'kategori_jenis' => "Plafon 7",
            'kategori_besar_pinjaman' => "10000000",
            'kategori_lama_pinjaman' => "50",
            'kategori_besar_bunga' => "1.75",
            'biaya_wajib' => '9000',
            'persen_potong' => '4',
            'uang_potong' => '400000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "242000"
        ]);

        Cat_Pinjaman::create([
            'kategori_id' => 8,
            'kategori_jenis' => "Plafon 8",
            'kategori_besar_pinjaman' => "14000000",
            'kategori_lama_pinjaman' => "100",
            'kategori_besar_bunga' => "1.75",
            'biaya_wajib' => '10000',
            'persen_potong' => '4',
            'uang_potong' => '560000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "198800"
        ]);
        Cat_Pinjaman::create([
            'kategori_id' => 9,
            'kategori_jenis' => "Plafon 9",
            'kategori_besar_pinjaman' => "15000000",
            'kategori_lama_pinjaman' => "100",
            'kategori_besar_bunga' => "1.5",
            'biaya_wajib' => '11000',
            'persen_potong' => '4',
            'uang_potong' => '600000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "204000"
        ]);

        Cat_Pinjaman::create([
            'kategori_id' => 10,
            'kategori_jenis' => "Plafon 10",
            'kategori_besar_pinjaman' => "20000000",
            'kategori_lama_pinjaman' => "100",
            'kategori_besar_bunga' => "1.5",
            'biaya_wajib' => '12000',
            'persen_potong' => '4',
            'uang_potong' => '800000',
            'persen_asuransi'=>'0.75',
            'persen_sosial'=> '0.75',
            'kategori_angsuran' => "272000"
        ]);

    }
}
