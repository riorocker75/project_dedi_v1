<?php

use Illuminate\Database\Seeder;
use App\Model\Option;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class Option_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_option')->delete();
        Option::create([
            'id' => 1,
            'option_name' => 'web_name',
            'option_value' => "Sistem Informasi Koperasi Simpan Pinjam"
          
        ]);

        Option::create([
            'id' => 2,
            'option_name' => 'web_description',
            'option_value' => "Sistem Informasi Koperasi Simpan Pinjam"
          
        ]);

        Option::create([
            'id' => 3,
            'option_name' => 'syarat',
            'option_value' => "untuk syarat bisa dicopi isi dari contoh_syarat.txt pastekan di text editor di pengaturan->pengaturan syarat"
          
        ]);

        Option::create([
            'id' => 4,
            'option_name' => 'foto_dev',
            'option_value' => "blabla"
          
        ]);

        Option::create([
            'id' => 5,
            'option_name' => 'pengumuman',
            'option_value' => "blabla"
          
        ]);

        Option::create([
            'id' => 6,
            'option_name' => 'rekening',
            'option_value' => "blabla"
          
        ]);
    }
}
