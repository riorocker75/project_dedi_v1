<?php

use Illuminate\Database\Seeder;
use App\Model\Pekerjaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class Pekerjaan_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_pekerjaan')->delete();
        Pekerjaan::create([
            'id' => 1,
            'pekerjaan' => "Pegawai Negeri Sipil (PNS)"
        ]);

        Pekerjaan::create([
            'id' => 2,
            'pekerjaan' => "Pegawai Swasta"
        ]);
        Pekerjaan::create([
            'id' => 3,
            'pekerjaan' => "Wiraswasta"
        ]);
        Pekerjaan::create([
            'id' => 4,
            'pekerjaan' => "Dokter"
        ]);

        Pekerjaan::create([
            'id' => 5,
            'pekerjaan' => "POLISI"
        ]);
        Pekerjaan::create([
            'id' => 6,
            'pekerjaan' => "TNI"
        ]);
      
    }
}
