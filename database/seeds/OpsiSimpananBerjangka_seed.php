<?php

use Illuminate\Database\Seeder;
use App\Model\Simpanan\OpsiSimpananBerjangka;
class OpsiSimpananBerjangka_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_opsi_simpanan_berjangka')->delete();
        OpsiSimpananBerjangka::create([
            'id' => 1,
            'nominal_deposit' => 5000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>41667,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 2,
            'nominal_deposit' => 25000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>208333,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 3,
            'nominal_deposit' => 50000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>416667,
            'periode_deposit' =>12
        ]);
        
        OpsiSimpananBerjangka::create([
            'id' => 4,
            'nominal_deposit' => 100000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>833333,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 5,
            'nominal_deposit' => 150000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>1250000,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 6,
            'nominal_deposit' => 200000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>1666667,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 7,
            'nominal_deposit' => 250000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>2083333,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 8,
            'nominal_deposit' => 300000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>2500000,
            'periode_deposit' =>12
        ]);
         
        OpsiSimpananBerjangka::create([
            'id' => 9,
            'nominal_deposit' => 350000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>2916667,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 10,
            'nominal_deposit' => 450000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>3750000,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 11,
            'nominal_deposit' => 500000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>4166667,
            'periode_deposit' =>12
        ]);
         
        OpsiSimpananBerjangka::create([
            'id' => 12,
            'nominal_deposit' => 750000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>6250000,
            'periode_deposit' =>12
        ]);

        OpsiSimpananBerjangka::create([
            'id' => 13,
            'nominal_deposit' => 1000000000,
            'bunga_deposit' => 10,
            'nisbah_bulan' =>8333333,
            'periode_deposit' =>12
        ]);

    }
}
