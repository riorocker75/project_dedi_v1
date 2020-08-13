<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
         $this->call(Anggota_seed::class);
         $this->call(Pekerjaan_seed::class);
         $this->call(Kategori_pinjaman_seed::class);
         $this->call(OpsiSimpanan_seed::class);
         $this->call(OpsiSimpananLain_seed::class);

         $this->call(OpsiSimpananBerjangka_seed::class);
         $this->call(User_seed::class);

         $this->call(Option_seed::class);
         $this->call(Kas_seed::class);
         $this->call(Pegawai_seed::class);






    }
}
