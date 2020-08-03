<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


use App\Model\Kas;
class Kas_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_kas')->delete();
        Kas::create([
          'id' => 1,
          'saldo' => 70000000,
          'nama' => "Pendapatan Kotor",
          'status' => '1'
        ]);
    }
}
